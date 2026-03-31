<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

// Get JSON data
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
    exit;
}

// Validate inputs
$name = isset($input['name']) ? trim($input['name']) : '';
$email = isset($input['email']) ? trim($input['email']) : '';
$message = isset($input['message']) ? trim($input['message']) : '';

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'All fields are required'
    ]);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid email format'
    ]);
    exit;
}

// Load credentials - Try environment variables first, then .env file
$telegram_bot_token = getenv('TELEGRAM_BOT_TOKEN');
$telegram_chat_id = getenv('TELEGRAM_CHAT_ID');

// If environment variables not set, try .env file
if (!$telegram_bot_token || !$telegram_chat_id) {
    $env_file = __DIR__ . '/.env';
    if (file_exists($env_file)) {
        $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                if ($key === 'TELEGRAM_BOT_TOKEN') {
                    $telegram_bot_token = $value;
                } elseif ($key === 'TELEGRAM_CHAT_ID') {
                    $telegram_chat_id = $value;
                }
            }
        }
    }
}

// Check if credentials are configured
if (empty($telegram_bot_token) || empty($telegram_chat_id) || 
    strpos($telegram_bot_token, 'your_') === 0 || strpos($telegram_chat_id, 'your_') === 0) {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Message received! (Telegram not configured yet)'
    ]);
    exit;
}

// Format message for Telegram
$sender_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'Unknown';
$telegram_message = "📨 New Portfolio Message\n\n";
$telegram_message .= "👤 Name: " . htmlspecialchars($name) . "\n";
$telegram_message .= "📧 Email: " . htmlspecialchars($email) . "\n";
$telegram_message .= "🌐 IP Address: " . htmlspecialchars($sender_ip) . "\n\n";
$telegram_message .= "💬 Message:\n" . htmlspecialchars($message);

// Prepare Telegram API request
$telegram_url = "https://api.telegram.org/bot" . $telegram_bot_token . "/sendMessage";
$telegram_data = [
    'chat_id' => $telegram_chat_id,
    'text' => $telegram_message
];

// Send using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $telegram_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($telegram_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
$response = curl_exec($ch);

// DEBUG: Write response to file
file_put_contents('telegram_debug.txt', "URL: $telegram_url\n", FILE_APPEND);
file_put_contents('telegram_debug.txt', "Response: $response\n\n", FILE_APPEND);

if ($response !== false) {
    $result = json_decode($response, true);
    if (is_array($result) && isset($result['ok']) && $result['ok'] === true) {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Message sent to Telegram!'
        ]);
        exit;
    } else {
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => 'Message received!'
        ]);
        exit;
    }
} else {
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Message received!'
    ]);
    exit;
}
?>
?>
