<?php

namespace App\Core;

class Session 
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set(string $key, $value): void 
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key, $default = null) 
    {
        return $_SESSION[$key] ?? $default;
    }

    public function has(string $key): bool 
    {
        return isset($_SESSION[$key]);
    }

    public function remove(string $key): void 
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): void 
    {
        session_destroy();
        $_SESSION = [];
    }

    public function flash(string $key, $value = null) 
    {
        if ($value !== null) {
            $this->set($key, $value);
            return null;
        }
        
        $value = $this->get($key);
        $this->remove($key);
        return $value;
    }
}
