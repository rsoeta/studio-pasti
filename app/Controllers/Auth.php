<?php

namespace App\Controllers;

use App\Models\AdminUserModel;

class Auth extends BaseController
{
    // Menampilkan Halaman Form Login
    public function login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        // Jika admin sudah login sebelumnya, langsung lempar ke halaman dashboard
        if (session()->get('is_admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/login');
    }

    // Memproses Verifikasi Data Login
    public function attemptLogin()
    {
        $session = session();
        $model = new AdminUserModel();

        // Mengambil input dari user (bisa menggunakan username atau email)
        $usernameInput = $this->request->getPost('username');
        $passwordInput = $this->request->getPost('password');

        // Cari user berdasarkan username ATAU email
        $admin = $model->where('username', $usernameInput)
            ->orWhere('email', $usernameInput)
            ->first();

        if ($admin) {
            // Memverifikasi hash password (keamanan standar industri)
            if (password_verify($passwordInput, $admin['password_hash'])) {

                // Menyusun struktur data session admin
                $sessionData = [
                    'admin_id'           => $admin['id'],
                    'admin_nama'         => $admin['nama_lengkap'],
                    'admin_username'     => $admin['username'],
                    'is_admin_logged_in' => true
                ];
                $session->set($sessionData);

                // Mencatat waktu login terakhir ke database
                $model->update($admin['id'], [
                    'last_login' => date('Y-m-d H:i:s')
                ]);

                return redirect()->to('/admin/dashboard')->with('success', 'Akses berhasil diberikan. Selamat datang kembali!');
            }
        }

        // Jika gagal verifikasi, kembalikan ke halaman login dengan notifikasi
        return redirect()->back()->withInput()->with('error', 'Kredensial salah. Sesi masuk ditolak.');
    }

    // Memproses Logout
    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/auth/login')->with('success', 'Anda telah keluar dari sistem secara aman.');
    }
}
