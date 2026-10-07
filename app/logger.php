<?php

declare(strict_types=1);

function ek_log(string $level, string $message, array $context = []): void
{
    $dir = (string) (require __DIR__ . '/config.php')['paths']['logs'];
    if (!is_dir($dir)) {
        mkdir($dir, 0750, true);
    }
    $line = json_encode([
        'ts' => gmdate('c'),
        'level' => $level,
        'message' => $message,
        'context' => $context,
    ], JSON_UNESCAPED_SLASHES);
    file_put_contents($dir . '/app.log', $line . PHP_EOL, FILE_APPEND | LOCK_EX);
}
