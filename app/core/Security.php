<?php

namespace App\Core;

class Security 
{
    public function generateCsrfToken(): string 
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function validateCsrfToken(string $token): bool 
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public function escape(string $value): string 
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function sanitizeInput($data) 
    {
        if (is_array($data)) {
            return array_map([$this, 'sanitizeInput'], $data);
        }
        return $this->escape(trim($data));
    }

    public function hashPassword(string $password): string 
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password, string $hash): bool 
    {
        return password_verify($password, $hash);
    }
}
