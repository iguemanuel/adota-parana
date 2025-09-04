<?php

namespace App\Controllers;

use Core\Http\Request;
use App\Services\Auth;
use Lib\FlashMessage;
use App\Models\User;

class AuthController
{
    public function showLoginForm(Request $request): void
    {
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(Request $request): void
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        $user = User::where('email', $email)->first();

        if ($user && password_verify($password, $user->password)) {
            Auth::login($user);
            FlashMessage::success('Login realizado com sucesso!');
            header('Location: /'); // redireciona para home
            exit;
        }

        FlashMessage::danger('Credenciais inválidas.');
        header('Location: /login');
        exit;
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        FlashMessage::success('Você saiu da sua conta.');
        header('Location: /login');
        exit;
    }
}
