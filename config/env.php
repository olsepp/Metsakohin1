<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Validate required variables exist
$dotenv->required([
    'SMTP_HOST',
    'SMTP_USERNAME',
    'SMTP_PASSWORD',
    'SMTP_PORT',
    'MAIL_FROM',
    'MAIL_TO',
    'CAPTCHA_SECRET'
])->notEmpty();

// Helper function to get environment variables
function env($key, $default = null) {
    return $_ENV[$key] ?? getenv($key) ?? $default;
}
