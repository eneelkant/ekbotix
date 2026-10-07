<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/logger.php';

function ek_client_ip(): string
{
    $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
}

function ek_rate_limit(string $bucket, ?string $key = null): bool
{
    $limits = ek_config('rate_limit.' . $bucket, ['max' => 10, 'window' => 3600]);
    $max = (int) ($limits['max'] ?? 10);
    $window = (int) ($limits['window'] ?? 3600);
    $identity = $key ?? ek_client_ip();
    $dir = (string) ek_config('paths.rate_limits');
    if (!is_dir($dir)) {
        mkdir($dir, 0750, true);
    }
    $file = $dir . '/' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $bucket . '_' . $identity) . '.json';
    $now = time();
    $entries = [];
    if (is_file($file)) {
        $raw = file_get_contents($file);
        $decoded = json_decode((string) $raw, true);
        if (is_array($decoded)) {
            $entries = array_values(array_filter(
                $decoded,
                static fn ($ts) => is_int($ts) && ($now - $ts) < $window
            ));
        }
    }
    if (count($entries) >= $max) {
        ek_log('warning', 'rate_limit_exceeded', ['bucket' => $bucket, 'ip' => ek_client_ip()]);
        return false;
    }
    $entries[] = $now;
    file_put_contents($file, json_encode($entries), LOCK_EX);
    return true;
}

function ek_require_post(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
        ek_json_response(['error' => 'Method not allowed'], 405);
    }
}

function ek_safe_string(mixed $value, int $maxLen = 500): string
{
    if (!is_string($value)) {
        return '';
    }
    $value = trim($value);
    if (strlen($value) > $maxLen) {
        $value = substr($value, 0, $maxLen);
    }
    return $value;
}

function ek_strip_headers(string $value): string
{
    return str_replace(["\r", "\n", "%0a", "%0d", "%0A", "%0D"], '', $value);
}

function ek_security_headers(): void
{
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header("Content-Security-Policy: default-src 'self'; img-src 'self' data: https:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'; font-src 'self' data:; connect-src 'self'; frame-ancestors 'self'; base-uri 'self'; form-action 'self'");
    if (($ekEnv = ek_config('env')) === 'production') {
        ini_set('display_errors', '0');
    }
}
