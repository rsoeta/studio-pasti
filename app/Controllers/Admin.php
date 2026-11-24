<?php

namespace App\Controllers;

use App\Libraries\SecurityConfig;
use App\Models\AdminUserModel;
use App\Models\PortfolioModel;
use App\Models\WebSettingModel;

class Admin extends BaseController
{
    protected $portfolioModel;

    public function __construct()
    {
        $this->portfolioModel = new PortfolioModel();
    }

    // Cek Sesi Keamanan Admin
    private function checkAuth()
    {
        if (!session()->get('is_admin_logged_in')) {
            throw new \CodeIgniter\Router\Exceptions\RedirectException('/auth/login');
        }
    }

    public function index()
    {
        $this->checkAuth();
        $settingModel = new WebSettingModel();
        $settings     = $settingModel->first();

        if (!$settings) {
            $settings = [
                'nama_web'            => 'Studio PASTI',
                'nomor_wa'            => '628xxxxxxxxxx',
                'teks_hero_judul'     => 'Prima Automasi Sistem Teknologi Informasi',
                'teks_hero_deskripsi' => 'Sistem sedang dalam konfigurasi awal.',
                'teks_footer'         => '© 2026 Studio PASTI'
            ];
        }

        $data = [
            'title'           => 'Dasbor Utama - Studio PASTI',
            'total_portfolio' => $this->portfolioModel->countAll(),
            'portfolios'      => $this->portfolioModel->orderBy('urutan', 'ASC')->findAll(),
            'settings'        => $settings
        ];
        return view('admin/dashboard', $data);
    }

    // ================= MANAJEMEN PORTOFOLIO =================

    // List Portofolio
    public function portfolioIndex()
    {
        $this->checkAuth();
        $data = [
            'title' => 'Manajemen Portofolio - Studio PASTI',
            'portfolios' => $this->portfolioModel->orderBy('urutan', 'ASC')->findAll()
        ];
        return view('admin/portfolio/index', $data);
    }

    // Form Tambah
    public function portfolioCreate()
    {
        $this->checkAuth();
        $data = ['title' => 'Tambah Portofolio - Studio PASTI'];
        return view('admin/portfolio/create', $data);
    }

    // Simpan Data Baru
    public function portfolioStore()
    {
        $this->checkAuth();

        // Logika Upload Gambar
        $fileLogo = $this->request->getFile('logo');
        $namaLogo = 'default.png';
        if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
            $namaLogo = $fileLogo->getRandomName(); // Menghasilkan nama acak aman
            $fileLogo->move('uploads/portfolios', $namaLogo);
        }

        $this->portfolioModel->save([
            'judul'       => $this->request->getPost('judul'),
            'deskripsi'   => $this->request->getPost('deskripsi'), // Menyimpan format HTML dari Editor
            'link_github' => $this->request->getPost('link_github') ?: '#',
            'link_demo'   => $this->request->getPost('link_demo') ?: '#',
            'status_demo' => $this->request->getPost('status_demo'),
            'logo'        => $namaLogo,
            'urutan'      => $this->request->getPost('urutan') ?: 0,
            'is_active'   => 1
        ]);

