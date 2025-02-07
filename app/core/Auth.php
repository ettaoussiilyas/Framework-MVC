<?php

namespace App\Core;

use App\Models\User;

class Auth 
{
    protected ?User $user = null;
    protected Session $session;
    protected Security $security;

    public function __construct(Session $session, Security $security) 
    {
        $this->session = $session;
        $this->security = $security;
    }

    public function attempt(string $email, string $password): bool 
    {
        $user = User::where('email', $email)->first();

        if ($user && $this->security->verifyPassword($password, $user->password)) {
            $this->login($user);
            return true;
        }

        return false;
    }

    public function login(User $user): void 
    {
        $this->user = $user;
        $this->session->set('user_id', $user->id);
    }

    public function logout(): void 
    {
        $this->user = null;
        $this->session->remove('user_id');
    }

    public function check(): bool 
    {
        return $this->user !== null || $this->session->has('user_id');
    }

    public function user(): ?User 
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $userId = $this->session->get('user_id');
        if ($userId) {
            $this->user = User::find($userId);
            return $this->user;
        }

        return null;
    }
}
