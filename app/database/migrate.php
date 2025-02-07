<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
$dotenv->load();

// Database connection setup
require_once __DIR__ . '/../../config/database.php';

// Use full class names
require_once __DIR__ . '/migrations/create_users_table.php';
require_once __DIR__ . '/migrations/create_articles_table.php';

$users = new \App\Database\Migrations\CreateUsersTable();
$articles = new \App\Database\Migrations\CreateArticlesTable();

$users->up();
$articles->up();

echo "Migrations completed successfully!\n"; 