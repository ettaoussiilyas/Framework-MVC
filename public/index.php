<?php

//vendors
// require_once '../vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

// First: Database
require_once '../app/config/db.php';

// Second: Core classes
require_once '../core/BaseController.php';
require_once '../core/Router.php';
require_once '../core/Route.php';




session_start();

$router = new Router();
Route::setRouter($router);



// Auth Routes
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/signup', [AuthController::class, 'showSignup']); 
Route::post('/login', [AuthController::class, 'loginChecker']);
Route::post('/signup', [AuthController::class, 'signupChecker']);
Route::get('/logout', [AuthController::class, 'logout']);



// Dispatch la requête
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// Route::get('/api/courses/filter', [CourseController::class, 'filter']);

