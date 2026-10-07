<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    ek_json_response(['ok' => false, 'message' => 'Method not allowed'], 405);
}

if (!ek_rate_limit('contact')) {
    ek_json_response(['ok' => false, 'message' => 'Too many requests. Please try later.'], 429);
}

$token = $_POST['_csrf'] ?? '';
if (!ek_verify_csrf(is_string($token) ? $token : null)) {
    ek_json_response(['ok' => false, 'message' => 'Invalid session token. Refresh and retry.'], 403);
}

// Honeypot
if (!empty($_POST['website'])) {
    ek_json_response(['ok' => true, 'message' => 'Thank you.']);
}

$name = ek_strip_headers(ek_safe_string($_POST['name'] ?? '', 100));
$email = ek_safe_string($_POST['email'] ?? '', 254);
$message = ek_safe_string($_POST['message'] ?? '', 4000);

if ($name === '' || $message === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    ek_json_response(['ok' => false, 'message' => 'Please provide a valid name, email, and message.'], 400);
}

$recipient = (string) ek_config('contact_email');
if ($recipient === '' || !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
    ek_log('info', 'contact_received_no_mailer', [
        'name' => $name,
        'email' => $email,
    ]);
    ek_json_response([
        'ok' => true,
        'message' => 'Thanks — your message was received. Email delivery is not configured on this environment yet.',
    ]);
}

$subject = 'Ekbotix contact from ' . $name;
$body = "Name: {$name}\nEmail: {$email}\n\n{$message}\n";
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: Ekbotix Contact <noreply@localhost>',
    'Reply-To: ' . ek_strip_headers($email),
];

$sent = @mail($recipient, $subject, $body, implode("\r\n", $headers));
if (!$sent) {
    ek_log('error', 'contact_mail_failed', ['email' => $email]);
    ek_json_response(['ok' => false, 'message' => 'Unable to send right now. Please try again later.'], 500);
}

ek_json_response(['ok' => true, 'message' => 'Thank you! Your message has been sent.']);
