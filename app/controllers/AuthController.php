<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Core\Auth;
use App\Core\Session;
use App\Core\Security;
use App\Models\Article;

class AuthController extends Controller
{
    protected Auth $auth;
    protected Session $session;
    protected Security $security;

    public function __construct()
    {
        $this->session = new Session();
        $this->security = new Security();
        $this->auth = new Auth($this->session, $this->security);
    }

    public function showLogin()
    {
        if ($this->auth->check()) {
            $user = $this->auth->user();
            
            if ($user->role === 'admin') {
                header('Location: /admin/articles');
                exit();
            } else {
                header('Location: /user/articles');
                exit();
            }
        }
        return $this->view('auth/login');
    }

    public function showRegister()
    {
        return $this->view('auth/register');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->view('auth/login');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->auth->attempt($email, $password)) {
            $user = $this->auth->user();
            
            $_SESSION['user'] = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ];
            
            if ($user->role === 'admin') {
                header('Location: /admin/articles');
                exit();
            } else {
                header('Location: /user/articles');
                exit();
            }
        }

        $_SESSION['error'] = 'Invalid credentials';
        header('Location: /login');
        exit();
    }

    public function register()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                return $this->redirectWithError('/register', 'Invalid request method');
            }

            $name = trim($_POST['name'] ?? '');
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validation
            $errors = [];
            if (empty($name)) $errors[] = "Name is required";
            if (empty($email)) $errors[] = "Email is required";
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format";
            if (empty($password)) $errors[] = "Password is required";
            if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";
            
            if (User::where('email', $email)->exists()) {
                $errors[] = "Email already exists";
            }

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: /register');
                exit;
            }

            // Create user with default role
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => 'user'  // Default role for new registrations
            ]);

            $_SESSION['success'] = "Registration successful! Please login.";
            header('Location: /login');
            exit;

        } catch (\Exception $e) {
            error_log('Registration error: ' . $e->getMessage());
            return $this->redirectWithError('/register', 'An error occurred. Please try again.');
        }
    }

    public function logout()
    {
        $this->auth->logout();
        session_destroy();
        header('Location: /login');
        exit();
    }
}
