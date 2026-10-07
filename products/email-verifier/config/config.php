<?php

declare(strict_types=1);

return [
    'dns_timeout' => 5,
    'smtp_timeout' => 8,
    'smtp_enabled' => filter_var(getenv('EKBOTIX_SMTP_VERIFY') ?: 'true', FILTER_VALIDATE_BOOLEAN),
    'smtp_from_domain' => getenv('EKBOTIX_SMTP_HELO') ?: 'ekbotix.local',
    'smtp_ports' => [25],
    'max_email_length' => 254,
    'catch_all_probe' => true,
];
