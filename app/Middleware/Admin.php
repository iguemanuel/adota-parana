<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use App\Services\Auth;
use Lib\FlashMessage;

class Admin implements Middleware
{
    public function handle(Request $request): void
    {
        $user = Auth::user();

        if (!$user || !$user->role_admin) {
            FlashMessage::danger('Você não tem permissão para acessar esta página.');
            header('Location: /');
            exit;
        }
    }
}
