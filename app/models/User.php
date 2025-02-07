<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    // Hide password when converting to array/json
    protected $hidden = [
        'password'
    ];

    // No timestamps in users table
    public $timestamps = false;

    // Define available roles
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    // Check if user is admin
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // Check if user has specific role
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Get user's articles (if we add relationship later)
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Helper method for password hashing
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }

    // Helper method to check password
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
} 