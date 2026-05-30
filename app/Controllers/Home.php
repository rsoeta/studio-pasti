<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Data portofolio aplikasi dummy yang tersimpan di GitHub
        $data['apps'] = [
            [
                'title'       => 'Implementasi OpenSID Premium & Cloud',
                'description' => 'Sistem Informasi Desa online terintegrasi dengan modul kependudukan, surat mandiri, dan visualisasi peta ruang GIS.',
                'github'      => 'https://github.com/OpenSID',
                'demo_status' => 'ready',
                'icon'        => 'fa-server'
            ],
            [
                'title'       => 'Sistem E-Voting Instansi & Sekolah',
                'description' => 'Aplikasi pemilihan umum real-time berbasis web dengan verifikasi token berlapis untuk OSIS, BPD, atau organisasi lokal.',
                'github'      => '#',
                'demo_status' => 'maintenance',
                'icon'        => 'fa-check-to-slot'
            ],
            [
                'title'       => 'Dasbor Otomatisasi Administrasi GAS',
                'description' => 'Sistem rekapitulasi data sektoral instansi terintegrasi Google Sheets otomatis memanfaatkan Google Apps Script.',
                'github'      => '#',
                'demo_status' => 'maintenance',
                'icon'        => 'fa-file-excel'
            ],
            [
                'title'       => 'WhatsApp Gateway & Notification System',
                'description' => 'Engine automasi broadcast notifikasi massal untuk tagihan PBB, pengumuman warga, dan integrasi layanan mandiri.',
                'github'      => '#',
                'demo_status' => 'maintenance',
                'icon'        => 'fa-comments'
            ]
        ];

        return view('landing_page', $data);
    }
}
