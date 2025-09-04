<?php

namespace App\Services;

use App\Models\User;

class Auth
{
    public static function login(User $user): void
    {
        $_SESSION['user_id'] = $user->id;
    }

    public static function logout(): void
    {
        unset($_SESSION['user_id']);
    }

    public static function user(): ?User
    {
        if (isset($_SESSION['user_id'])) {
            return User::findById($_SESSION['user_id']);
        }
        return null;
    }
}