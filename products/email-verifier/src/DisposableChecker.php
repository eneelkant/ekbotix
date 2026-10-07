<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

final class DisposableChecker
{
    /** @var array<string, true> */
    private array $set;

    public function __construct(?array $domains = null)
    {
        $list = $domains ?? require dirname(__DIR__) . '/data/disposable-domains.php';
        $this->set = [];
        foreach ($list as $d) {
            $this->set[strtolower((string) $d)] = true;
        }
    }

    public function isDisposable(?string $domain): bool
    {
        if ($domain === null || $domain === '') {
            return false;
        }
        $domain = strtolower(rtrim($domain, '.'));
        if (isset($this->set[$domain])) {
            return true;
        }
        // Check parent domains (e.g. mail.guerrillamail.com)
        $parts = explode('.', $domain);
        while (count($parts) > 2) {
            array_shift($parts);
            $candidate = implode('.', $parts);
            if (isset($this->set[$candidate])) {
                return true;
            }
        }
        return false;
    }
}
