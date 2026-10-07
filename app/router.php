<?php

declare(strict_types=1);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/security.php';

$config = ek_config();
date_default_timezone_set((string) $config['timezone']);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_name((string) $config['session_name']);
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
    ]);
}

ek_security_headers();

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?: '/';
$path = rawurldecode($path);
$path = '/' . trim($path, '/');
if ($path !== '/') {
    $path = rtrim($path, '/');
} else {
    $path = '/';
}

// Static files under /assets are served by the web server; built-in server handles via router script.
$GLOBALS['ek_route'] = $path;

$routes = [
    '/' => 'home',
    '/about' => 'about',
    '/experience' => 'experience',
    '/projects' => 'projects',
    '/expertise' => 'expertise',
    '/ai-lab' => 'ai-lab',
    '/products' => 'products',
    '/products/email-verifier' => 'products-email-verifier',
    '/insights' => 'insights',
    '/resume' => 'resume',
    '/contact' => 'contact',
    '/404' => '404',
    '/500' => '500',
];

// Dynamic project detail
if (preg_match('#^/projects/([a-z0-9\-]+)$#', $path, $m)) {
    $GLOBALS['ek_project_slug'] = $m[1];
    ek_render('project');
    return;
}

// Dynamic insight article
if (preg_match('#^/insights/([a-z0-9\-]+)$#', $path, $m)) {
    $GLOBALS['ek_article_slug'] = $m[1];
    ek_render('insight');
    return;
}

// Contact form endpoint
if ($path === '/contact/submit') {
    require __DIR__ . '/../pages/contact-submit.php';
    return;
}

// Email verifier API (also reachable via product path)
if ($path === '/products/email-verifier/api/verify' || $path === '/products/email-verifier/api/verify.php') {
    require __DIR__ . '/../products/email-verifier/api/verify.php';
    return;
}

if (isset($routes[$path])) {
    ek_render($routes[$path]);
    return;
}

http_response_code(404);
ek_render('404');
