<?php

require __DIR__ . '/vendor/autoload.php';

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['OPENAI_API_KEY'] ?? '';

echo "API Key (first 20 chars): " . substr($apiKey, 0, 20) . "...\n";
echo "API Key length: " . strlen($apiKey) . "\n";
echo "Starts with: " . substr($apiKey, 0, 8) . "\n\n";

if (empty($apiKey)) {
    echo "ERROR: OPENAI_API_KEY is not set in .env file!\n";
    exit(1);
}

// Test the API
$ch = curl_init('https://api.openai.com/v1/models');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $apiKey,
    'Content-Type: application/json',
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "HTTP Status Code: $httpCode\n";

if ($httpCode === 200) {
    echo "✓ API Key is VALID! The chatbot should work now.\n";
} else {
    echo "✗ API Key is INVALID!\n";
    echo "Response: " . substr($response, 0, 500) . "\n\n";
    echo "Please:\n";
    echo "1. Go to https://platform.openai.com/api-keys\n";
    echo "2. Create a new secret key\n";
    echo "3. Copy the ENTIRE key (including sk-proj- or sk- prefix)\n";
    echo "4. Update OPENAI_API_KEY in your .env file\n";
    echo "5. Run: php artisan config:clear\n";
}
