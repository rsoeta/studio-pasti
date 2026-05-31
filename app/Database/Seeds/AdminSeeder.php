<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'nama_lengkap'  => 'Kang Rian',
            'username'      => 'admin',
            'email'         => 'admin@studio-pasti.net',
            // Sandi default adalah: Pasti2026!
            'password_hash' => password_hash('Pasti2026!', PASSWORD_BCRYPT),
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        // Eksekusi penyisipan data ke tabel admin_users
        $this->db->table('admin_users')->insert($data);
    }
}
