
<?php
session_start();

require_once __DIR__ . '/config/database.php';

$paymentConfig = require __DIR__ . '/config/payment.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST method required']);
    exit;
}

$keyId = $paymentConfig['key_id'] ?? '';
$keySecret = $paymentConfig['key_secret'] ?? '';

if (
    $keyId === '' ||
    $keySecret === '' ||
    strpos($keyId, 'YOUR_') !== false ||
    strpos($keySecret, 'YOUR_') !== false
) {
    http_response_code(500);
    echo json_encode(['error' => 'Configure Razorpay test credentials first']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$amount = filter_var($input['amount'] ?? null, FILTER_VALIDATE_INT);
$service = trim($input['service'] ?? '');

if (!$amount || $amount < 100 || $amount > 100000000 || $service === '') {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid amount or service']);
    exit;
}

// Do not trust the amount sent by the browser in production.
// Calculate it on the server from your approved package list.
if (!extension_loaded('curl')) {
    http_response_code(500);
    echo json_encode(['error' => 'PHP cURL extension is required']);
    exit;
}

$payload = [
    'amount' => $amount,
    'currency' => $paymentConfig['currency'] ?? 'INR',
    'receipt' => 'tabish_' . bin2hex(random_bytes(8)),
    'notes' => [
        'service' => substr($service, 0, 150),
    ],
];

$ch = curl_init('https://api.razorpay.com/v1/orders');

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_USERPWD => $keyId . ':' . $keySecret,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => 30,
]);

$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

curl_close($ch);

if ($response === false || $status < 200 || $status >= 300) {
    error_log('Razorpay order creation failed: ' . $error);
    http_response_code(502);
    echo json_encode(['error' => 'Could not create payment order']);
    exit;
}

$order = json_decode($response, true);

if (empty($order['id'])) {
    http_response_code(502);
    echo json_encode(['error' => 'Invalid response from payment provider']);
    exit;
}

echo json_encode([
    'order_id' => $order['id'],
    'amount' => $order['amount'],
    'currency' => $order['currency'],
    'key_id' => $keyId,
]);
