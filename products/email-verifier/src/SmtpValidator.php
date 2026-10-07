<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

/**
 * SMTP probe — never sends a message body.
 * Many hosts block outbound :25; callers must treat failure as unknown.
 */
final class SmtpValidator
{
    public function __construct(
        private int $timeoutSeconds = 8,
        private string $heloDomain = 'ekbotix.local',
        private bool $catchAllProbe = true,
    ) {
    }

    public function verify(string $email, array $mxHosts, string $username): array
    {
        $result = [
            'can_connect_smtp' => false,
            'is_deliverable' => null,
            'is_catch_all' => null,
            'is_disabled' => null,
            'has_full_inbox' => null,
            'skipped' => false,
            'skip_reason' => null,
            'banner' => null,
        ];

        if ($mxHosts === []) {
            $result['skipped'] = true;
            $result['skip_reason'] = 'no_mx';
            return $result;
        }

        $host = rtrim($mxHosts[0], '.');
        // Only connect to resolved MX hostname on port 25 — never user-controlled host/port.
        $errno = 0;
        $errstr = '';
        $fp = @stream_socket_client(
            'tcp://' . $host . ':25',
            $errno,
            $errstr,
            $this->timeoutSeconds,
            STREAM_CLIENT_CONNECT
        );

        if ($fp === false) {
            $result['skipped'] = true;
            $result['skip_reason'] = 'smtp_connect_failed';
            return $result;
        }

        stream_set_timeout($fp, $this->timeoutSeconds);
        $result['can_connect_smtp'] = true;
        $greeting = $this->read($fp);
        $result['banner'] = $greeting;

        $this->command($fp, 'EHLO ' . $this->heloDomain);
        $this->command($fp, 'MAIL FROM:<probe@' . $this->heloDomain . '>');
        $rcpt = $this->command($fp, 'RCPT TO:<' . $email . '>');

        $code = (int) substr($rcpt, 0, 3);
        if ($code === 250 || $code === 251) {
            $result['is_deliverable'] = true;
        } elseif ($code === 550 || $code === 551 || $code === 553) {
            $result['is_deliverable'] = false;
            if (stripos($rcpt, 'disabled') !== false || stripos($rcpt, 'disabled') !== false) {
                $result['is_disabled'] = true;
            }
        } elseif ($code === 452) {
            $result['has_full_inbox'] = true;
            $result['is_deliverable'] = false;
        } else {
            // Ambiguous SMTP responses → do not claim certainty
            $result['is_deliverable'] = null;
        }

        if ($this->catchAllProbe && $result['is_deliverable'] === true) {
            $random = 'ekbotix-catchall-' . bin2hex(random_bytes(6)) . '@' . $this->domainFromEmail($email);
            $catch = $this->command($fp, 'RCPT TO:<' . $random . '>');
            $catchCode = (int) substr($catch, 0, 3);
            $result['is_catch_all'] = ($catchCode === 250 || $catchCode === 251);
        }

        $this->command($fp, 'RSET');
        $this->command($fp, 'QUIT');
        fclose($fp);

        return $result;
    }

    private function domainFromEmail(string $email): string
    {
        $parts = explode('@', $email, 2);
        return $parts[1] ?? 'example.com';
    }

    private function read($fp): string
    {
        $data = '';
        while (($line = fgets($fp, 515)) !== false) {
            $data .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }
        return trim($data);
    }

    private function command($fp, string $cmd): string
    {
        fwrite($fp, $cmd . "\r\n");
        return $this->read($fp);
    }
}
