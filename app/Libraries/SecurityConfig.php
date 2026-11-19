<?php

namespace App\Libraries;

class SecurityConfig
{
    private const KEYS = [
        'turnstile_site_key',
        'turnstile_secret_key',
        'google_client_id',
        'google_client_secret',
    ];

    private static function configPath(): string
    {
        return rtrim(WRITEPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'security_config.json';
    }

    public static function get(): array
    {
        $defaults = [
            'turnstile_site_key'   => (string) env('TURNSTILE_SITE_KEY', ''),
            'turnstile_secret_key' => (string) env('TURNSTILE_SECRET_KEY', ''),
            'google_client_id'     => (string) env('GOOGLE_CLIENT_ID', ''),
            'google_client_secret' => (string) env('GOOGLE_CLIENT_SECRET', ''),
        ];

        $path = self::configPath();
        if (!is_file($path) || !is_readable($path)) {
            return $defaults;
        }

        $raw = @file_get_contents($path);
        if ($raw === false || $raw === '') {
            return $defaults;
        }

        $decoded = json_decode($raw, true);
        if (!is_array($decoded)) {
            return $defaults;
        }

        foreach (self::KEYS as $key) {
            if (array_key_exists($key, $decoded)) {
                $defaults[$key] = trim((string) $decoded[$key]);
            }
        }

        return $defaults;
    }

    public static function save(array $input): bool
    {
        $current = self::get();
        $payload = [];

        foreach (self::KEYS as $key) {
            $payload[$key] = array_key_exists($key, $input)
                ? trim((string) $input[$key])
                : ($current[$key] ?? '');
        }

        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        if ($json === false) {
            return false;
        }

        return @file_put_contents(self::configPath(), $json . "\n", LOCK_EX) !== false;
    }

    public static function isTurnstileEnabled(): bool
    {
        $cfg = self::get();
        return $cfg['turnstile_site_key'] !== '' && $cfg['turnstile_secret_key'] !== '';
    }

    public static function isGoogleOAuthEnabled(): bool
    {
        $cfg = self::get();
        return $cfg['google_client_id'] !== '' && $cfg['google_client_secret'] !== '';
    }
}
