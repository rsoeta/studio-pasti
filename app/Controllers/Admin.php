<?php

namespace App\Controllers;

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
        $data = [
            'title' => 'Dasbor Utama - Studio PASTI',
            'total_portfolio' => $this->portfolioModel->countAll()
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
        $this->portfolioModel->save([
            'judul'       => $this->request->getPost('judul'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'link_github' => $this->request->getPost('link_github') ?: '#',
            'link_demo'   => $this->request->getPost('link_demo') ?: '#',
            'status_demo' => $this->request->getPost('status_demo'),
            'ikon'        => $this->request->getPost('ikon') ?: 'fa-laptop-code',
            'urutan'      => $this->request->getPost('urutan') ?: 0,
            'is_active'   => 1
        ]);

        return redirect()->to('/admin/portfolio')->with('success', 'Portofolio baru berhasil ditambahkan.');
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

    // Update Data
    public function portfolioUpdate($id)
    {
        $this->checkAuth();
        $this->portfolioModel->update($id, [
            'judul'       => $this->request->getPost('judul'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'link_github' => $this->request->getPost('link_github') ?: '#',
            'link_demo'   => $this->request->getPost('link_demo') ?: '#',
            'status_demo' => $this->request->getPost('status_demo'),
            'ikon'        => $this->request->getPost('ikon') ?: 'fa-laptop-code',
            'urutan'      => $this->request->getPost('urutan') ?: 0
        ]);

        return redirect()->to('/admin/portfolio')->with('success', 'Perubahan portofolio berhasil disimpan.');
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

    // Hapus Portofolio
    public function portfolioDelete($id)
    {
        $this->checkAuth();
        if ($this->portfolioModel->find($id)) {
            $this->portfolioModel->delete($id);
            return redirect()->to('/admin/portfolio')->with('success', 'Portofolio berhasil dihapus dari sistem.');
        }
        return redirect()->to('/admin/portfolio')->with('error', 'Gagal menghapus data.');
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
            'title'    => 'Pengaturan Web - Studio PASTI',
            'settings' => $settings
        ];
        return view('admin/settings/index', $data);
    }

    public function settingsUpdate()
    {
        $this->checkAuth();
        $settingModel = new WebSettingModel();
        $id = $this->request->getPost('id');

        $settingModel->update($id, [
            'nama_web'            => $this->request->getPost('nama_web'),
            'nomor_wa'            => $this->request->getPost('nomor_wa'),
            'teks_hero_judul'     => $this->request->getPost('teks_hero_judul'),
            'teks_hero_deskripsi' => $this->request->getPost('teks_hero_deskripsi'),
            'teks_footer'         => $this->request->getPost('teks_footer')
        ]);

        return redirect()->to('/admin/settings')->with('success', 'Konfigurasi website berhasil diperbarui.');
    }
}
