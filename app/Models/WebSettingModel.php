<?php

namespace App\Models;

use CodeIgniter\Model;

class WebSettingModel extends Model
{
    protected $table            = 'web_settings';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_web', 'nomor_wa', 'teks_hero_judul', 'teks_hero_deskripsi', 'teks_footer'];

    // Kita matikan timestamps karena sudah dihandle otomatis oleh MySQL ON UPDATE CURRENT_TIMESTAMP
    protected $useTimestamps    = false;
}
