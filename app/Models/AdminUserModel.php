<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminUserModel extends Model
{
    protected $table            = 'admin_users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';

    // Mendaftarkan kolom yang diizinkan untuk dimanipulasi data
    protected $allowedFields    = ['nama_lengkap', 'username', 'email', 'password_hash', 'last_login'];

    // Biarkan database yang mengatur timestamp otomatis untuk baris ini
    protected $useTimestamps    = false;
}
