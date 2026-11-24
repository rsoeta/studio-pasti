<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLogoToWebSettings extends Migration
{
    public function up()
    {
        if (!$this->db->fieldExists('logo', 'web_settings')) {
            $this->forge->addColumn('web_settings', [
                'logo' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'nama_web',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('logo', 'web_settings')) {
            $this->forge->dropColumn('web_settings', 'logo');
        }
    }
}
