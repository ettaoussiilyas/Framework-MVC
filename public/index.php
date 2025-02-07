<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Initialize database
require_once __DIR__ . '/../config/database.php';
\App\Config\Database::init();

// Initialize router
$router = new App\Core\Router();

try {
    $response = $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    echo $response;
} catch (\Exception $e) {
    http_response_code(404);
    echo "Error: " . $e->getMessage();
}
