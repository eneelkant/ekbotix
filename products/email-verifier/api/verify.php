<?php

declare(strict_types=1);

require_once dirname(__DIR__, 3) . '/app/helpers.php';
require_once dirname(__DIR__, 3) . '/app/security.php';
require_once dirname(__DIR__) . '/src/autoload.php';

use Ekbotix\EmailVerifier\EmailVerifier;

$config = ek_config();
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name((string) $config['session_name']);
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
    ]);
}

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    ek_json_response(['error' => 'Method not allowed. Use POST.'], 405);
}

if (!ek_rate_limit('verify')) {
    ek_json_response(['error' => 'Rate limit exceeded. Try again later.'], 429);
}

$csrf = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ($_POST['_csrf'] ?? '');
$raw = file_get_contents('php://input') ?: '';
$payload = [];
if ($raw !== '') {
    $decoded = json_decode($raw, true);
    if (is_array($decoded)) {
        $payload = $decoded;
        if (isset($decoded['_csrf'])) {
            $csrf = $decoded['_csrf'];
        }
    }
}
if ($payload === [] && !empty($_POST)) {
    $payload = $_POST;
}

if (!ek_verify_csrf(is_string($csrf) ? $csrf : null)) {
    ek_json_response(['error' => 'Invalid CSRF token.'], 403);
}

$email = ek_safe_string($payload['to_email'] ?? '', 254);
if ($email === '') {
    ek_json_response(['error' => 'Missing to_email.'], 400);
}

// Reject host/port injection attempts — only an email address is accepted.
if (preg_match('/[\r\n\0]/', $email) || str_contains($email, '://')) {
    ek_json_response(['error' => 'Invalid input.'], 400);
}

try {
    $verifier = new EmailVerifier();
    $result = $verifier->verify($email);
    ek_log('info', 'email_verify', [
        'input' => $result['input'],
        'reachable' => $result['is_reachable'],
        'ip' => ek_client_ip(),
    ]);
    ek_json_response($result);
} catch (Throwable $e) {
    ek_log('error', 'email_verify_exception', ['message' => $e->getMessage()]);
    ek_json_response([
        'input' => $email,
        'is_reachable' => 'unknown',
        'error' => 'Verification failed due to an internal error.',
    ], 500);
}
