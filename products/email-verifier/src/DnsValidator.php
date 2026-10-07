<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

final class DnsValidator
{
    public function __construct(private int $timeoutSeconds = 5)
    {
    }

    public function lookupMx(string $domain): array
    {
        $domain = strtolower(rtrim($domain, '.'));
        if ($domain === '' || !preg_match('/^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,}$/i', $domain)) {
            return ['accepts_mail' => false, 'records' => [], 'error' => 'invalid_domain'];
        }

        $previous = null;
        if (function_exists('dns_get_record')) {
            // dns_get_record does not expose a per-call timeout portably; rely on OS resolver.
            $mx = @dns_get_record($domain, DNS_MX) ?: [];
            $hosts = [];
            usort($mx, static fn ($a, $b) => ($a['pri'] ?? 0) <=> ($b['pri'] ?? 0));
            foreach ($mx as $row) {
                if (!empty($row['target'])) {
                    $hosts[] = rtrim((string) $row['target'], '.') . '.';
                }
            }
            if ($hosts) {
                return ['accepts_mail' => true, 'records' => $hosts, 'error' => null];
            }
        }

        $hosts = [];
        $weights = [];
        if (@getmxrr($domain, $hosts, $weights)) {
            array_multisort($weights, $hosts);
            $records = array_map(static fn ($h) => rtrim($h, '.') . '.', $hosts);
            return ['accepts_mail' => count($records) > 0, 'records' => $records, 'error' => null];
        }

        // Fallback: some domains accept mail at the A record (rare); treat as no MX.
        return ['accepts_mail' => false, 'records' => [], 'error' => null];
    }
}
