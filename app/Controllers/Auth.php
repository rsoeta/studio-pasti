<?php

namespace App\Controllers;

use App\Libraries\SecurityConfig;
use App\Models\AdminUserModel;
use Config\Services;

class Auth extends BaseController
{
    // Menampilkan Halaman Form Login
    public function login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (session()->get('is_admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/login', [
            'security' => SecurityConfig::get(),
        ]);
    }

    // Memproses Verifikasi Data Login (Rate Limit + Cloudflare Turnstile + Session Regenerate)
    public function attemptLogin()
    {
        $throttler   = Services::throttler();
        $throttleKey = md5('login_' . $this->request->getIPAddress());
        if ($throttler->check($throttleKey, 5, MINUTE) === false) {
            return redirect()->back()->withInput()->with('error', 'Terlalu banyak percobaan masuk. Tunggu 1 menit sebelum mencoba kembali.');
        }

        if (SecurityConfig::isTurnstileEnabled()) {
            $token      = (string) $this->request->getPost('cf-turnstile-response');
            $host       = strtolower((string) $this->request->getUri()->getHost());
            $isLocalDev = ENVIRONMENT === 'development' && in_array($host, ['localhost', '127.0.0.1', '::1'], true);

            if ($token !== '') {
                if (!$this->verifyTurnstile($token) && !$isLocalDev) {
                    return redirect()->back()->withInput()->with('error', 'Verifikasi anti-bot Cloudflare Turnstile gagal atau kedaluwarsa.');
                }
            } elseif (!$isLocalDev) {
                return redirect()->back()->withInput()->with('error', 'Verifikasi anti-bot Cloudflare Turnstile gagal atau kedaluwarsa.');
            }
        }

        $session       = session();
        $model         = new AdminUserModel();
        $usernameInput = trim((string) $this->request->getPost('username'));
        $passwordInput = (string) $this->request->getPost('password');

        if ($usernameInput === '' || $passwordInput === '') {
            return redirect()->back()->withInput()->with('error', 'Username/Email dan kata sandi wajib diisi.');
        }

        $admin = $model->where('username', $usernameInput)
            ->orWhere('email', $usernameInput)
            ->first();

        if ($admin && password_verify($passwordInput, $admin['password_hash'])) {
            $this->establishAdminSession($session, $model, $admin);
            return redirect()->to('/admin/dashboard')->with('success', 'Akses berhasil diberikan. Selamat datang kembali!');
        }

        return redirect()->back()->withInput()->with('error', 'Kredensial salah. Sesi masuk ditolak.');
    }

    // Mengarahkan Pengguna ke Google OAuth 2.0
    public function googleRedirect()
    {
        if (!SecurityConfig::isGoogleOAuthEnabled()) {
            return redirect()->to('/auth/login')->with('error', 'Login Google OAuth belum dikonfigurasi oleh Administrator.');
        }

        $state = bin2hex(random_bytes(16));
        session()->set('oauth_google_state', $state);

        $security = SecurityConfig::get();
        $params   = http_build_query([
            'client_id'     => $security['google_client_id'],
            'redirect_uri'  => base_url('auth/google/callback'),
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'state'         => $state,
            'prompt'        => 'select_account',
        ]);

        return redirect()->to('https://accounts.google.com/o/oauth2/v2/auth?' . $params);
    }

    // Menangani Callback Google OAuth & Verifikasi Whitelist Admin
    public function googleCallback()
    {
        if (!SecurityConfig::isGoogleOAuthEnabled()) {
            return redirect()->to('/auth/login')->with('error', 'Login Google OAuth belum aktif.');
        }

        $errorParam = (string) $this->request->getGet('error');
        if ($errorParam !== '') {
            return redirect()->to('/auth/login')->with('error', 'Autentikasi Google dibatalkan atau ditolak.');
        }

        $session    = session();
        $savedState = (string) $session->get('oauth_google_state');
        $state      = (string) $this->request->getGet('state');
        $session->remove('oauth_google_state');

        if ($savedState === '' || $state === '' || !hash_equals($savedState, $state)) {
            return redirect()->to('/auth/login')->with('error', 'Validasi state Google OAuth tidak cocok. Silakan coba lagi.');
        }

        $code = trim((string) $this->request->getGet('code'));
        if ($code === '') {
            return redirect()->to('/auth/login')->with('error', 'Kode otorisasi Google tidak ditemukan.');
        }

        $security = SecurityConfig::get();

        try {
            $client        = Services::curlrequest(['timeout' => 12, 'http_errors' => false]);
            $tokenResponse = $client->post('https://oauth2.googleapis.com/token', [
                'form_params' => [
                    'code'          => $code,
                    'client_id'     => $security['google_client_id'],
                    'client_secret' => $security['google_client_secret'],
                    'redirect_uri'  => base_url('auth/google/callback'),
                    'grant_type'    => 'authorization_code',
                ],
            ]);

            $tokenData   = json_decode((string) $tokenResponse->getBody(), true);
            $accessToken = is_array($tokenData) ? (string) ($tokenData['access_token'] ?? '') : '';

            if ($tokenResponse->getStatusCode() !== 200 || $accessToken === '') {
                return redirect()->to('/auth/login')->with('error', 'Gagal menukar token akses Google OAuth.');
            }

            $userResponse = $client->get('https://www.googleapis.com/oauth2/v3/userinfo', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $userInfo      = json_decode((string) $userResponse->getBody(), true);
            $googleEmail   = is_array($userInfo) ? trim((string) ($userInfo['email'] ?? '')) : '';
            $emailVerified = is_array($userInfo) ? filter_var($userInfo['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN) : false;

            if ($userResponse->getStatusCode() !== 200 || $googleEmail === '' || !$emailVerified) {
                return redirect()->to('/auth/login')->with('error', 'Akun Google tidak memiliki email terverifikasi.');
            }

            $model = new AdminUserModel();
            $admin = $model->where('LOWER(email)', strtolower($googleEmail))->first();

            if (!$admin) {
                return redirect()->to('/auth/login')->with(
                    'error',
                    "Akses Ditolak: Email Google ({$googleEmail}) tidak terdaftar dalam Whitelist Otoritas Admin."
                );
            }

            $this->establishAdminSession($session, $model, $admin);
            return redirect()->to('/admin/dashboard')->with('success', 'Login Google OAuth berhasil. Selamat datang kembali!');
        } catch (\Throwable $e) {
            return redirect()->to('/auth/login')->with('error', 'Terjadi kesalahan saat menghubungi layanan Google OAuth.');
        }
    }

    // Memproses Logout
    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah keluar dari sistem secara aman.');
    }

    private function establishAdminSession($session, AdminUserModel $model, array $admin): void
    {
        $session->regenerate(true);
        $session->set([
            'admin_id'           => $admin['id'],
            'admin_nama'         => $admin['nama_lengkap'],
            'admin_username'     => $admin['username'],
            'admin_email'        => $admin['email'],
            'is_admin_logged_in' => true,
        ]);

        $model->update($admin['id'], [
            'last_login' => date('Y-m-d H:i:s'),
        ]);
    }

    private function verifyTurnstile(string $token): bool
    {
        $security = SecurityConfig::get();

        try {
            $client   = Services::curlrequest(['timeout' => 10, 'http_errors' => false]);
            $response = $client->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'form_params' => [
                    'secret'   => $security['turnstile_secret_key'],
                    'response' => $token,
                    'remoteip' => $this->request->getIPAddress(),
                ],
            ]);

            $payload = json_decode((string) $response->getBody(), true);
            return is_array($payload) && !empty($payload['success']);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
