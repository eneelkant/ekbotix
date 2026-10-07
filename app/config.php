<?php

declare(strict_types=1);

/**
 * Ekbotix application configuration.
 * Secrets belong in environment variables — never commit credentials.
 */

return [
    'app_name' => 'Ekbotix',
    'person_name' => 'Neelkant E.',
    'person_full' => 'Neelkant Ekbote',
    'title' => 'AI & Marketing Automation Specialist',
    'tagline' => 'Building intelligent systems that turn repetitive work into automated workflows.',
    'base_url' => rtrim(getenv('EKBOTIX_BASE_URL') ?: '', '/'),
    'env' => getenv('EKBOTIX_ENV') ?: 'production',
    'contact_email' => getenv('EKBOTIX_CONTACT_EMAIL') ?: '',
    'github' => 'https://github.com/eneelkant',
    'linkedin' => getenv('EKBOTIX_LINKEDIN') ?: '',
    'timezone' => 'UTC',
    'session_name' => 'ekbotix_sess',
    'rate_limit' => [
        'contact' => ['max' => 5, 'window' => 3600],
        'verify' => ['max' => 20, 'window' => 3600],
    ],
    'paths' => [
        'root' => dirname(__DIR__),
        'storage' => dirname(__DIR__) . '/storage',
        'logs' => dirname(__DIR__) . '/storage/logs',
        'rate_limits' => dirname(__DIR__) . '/storage/rate-limits',
    ],
];
