<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

final class ResultFormatter
{
    public function classify(array $syntax, array $mx, array $smtp, array $misc): string
    {
        if (!$syntax['is_valid_syntax']) {
            return 'invalid';
        }
        if (!empty($misc['is_disposable'])) {
            return 'risky';
        }
        if (!$mx['accepts_mail']) {
            return 'invalid';
        }
        if (!empty($smtp['skipped'])) {
            // Connected DNS path OK but SMTP unknown
            return 'unknown';
        }
        if ($smtp['can_connect_smtp'] && $smtp['is_deliverable'] === false && empty($smtp['is_catch_all'])) {
            return 'invalid';
        }
        if ($smtp['can_connect_smtp'] && $smtp['is_deliverable'] === true && $smtp['is_catch_all'] === true) {
            return 'risky';
        }
        if ($smtp['can_connect_smtp'] && $smtp['is_deliverable'] === true && empty($misc['is_role_account'])) {
            return 'safe';
        }
        if ($smtp['can_connect_smtp'] && $smtp['is_deliverable'] === true && !empty($misc['is_role_account'])) {
            return 'risky';
        }
        return 'unknown';
    }

    public function format(
        string $input,
        array $syntax,
        array $mx,
        array $smtp,
        array $misc,
        string $reachable
    ): array {
        return [
            'input' => $input,
            'is_reachable' => $reachable,
            'syntax' => [
                'is_valid_syntax' => (bool) $syntax['is_valid_syntax'],
                'username' => $syntax['username'],
                'domain' => $syntax['domain'],
                'suggestion' => $syntax['suggestion'],
            ],
            'mx' => [
                'accepts_mail' => (bool) $mx['accepts_mail'],
                'records' => $mx['records'] ?? [],
            ],
            'smtp' => [
                'can_connect_smtp' => (bool) ($smtp['can_connect_smtp'] ?? false),
                'is_deliverable' => $smtp['is_deliverable'],
                'is_catch_all' => $smtp['is_catch_all'],
                'is_disabled' => $smtp['is_disabled'],
                'has_full_inbox' => $smtp['has_full_inbox'] ?? null,
                'skipped' => (bool) ($smtp['skipped'] ?? false),
                'skip_reason' => $smtp['skip_reason'] ?? null,
            ],
            'misc' => [
                'is_disposable' => (bool) ($misc['is_disposable'] ?? false),
                'is_role_account' => (bool) ($misc['is_role_account'] ?? false),
            ],
        ];
    }
}
