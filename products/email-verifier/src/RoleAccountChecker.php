<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

final class RoleAccountChecker
{
    private const ROLES = [
        'admin', 'administrator', 'abuse', 'billing', 'compliance', 'devnull',
        'dns', 'ftp', 'hostmaster', 'info', 'inoc', 'ispfeedback', 'ispsupport',
        'list-request', 'list', 'maildaemon', 'mailer-daemon', 'marketing',
        'noc', 'no-reply', 'noreply', 'null', 'pe', 'phishing', 'postmaster',
        'privacy', 'registrar', 'root', 'security', 'spam', 'support', 'sysadmin',
        'tech', 'undisclosed-recipients', 'unsubscribe', 'usenet', 'uucp',
        'webmaster', 'www', 'sales', 'contact', 'help', 'office',
    ];

    public function isRoleAccount(?string $username): bool
    {
        if ($username === null || $username === '') {
            return false;
        }
        $user = strtolower($username);
        return in_array($user, self::ROLES, true);
    }
}
