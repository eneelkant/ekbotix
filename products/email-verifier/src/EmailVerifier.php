<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

final class EmailVerifier
{
    private array $config;
    private SyntaxValidator $syntax;
    private DnsValidator $dns;
    private SmtpValidator $smtp;
    private DisposableChecker $disposable;
    private RoleAccountChecker $roles;
    private ResultFormatter $formatter;

    public function __construct(?array $config = null)
    {
        $this->config = $config ?? require dirname(__DIR__) . '/config/config.php';
        $this->syntax = new SyntaxValidator();
        $this->dns = new DnsValidator((int) $this->config['dns_timeout']);
        $this->smtp = new SmtpValidator(
            (int) $this->config['smtp_timeout'],
            (string) $this->config['smtp_from_domain'],
            (bool) $this->config['catch_all_probe']
        );
        $this->disposable = new DisposableChecker();
        $this->roles = new RoleAccountChecker();
        $this->formatter = new ResultFormatter();
    }

    public function verify(string $toEmail): array
    {
        $syntax = $this->syntax->validate($toEmail);
        $misc = [
            'is_disposable' => $this->disposable->isDisposable($syntax['domain'] ?? null),
            'is_role_account' => $this->roles->isRoleAccount($syntax['username'] ?? null),
        ];

        if (!$syntax['is_valid_syntax']) {
            $mx = ['accepts_mail' => false, 'records' => []];
            $smtp = [
                'can_connect_smtp' => false,
                'is_deliverable' => null,
                'is_catch_all' => null,
                'is_disabled' => null,
                'skipped' => true,
                'skip_reason' => 'invalid_syntax',
            ];
            $reachable = $this->formatter->classify($syntax, $mx, $smtp, $misc);
            return $this->formatter->format($syntax['normalized'], $syntax, $mx, $smtp, $misc, $reachable);
        }

        $mx = $this->dns->lookupMx((string) $syntax['domain']);

        if (!$mx['accepts_mail'] || empty($this->config['smtp_enabled'])) {
            $smtp = [
                'can_connect_smtp' => false,
                'is_deliverable' => null,
                'is_catch_all' => null,
                'is_disabled' => null,
                'skipped' => true,
                'skip_reason' => !$mx['accepts_mail'] ? 'no_mx' : 'smtp_disabled',
            ];
            $reachable = $this->formatter->classify($syntax, $mx, $smtp, $misc);
            return $this->formatter->format($syntax['normalized'], $syntax, $mx, $smtp, $misc, $reachable);
        }

        $smtp = $this->smtp->verify(
            $syntax['normalized'],
            $mx['records'] ?? [],
            (string) $syntax['username']
        );

        $reachable = $this->formatter->classify($syntax, $mx, $smtp, $misc);
        return $this->formatter->format($syntax['normalized'], $syntax, $mx, $smtp, $misc, $reachable);
    }
}
