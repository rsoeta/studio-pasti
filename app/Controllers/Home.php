<?php

namespace App\Controllers;

use App\Models\PortfolioModel;
use App\Models\WebSettingModel;

class Home extends BaseController
{
    public function index(): string
    {
        // Inisialisasi Model
        $portfolioModel = new PortfolioModel();
        $settingModel   = new WebSettingModel();

        // 1. Tarik Data Pengaturan Web (Baris pertama)
        $settings = $settingModel->first();

        // Failsafe: Jika tabel pengaturan web tidak sengaja kosong, berikan nilai default 
        // agar Landing Page tidak mengalami error (halaman putih).
        if (!$settings) {
            $settings = [
                'nama_web'            => 'Studio PASTI',
                'nomor_wa'            => '628xxxxxxxxxx',
                'teks_hero_judul'     => 'Prima Automasi Sistem Teknologi Informasi',
                'teks_hero_deskripsi' => 'Sistem sedang dalam konfigurasi awal.',
                'teks_footer'         => '© 2026 Studio PASTI'
            ];
        }

        // 2. Tarik Data Portofolio
        // Hanya tarik aplikasi yang 'is_active' = 1 (Tampil), 
        // dan urutkan berdasarkan angka di kolom 'urutan' dari yang terkecil (ASC).
        $portfolios = $portfolioModel->where('is_active', 1)
            ->orderBy('urutan', 'ASC')
            ->findAll();

        // 3. Bungkus semua data untuk dikirim ke View 'landing_page'
        $data = [
            'settings' => $settings,
            'apps'     => $portfolios
        ];

        return view('landing_page', $data);
    }
}
