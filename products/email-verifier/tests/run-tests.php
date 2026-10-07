<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/src/autoload.php';

use Ekbotix\EmailVerifier\DisposableChecker;
use Ekbotix\EmailVerifier\EmailVerifier;
use Ekbotix\EmailVerifier\ResultFormatter;
use Ekbotix\EmailVerifier\RoleAccountChecker;
use Ekbotix\EmailVerifier\SyntaxValidator;

$passed = 0;
$failed = 0;

function assert_true(bool $cond, string $name): void
{
    global $passed, $failed;
    if ($cond) {
        echo "PASS  {$name}\n";
        $passed++;
    } else {
        echo "FAIL  {$name}\n";
        $failed++;
    }
}

$syntax = new SyntaxValidator();

$s = $syntax->validate('someone@example.com');
assert_true($s['is_valid_syntax'] === true, 'valid email syntax');
assert_true($s['username'] === 'someone' && $s['domain'] === 'example.com', 'username/domain parse');

$s = $syntax->validate('not-an-email');
assert_true($s['is_valid_syntax'] === false, 'malformed email');

$s = $syntax->validate('missing-at-sign.com');
assert_true($s['is_valid_syntax'] === false, 'missing @');

$s = $syntax->validate('a@' . str_repeat('x', 300) . '.com');
assert_true($s['is_valid_syntax'] === false, 'oversized / invalid domain syntax');

$roles = new RoleAccountChecker();
assert_true($roles->isRoleAccount('admin') === true, 'role account admin');
assert_true($roles->isRoleAccount('neelkant') === false, 'non-role account');

$disp = new DisposableChecker();
assert_true($disp->isDisposable('mailinator.com') === true, 'disposable domain');
assert_true($disp->isDisposable('gmail.com') === false, 'non-disposable domain');

$formatter = new ResultFormatter();
$reachable = $formatter->classify(
    ['is_valid_syntax' => false],
    ['accepts_mail' => false],
    ['can_connect_smtp' => false, 'skipped' => true],
    ['is_disposable' => false]
);
assert_true($reachable === 'invalid', 'classify invalid syntax');

$reachable = $formatter->classify(
    ['is_valid_syntax' => true],
    ['accepts_mail' => true],
    ['can_connect_smtp' => false, 'skipped' => true, 'is_deliverable' => null, 'is_catch_all' => null],
    ['is_disposable' => true, 'is_role_account' => false]
);
assert_true($reachable === 'risky', 'classify disposable as risky');

// Integration-style: invalid domain should be invalid (no MX)
$verifier = new EmailVerifier([
    'dns_timeout' => 3,
    'smtp_timeout' => 3,
    'smtp_enabled' => false, // force skip SMTP for deterministic CI
    'smtp_from_domain' => 'ekbotix.test',
    'smtp_ports' => [25],
    'max_email_length' => 254,
    'catch_all_probe' => false,
]);

$r = $verifier->verify('bad@@example');
assert_true($r['is_reachable'] === 'invalid', 'verify malformed → invalid');

$r = $verifier->verify('admin@mailinator.com');
assert_true($r['misc']['is_disposable'] === true, 'verify disposable flag');
assert_true($r['misc']['is_role_account'] === true, 'verify role flag');
assert_true(in_array($r['is_reachable'], ['risky', 'invalid', 'unknown'], true), 'disposable reachable class');

$r = $verifier->verify('someone@this-domain-should-not-exist-ekbotix-xyz.invalid');
assert_true($r['mx']['accepts_mail'] === false, 'no MX for invalid TLD domain');
assert_true($r['is_reachable'] === 'invalid', 'no MX → invalid');

// Valid syntax + real domain without SMTP → unknown
$r = $verifier->verify('test@example.com');
assert_true($r['syntax']['is_valid_syntax'] === true, 'example.com syntax');
assert_true($r['smtp']['skipped'] === true, 'SMTP skipped when disabled');
assert_true(in_array($r['is_reachable'], ['unknown', 'invalid'], true), 'example.com with smtp off');

echo "\n{$passed} passed, {$failed} failed\n";
exit($failed > 0 ? 1 : 0);
