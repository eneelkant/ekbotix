<?php

declare(strict_types=1);

/**
 * PHP built-in server router:
 * php -S 0.0.0.0:8080 router-dev.php
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$file = __DIR__ . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';
