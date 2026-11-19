<?php

namespace App\Libraries;

class SecurityConfig
{
    private const ENV_MAP = [
        'turnstile_site_key'   => 'TURNSTILE_SITE_KEY',
        'turnstile_secret_key' => 'TURNSTILE_SECRET_KEY',
        'google_client_id'     => 'GOOGLE_CLIENT_ID',
        'google_client_secret' => 'GOOGLE_CLIENT_SECRET',
    ];

    private static function configPath(): string
    {
        return rtrim(WRITEPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'security_config.json';
    }

    private static function envPath(): string
    {
        return rtrim(ROOTPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . '.env';
    }

    private static function readEnvFile(): array
    {
        $path = self::envPath();
        if (!is_file($path) || !is_readable($path)) {
            return [];
        }

        $lines = @file($path, FILE_IGNORE_NEW_LINES);
        if (!is_array($lines)) {
            return [];
        }

        $found   = [];
        $envKeys = array_flip(self::ENV_MAP);

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '' || str_starts_with($trimmed, '#')) {
                continue;
            }
            if (!preg_match('/^([A-Z0-9_]+)\s*=\s*(.*)$/', $trimmed, $m)) {
                continue;
            }
            $envKey = $m[1];
            if (!isset($envKeys[$envKey])) {
                continue;
            }

            $val = trim($m[2]);
            if (
                strlen($val) >= 2 &&
                (($val[0] === "'" && $val[strlen($val) - 1] === "'") ||
                 ($val[0] === '"' && $val[strlen($val) - 1] === '"'))
            ) {
                $val = substr($val, 1, -1);
                $val = str_replace(["\\'", '\\"'], ["'", '"'], $val);
            }

            $found[$envKeys[$envKey]] = trim($val);
        }

        return $found;
    }

    private static function readJsonFile(): array
    {
        $path = self::configPath();
        if (!is_file($path) || !is_readable($path)) {
            return [];
        }

        $raw = @file_get_contents($path);
        if ($raw === false || $raw === '') {
            return [];
        }

        $decoded = json_decode($raw, true);
        return is_array($decoded) ? $decoded : [];
    }

    private static function syncToEnv(array $payload): bool
    {
        $path = self::envPath();
        if (!is_file($path)) {
            $template = rtrim(ROOTPATH, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'env';
            if (is_file($template)) {
                @copy($template, $path);
            }
        }

        if ((is_file($path) && !is_writable($path)) || (!is_file($path) && !is_writable(dirname($path)))) {
            return false;
        }

        $raw     = is_file($path) ? (string) @file_get_contents($path) : '';
        $eol     = str_contains($raw, "\r\n") ? "\r\n" : "\n";
        $lines   = $raw === '' ? [] : preg_split('/\r\n|\r|\n/', $raw);
        $missing = [];

        foreach (self::ENV_MAP as $jsonKey => $envKey) {
            $val        = trim((string) ($payload[$jsonKey] ?? ''));
            $escaped    = str_replace("'", "\\'", $val);
            $newLine    = "{$envKey} = '{$escaped}'";
            $replaced   = false;
            $pattern    = '/^\s*#?\s*' . preg_quote($envKey, '/') . '\s*=/';

            foreach ($lines as $idx => $line) {
                if (preg_match($pattern, $line)) {
                    if (!$replaced) {
                        $lines[$idx] = $newLine;
                        $replaced    = true;
                    } else {
                        unset($lines[$idx]);
                    }
                }
            }

            if (!$replaced) {
                $missing[] = $newLine;
            }
        }

        $lines = array_values($lines);

        if ($missing !== []) {
            if ($lines !== [] && trim((string) end($lines)) !== '') {
                $lines[] = '';
            }
            $hasHeader = false;
            foreach ($lines as $line) {
                if (str_contains($line, 'SECURITY: CLOUDFLARE TURNSTILE & GOOGLE OAUTH 2.0')) {
                    $hasHeader = true;
                    break;
                }
            }
            if (!$hasHeader) {
                $lines[] = '#--------------------------------------------------------------------';
                $lines[] = '# SECURITY: CLOUDFLARE TURNSTILE & GOOGLE OAUTH 2.0';
                $lines[] = '#--------------------------------------------------------------------';
            }
            foreach ($missing as $line) {
                $lines[] = $line;
            }
        }

        $content = implode($eol, $lines) . $eol;
        return @file_put_contents($path, $content, LOCK_EX) !== false;
    }

    public static function get(): array
    {
        $envFile = self::readEnvFile();
        $json    = self::readJsonFile();
        $result  = [];

        foreach (self::ENV_MAP as $jsonKey => $envKey) {
            if (array_key_exists($jsonKey, $envFile) && $envFile[$jsonKey] !== '') {
                $result[$jsonKey] = $envFile[$jsonKey];
            } elseif (array_key_exists($jsonKey, $json)) {
                $result[$jsonKey] = trim((string) $json[$jsonKey]);
            } else {
                $result[$jsonKey] = trim((string) env($envKey, ''));
            }
        }

        return $result;
    }

    public static function save(array $input): bool
    {
        $current = self::get();
        $payload = [];

        foreach (array_keys(self::ENV_MAP) as $key) {
            $payload[$key] = array_key_exists($key, $input)
                ? trim((string) $input[$key])
                : ($current[$key] ?? '');
        }

        $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $jsonSaved = $json !== false && @file_put_contents(self::configPath(), $json . "\n", LOCK_EX) !== false;
        $envSaved  = self::syncToEnv($payload);

        return $jsonSaved || $envSaved;
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