        return redirect()->to('/admin/portfolio')->with('success', 'Portofolio baru berhasil ditambahkan.');
    }

    // Update Data
    public function portfolioUpdate($id)
    {
        $this->checkAuth();
        $portfolio = $this->portfolioModel->find($id);

        // Logika Update Gambar
        $fileLogo = $this->request->getFile('logo');
        $namaLogo = $portfolio['logo']; // Gunakan logo lama sebagai default

        if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
            // Hapus logo lama dari server jika bukan default.png
            if ($namaLogo != 'default.png' && file_exists('uploads/portfolios/' . $namaLogo)) {
                unlink('uploads/portfolios/' . $namaLogo);
            }
            $namaLogo = $fileLogo->getRandomName();
            $fileLogo->move('uploads/portfolios', $namaLogo);
        }

        $this->portfolioModel->update($id, [
            'judul'       => $this->request->getPost('judul'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'link_github' => $this->request->getPost('link_github') ?: '#',
            'link_demo'   => $this->request->getPost('link_demo') ?: '#',
            'status_demo' => $this->request->getPost('status_demo'),
            'logo'        => $namaLogo,
            'urutan'      => $this->request->getPost('urutan') ?: 0
        ]);

        return redirect()->to('/admin/portfolio')->with('success', 'Perubahan portofolio berhasil disimpan.');
    }

    // Hapus Portofolio
    public function portfolioDelete($id)
    {
        $this->checkAuth();
        $portfolio = $this->portfolioModel->find($id);
        if ($portfolio) {
            // Bersihkan file gambar dari server
            if ($portfolio['logo'] != 'default.png' && file_exists('uploads/portfolios/' . $portfolio['logo'])) {
                unlink('uploads/portfolios/' . $portfolio['logo']);
            }
            $this->portfolioModel->delete($id);
            return redirect()->to('/admin/portfolio')->with('success', 'Portofolio berhasil dihapus dari sistem.');
        }
        return redirect()->to('/admin/portfolio')->with('error', 'Gagal menghapus data.');
    }

    // Form Edit
    public function portfolioEdit($id)
    {
        $this->checkAuth();
        $portfolio = $this->portfolioModel->find($id);
        if (!$portfolio) {
            return redirect()->to('/admin/portfolio')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Portofolio - Studio PASTI',
            'portfolio' => $portfolio
        ];
        return view('admin/portfolio/edit', $data);
    }

    // Sembunyikan / Tampilkan Portofolio (Toggle)
    public function portfolioToggle($id)
    {
        $this->checkAuth();
        $portfolio = $this->portfolioModel->find($id);
        if ($portfolio) {
            $newStatus = $portfolio['is_active'] == 1 ? 0 : 1;
            $this->portfolioModel->update($id, ['is_active' => $newStatus]);
            return redirect()->to('/admin/portfolio')->with('success', 'Status visibilitas portofolio berhasil diubah.');
        }
        return redirect()->to('/admin/portfolio')->with('error', 'Gagal mengubah status.');
    }

    // ================= MANAJEMEN PENGATURAN WEB =================

    public function settingsIndex()
    {
        $this->checkAuth();
        $settingModel = new WebSettingModel();

        // Ambil data baris pertama
        $settings = $settingModel->first();

        // Jika tabel masih kosong (belum disemai), otomatis buat data default
        if (!$settings) {
            $settingModel->insert([
                'nama_web'            => 'Studio PASTI',
                'nomor_wa'            => '628xxxxxxxxxx',
                'teks_hero_judul'     => 'Prima Automasi Sistem Teknologi Informasi',
                'teks_hero_deskripsi' => 'Kami membantu akselerasi digitalisasi instansi publik, pemerintahan desa, dan ekosistem pendidikan melalui solusi web sistem terintegrasi yang akurat dan andal.',
                'teks_footer'         => '© 2026 Studio PASTI (studio-pasti.net). All Rights Reserved.'
            ]);
            $settings = $settingModel->first();
        }

        $data = [
            'title'         => 'Pengaturan Web - Studio PASTI',
            'settings'      => $settings,
            'logoUrl'       => WebSettingModel::getLogoUrl($settings),
            'hasCustomLogo' => WebSettingModel::hasCustomLogo($settings),
            'security'      => SecurityConfig::get(),
            'admins'        => (new AdminUserModel())->orderBy('id', 'ASC')->findAll(),
        ];
        return view('admin/settings/index', $data);
    }

    public function settingsUpdate()
    {
        $this->checkAuth();
        $settingModel = new WebSettingModel();
        $id           = $this->request->getPost('id');
        $current      = $id ? $settingModel->find($id) : $settingModel->first();

        if (!$current) {
            return redirect()->to('/admin/settings')->with('error', 'Data pengaturan website tidak ditemukan.');
        }

        $updateData = [
            'nama_web'            => $this->request->getPost('nama_web'),
            'nomor_wa'            => $this->request->getPost('nomor_wa'),
            'teks_hero_judul'     => $this->request->getPost('teks_hero_judul'),
            'teks_hero_deskripsi' => $this->request->getPost('teks_hero_deskripsi'),
            'teks_footer'         => $this->request->getPost('teks_footer'),
        ];

        $logoUpdated = false;
        $fileLogo    = $this->request->getFile('logo');

        if ($fileLogo !== null && $fileLogo->getError() !== UPLOAD_ERR_NO_FILE) {
            if (!$fileLogo->isValid() || $fileLogo->hasMoved()) {
                $errCode = $fileLogo->getError();
                if ($errCode === UPLOAD_ERR_INI_SIZE || $errCode === UPLOAD_ERR_FORM_SIZE) {
                    return redirect()->to('/admin/settings')->with('error', 'Ukuran file logo melebihi batas maksimum yang diizinkan (maks. 2MB).');
                }

                return redirect()->to('/admin/settings')->with('error', 'Gagal mengunggah file logo. Silakan coba lagi.');
            }

            if ($fileLogo->getSizeByUnit('kb') > 2048) {
                return redirect()->to('/admin/settings')->with('error', 'Ukuran file logo maksimal 2MB.');
            }

            $allowedMimes = ['image/png', 'image/jpeg', 'image/webp'];
            $allowedExts  = ['png', 'jpg', 'jpeg', 'webp'];
            $mime         = strtolower((string) $fileLogo->getMimeType());
            $ext          = strtolower((string) $fileLogo->guessExtension());
            $tempPath     = $fileLogo->getTempName();

            if (!in_array($mime, $allowedMimes, true) || !in_array($ext, $allowedExts, true) || $tempPath === '' || @getimagesize($tempPath) === false) {
                return redirect()->to('/admin/settings')->with('error', 'Format logo tidak didukung. Gunakan file gambar PNG, JPG, atau WebP yang valid.');
            }

            if (!WebSettingModel::ensureLogoColumn()) {
                return redirect()->to('/admin/settings')->with('error', 'Kolom logo belum tersedia di database. Jalankan migrasi database terlebih dahulu.');
            }

            $uploadDir = WebSettingModel::getLogoUploadDir();
            if (!is_dir($uploadDir) && !@mkdir($uploadDir, 0775, true) && !is_dir($uploadDir)) {
                return redirect()->to('/admin/settings')->with('error', 'Gagal menyiapkan direktori penyimpanan logo.');
            }

            $indexFile = $uploadDir . DIRECTORY_SEPARATOR . 'index.html';
            if (!is_file($indexFile)) {
                @file_put_contents($indexFile, '');
            }

            $newLogoName = $fileLogo->getRandomName();
            $fileLogo->move($uploadDir, $newLogoName);

            $oldLogo = trim((string) ($current['logo'] ?? ''));
            if ($oldLogo !== '') {
                $oldPath = $uploadDir . DIRECTORY_SEPARATOR . basename($oldLogo);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $updateData['logo'] = $newLogoName;
            $logoUpdated        = true;
        }

        $settingModel->update($current['id'], $updateData);
        WebSettingModel::clearCache();

        return redirect()->to('/admin/settings')->with(
            'success',
            $logoUpdated
                ? 'Konfigurasi website dan logo berhasil diperbarui.'
                : 'Konfigurasi website berhasil diperbarui.'
        );
    }

    public function settingsLogoReset()
    {
        $this->checkAuth();
        $settingModel = new WebSettingModel();
        $current      = $settingModel->first();

        if ($current && !empty($current['logo'])) {
            $oldPath = WebSettingModel::getLogoUploadDir() . DIRECTORY_SEPARATOR . basename((string) $current['logo']);
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }

            if (WebSettingModel::ensureLogoColumn()) {
                $settingModel->update($current['id'], ['logo' => null]);
            }

            WebSettingModel::clearCache();

            return redirect()->to('/admin/settings')->with('success', 'Logo website berhasil dikembalikan ke logo default.');
        }

        return redirect()->to('/admin/settings')->with('success', 'Logo website sudah menggunakan logo default.');
    }

    public function securityUpdate()
    {
        $this->checkAuth();

        $saved = SecurityConfig::save([
            'turnstile_site_key'   => $this->request->getPost('turnstile_site_key'),
            'turnstile_secret_key' => $this->request->getPost('turnstile_secret_key'),
            'google_client_id'     => $this->request->getPost('google_client_id'),
            'google_client_secret' => $this->request->getPost('google_client_secret'),
        ]);

        if (!$saved) {
            return redirect()->to('/admin/settings')->with('error', 'Gagal menyimpan konfigurasi keamanan ke direktori writable.');
        }

        return redirect()->to('/admin/settings')->with('success', 'Konfigurasi keamanan Cloudflare Turnstile & Google OAuth berhasil disimpan.');
    }

    public function whitelistStore()
    {
        $this->checkAuth();
        $adminModel = new AdminUserModel();

        $nama     = trim((string) $this->request->getPost('nama_lengkap'));
        $email    = strtolower(trim((string) $this->request->getPost('email')));
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if ($nama === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/admin/settings')->with('error', 'Nama lengkap dan alamat email Google yang valid wajib diisi.');
        }

        if ($adminModel->where('email', $email)->first()) {
            return redirect()->to('/admin/settings')->with('error', 'Email tersebut sudah terdaftar di dalam Whitelist Admin.');
        }

        if ($username === '') {
            $baseUsername = preg_replace('/[^a-z0-9_]/', '', strtolower((string) strstr($email, '@', true))) ?: 'admin';
            $username     = $baseUsername;
            $suffix       = 1;
            while ($adminModel->where('username', $username)->first()) {
                $username = $baseUsername . $suffix;
                $suffix++;
            }
        } elseif ($adminModel->where('username', $username)->first()) {
            return redirect()->to('/admin/settings')->with('error', 'Username sudah digunakan oleh akun admin lain.');
        }

        $rawPassword = $password !== '' ? $password : bin2hex(random_bytes(16));

        $adminModel->insert([
            'nama_lengkap'  => $nama,
            'username'      => $username,
            'email'         => $email,
            'password_hash' => password_hash($rawPassword, PASSWORD_DEFAULT),
        ]);

        return redirect()->to('/admin/settings')->with('success', 'Email Google berhasil ditambahkan ke Whitelist Admin.');
    }

    public function whitelistDelete($id)
    {
        $this->checkAuth();
        $adminModel = new AdminUserModel();

        if ((int) $id === (int) session()->get('admin_id')) {
            return redirect()->to('/admin/settings')->with('error', 'Anda tidak dapat menghapus akun admin yang sedang aktif digunakan.');
        }

        if ($adminModel->countAll() <= 1) {
            return redirect()->to('/admin/settings')->with('error', 'Minimal harus tersisa 1 akun admin di dalam sistem.');
        }

        $target = $adminModel->find($id);
        if (!$target) {
            return redirect()->to('/admin/settings')->with('error', 'Data admin tidak ditemukan.');
        }

        $adminModel->delete($id);
        return redirect()->to('/admin/settings')->with('success', 'Akses Whitelist Admin berhasil dihapus.');
    }
}
