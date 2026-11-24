<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class WebSettingModel extends Model
{
    public const DEFAULT_LOGO = 'PASTI - Icon.png';
    public const LOGO_UPLOAD_SUBDIR = 'uploads/branding';

    protected $table            = 'web_settings';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['nama_web', 'logo', 'nomor_wa', 'teks_hero_judul', 'teks_hero_deskripsi', 'teks_footer'];

    // Kita matikan timestamps karena sudah dihandle otomatis oleh MySQL ON UPDATE CURRENT_TIMESTAMP
    protected $useTimestamps    = false;

    private static ?array $cachedSettings = null;

    /**
     * Nilai default pengaturan website apabila tabel web_settings belum terisi.
     */
    public static function defaultSettings(): array
    {
        return [
            'nama_web'            => 'Studio PASTI',
            'logo'                => null,
            'nomor_wa'            => '628xxxxxxxxxx',
            'teks_hero_judul'     => 'Prima Automasi Sistem Teknologi Informasi',
            'teks_hero_deskripsi' => 'Sistem sedang dalam konfigurasi awal.',
            'teks_footer'         => '© 2026 Studio PASTI',
        ];
    }

    /**
     * Menghapus cache pengaturan dalam memori untuk request saat ini.
     */
    public static function clearCache(): void
    {
        self::$cachedSettings = null;
    }

    /**
     * Mengambil pengaturan web dari parameter atau sekali query per request dengan fallback aman.
     */
    public static function getCached(?array $settings = null): array
    {
        if ($settings !== null && $settings !== []) {
            return $settings;
        }

        if (self::$cachedSettings !== null) {
            return self::$cachedSettings;
        }

        try {
            $row = (new self())->first();
            self::$cachedSettings = is_array($row) && $row !== [] ? $row : self::defaultSettings();
        } catch (\Throwable $e) {
            self::$cachedSettings = self::defaultSettings();
        }

        return self::$cachedSettings;
    }

    /**
     * Direktori fisik penyimpanan file logo website.
     */
    public static function getLogoUploadDir(): string
    {
        $base = defined('FCPATH') ? FCPATH : ROOTPATH . 'public';

        return rtrim($base, '/\\') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'branding';
    }

    /**
     * Memastikan apakah logo kustom aktif dan file fisiknya tersedia di disk.
     */
    public static function hasCustomLogo(?array $settings = null): bool
    {
        $cfg  = self::getCached($settings);
        $logo = trim((string) ($cfg['logo'] ?? ''));

        if ($logo === '') {
            return false;
        }

        return is_file(self::getLogoUploadDir() . DIRECTORY_SEPARATOR . basename($logo));
    }

    /**
     * Menghasilkan URL logo website aktif (kustom atau default).
     */
    public static function getLogoUrl(?array $settings = null): string
    {
        if (self::hasCustomLogo($settings)) {
            $cfg  = self::getCached($settings);
            $path = self::LOGO_UPLOAD_SUBDIR . '/' . basename((string) $cfg['logo']);

            return function_exists('base_url') ? base_url($path) : '/' . $path;
        }

        return function_exists('base_url') ? base_url(self::DEFAULT_LOGO) : '/' . self::DEFAULT_LOGO;
    }

    /**
     * Mendeteksi tipe MIME gambar berdasarkan ekstensi logo aktif.
     */
    public static function getLogoMime(?array $settings = null): string
    {
        if (!self::hasCustomLogo($settings)) {
            return 'image/png';
        }

        $cfg = self::getCached($settings);
        $ext = strtolower((string) pathinfo(basename((string) ($cfg['logo'] ?? '')), PATHINFO_EXTENSION));

        return match ($ext) {
            'webp'       => 'image/webp',
            'jpg', 'jpeg' => 'image/jpeg',
            default      => 'image/png',
        };
    }

    /**
     * Menghasilkan URL Apple Touch Icon (mengikuti logo kustom bila ada).
     */
    public static function getAppleTouchIconUrl(?array $settings = null): string
    {
        if (self::hasCustomLogo($settings)) {
            return self::getLogoUrl($settings);
        }

        return function_exists('base_url') ? base_url('icons/icon-192x192.png') : '/icons/icon-192x192.png';
    }

    /**
     * Memastikan kolom `logo` tersedia pada tabel `web_settings`.
     */
    public static function ensureLogoColumn(): bool
    {
        try {
            $db = Database::connect();
            if ($db->fieldExists('logo', 'web_settings')) {
                return true;
            }

            $forge = Database::forge();
            $forge->addColumn('web_settings', [
                'logo' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'nama_web',
                ],
            ]);

            return $db->fieldExists('logo', 'web_settings');
        } catch (\Throwable $e) {
            return false;
        }
    }
}
