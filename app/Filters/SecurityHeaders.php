<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SecurityHeaders implements FilterInterface
{
    private static ?string $nonce = null;

    public static function getNonce(): string
    {
        if (self::$nonce === null) {
            self::$nonce = base64_encode(random_bytes(16));
        }

        return self::$nonce;
    }

    public function before(RequestInterface $request, $arguments = null)
    {
        // Reset and pre-initialize a fresh cryptographic nonce for each request
        self::$nonce = base64_encode(random_bytes(16));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $response->removeHeader('X-Powered-By');
        if (function_exists('header_remove')) {
            @header_remove('X-Powered-By');
        }

        $nonce = self::getNonce();
        $isHttps = self::isHttpsRequest();

        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-Frame-Options', 'DENY');
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->setHeader('Cross-Origin-Opener-Policy', 'same-origin-allow-popups');
        $response->setHeader('Cross-Origin-Resource-Policy', 'same-origin');
        $response->setHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=(), payment=()');

        if ($isHttps) {
            $response->setHeader('Strict-Transport-Security', 'max-age=31536000');
        }

        $path = ltrim($request->getUri()->getPath(), '/');
        $isAdminOrAuth = str_starts_with($path, 'admin') || str_starts_with($path, 'auth');

        if ($isAdminOrAuth) {
            $directives = [
                "default-src 'self'",
                "base-uri 'self'",
                "frame-ancestors 'none'",
                "object-src 'none'",
                "form-action 'self'",
                "script-src 'self' 'unsafe-inline' 'nonce-{$nonce}' https://cdn.jsdelivr.net https://cdn.ckeditor.com https://challenges.cloudflare.com",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com",
                "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com data:",
                "img-src 'self' data: blob:",
                "connect-src 'self' https://challenges.cloudflare.com",
                "frame-src https://challenges.cloudflare.com",
                "manifest-src 'self'",
                "worker-src 'self'",
            ];
        } else {
            $directives = [
                "default-src 'none'",
                "base-uri 'self'",
                "frame-ancestors 'none'",
                "object-src 'none'",
                "form-action 'self'",
                "script-src 'self' 'nonce-{$nonce}' https://cdn.jsdelivr.net",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com",
                "font-src 'self' https://fonts.gstatic.com https://cdnjs.cloudflare.com data:",
                "img-src 'self' data: blob:",
                "connect-src 'self'",
                "manifest-src 'self'",
                "worker-src 'self'",
            ];
        }

        if ($isHttps) {
            $directives[] = 'upgrade-insecure-requests';
        }

        $response->setHeader('Content-Security-Policy', implode('; ', $directives));

        return $response;
    }

    private static function isHttpsRequest(): bool
    {
        return (! empty($_SERVER['HTTPS']) && strtolower((string) $_SERVER['HTTPS']) !== 'off')
            || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
            || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower((string) $_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https');
    }
}
