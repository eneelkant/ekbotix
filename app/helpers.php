<?php

declare(strict_types=1);

function ek_config(?string $key = null, mixed $default = null): mixed
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }
    if ($key === null) {
        return $config;
    }
    $parts = explode('.', $key);
    $value = $config;
    foreach ($parts as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return $default;
        }
        $value = $value[$part];
    }
    return $value;
}

function ek_e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function ek_url(string $path = '/'): string
{
    $path = '/' . ltrim($path, '/');
    if ($path === '//') {
        $path = '/';
    }
    $base = (string) ek_config('base_url', '');
    return $base === '' ? $path : $base . ($path === '/' ? '/' : $path);
}

function ek_asset(string $path): string
{
    return ek_url('assets/' . ltrim($path, '/'));
}

function ek_is_active(string $route): bool
{
    $current = $GLOBALS['ek_route'] ?? '/';
    if ($route === '/') {
        return $current === '/';
    }
    return $current === $route || str_starts_with($current, rtrim($route, '/') . '/');
}

function ek_nav_class(string $route): string
{
    return ek_is_active($route) ? ' active' : '';
}

function ek_page_title(?string $title = null): string
{
    $app = (string) ek_config('app_name');
    $person = (string) ek_config('person_name');
    $role = (string) ek_config('title');
    if ($title === null || $title === '') {
        return $person . ' — ' . $role . ' | ' . $app;
    }
    return $title . ' | ' . $app;
}

function ek_meta_description(?string $description = null): string
{
    if ($description) {
        return $description;
    }
    return (string) ek_config('tagline');
}

function ek_csrf_token(): string
{
    if (empty($_SESSION['_csrf'])) {
        $_SESSION['_csrf'] = bin2hex(random_bytes(32));
    }
    return (string) $_SESSION['_csrf'];
}

function ek_csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . ek_e(ek_csrf_token()) . '">';
}

function ek_verify_csrf(?string $token): bool
{
    if ($token === null || empty($_SESSION['_csrf'])) {
        return false;
    }
    return hash_equals((string) $_SESSION['_csrf'], $token);
}

function ek_page(array $vars): void
{
    $GLOBALS['ek_page_vars'] = array_merge($GLOBALS['ek_page_vars'] ?? [], $vars);
}

function ek_render(string $view, array $data = []): void
{
    $GLOBALS['ek_page_vars'] = $data;
    extract($data, EXTR_SKIP);
    $viewFile = ek_config('paths.root') . '/pages/' . $view . '.php';
    if (!is_file($viewFile)) {
        http_response_code(404);
        require ek_config('paths.root') . '/pages/404.php';
        return;
    }
    require $viewFile;
}

function ek_component(string $name, array $data = []): void
{
    if (!empty($GLOBALS['ek_page_vars']) && is_array($GLOBALS['ek_page_vars'])) {
        extract($GLOBALS['ek_page_vars'], EXTR_SKIP);
    }
    extract($data, EXTR_OVERWRITE);
    require ek_config('paths.root') . '/components/' . $name . '.php';
}

function ek_load_data(string $name): array
{
    $file = __DIR__ . '/data/' . $name . '.php';
    if (!is_file($file)) {
        return [];
    }
    $data = require $file;
    return is_array($data) ? $data : [];
}

function ek_json_response(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('X-Content-Type-Options: nosniff');
    echo json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    exit;
}
