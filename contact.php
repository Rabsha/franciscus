<?php
/**
 * Booking enquiry endpoint.
 * Validates the form, stores a copy in storage/enquiries.csv and returns the WhatsApp link.
 */
require __DIR__ . '/includes/config.php';

header('Content-Type: application/json; charset=utf-8');

function respond(int $code, array $body): void
{
    http_response_code($code);
    echo json_encode($body);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, ['ok' => false, 'error' => 'Method not allowed']);
}

// Honeypot: bots fill hidden fields.
if (!empty($_POST['website'])) {
    respond(200, ['ok' => true]);
}

$clean = static fn(string $key, int $max = 200): string =>
    mb_substr(trim(strip_tags((string) ($_POST[$key] ?? ''))), 0, $max);

$data = [
    'name'    => $clean('name', 100),
    'company' => $clean('company', 120),
    'email'   => $clean('email', 150),
    'date'    => $clean('date', 20),
    'type'    => $clean('type', 40),
    'message' => $clean('message', 3000),
];

$errors = [];
if (mb_strlen($data['name']) < 2) {
    $errors['name'] = 'Please enter your name.';
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email.';
}
if (mb_strlen($data['message']) < 10) {
    $errors['message'] = 'Please tell a little more.';
}
if ($errors) {
    respond(422, ['ok' => false, 'errors' => $errors]);
}

$dir = __DIR__ . '/storage';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}
$file = $dir . '/enquiries.csv';
$isNew = !file_exists($file);
if ($fh = fopen($file, 'a')) {
    flock($fh, LOCK_EX);
    if ($isNew) {
        fputcsv($fh, ['received', 'name', 'company', 'email', 'date', 'type', 'message', 'ip']);
    }
    fputcsv($fh, [date('c'), ...array_values($data), $_SERVER['REMOTE_ADDR'] ?? '']);
    flock($fh, LOCK_UN);
    fclose($fh);
}

$text = "Hi {$site['first']}! Booking enquiry from your website:\n\n"
    . "*Name:* {$data['name']}\n"
    . ($data['company'] ? "*Agency / Brand:* {$data['company']}\n" : '')
    . "*Email:* {$data['email']}\n"
    . "*Project:* {$data['type']}\n"
    . ($data['date'] ? "*Date:* {$data['date']}\n" : '')
    . "\n{$data['message']}";

respond(200, [
    'ok'       => true,
    'whatsapp' => 'https://wa.me/' . $site['whatsapp'] . '?text=' . rawurlencode($text),
]);
