<?php

declare(strict_types=1);

namespace Ekbotix\EmailVerifier;

final class SyntaxValidator
{
    public function validate(string $email): array
    {
        $email = trim($email);
        $email = preg_replace('/\s+/', '', $email) ?? $email;
        $email = strtolower($email);

        $isValid = (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
        $username = null;
        $domain = null;
        $suggestion = null;

        if (str_contains($email, '@')) {
            [$username, $domain] = array_pad(explode('@', $email, 2), 2, null);
        }

        if ($domain) {
            $domain = rtrim($domain, '.');
            // Basic common typo suggestion (not a full mailcheck engine)
            $common = [
                'gmial.com' => 'gmail.com',
                'gmal.com' => 'gmail.com',
                'hotnail.com' => 'hotmail.com',
                'yaho.com' => 'yahoo.com',
            ];
            if (isset($common[$domain])) {
                $suggestion = ($username ?? '') . '@' . $common[$domain];
            }
        }

        if ($username === null || $domain === null || $username === '' || $domain === '') {
            $isValid = false;
        }

        return [
            'normalized' => $email,
            'is_valid_syntax' => $isValid,
            'username' => $username,
            'domain' => $domain,
            'suggestion' => $suggestion,
        ];
    }
}
