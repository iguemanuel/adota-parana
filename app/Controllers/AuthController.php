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
        require __DIR__ . '/../views/auth/Login.php';
    }

    public function login(Request $request): void
    {
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        
        $user = User::findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            Auth::login($user);
            FlashMessage::success('Login realizado com sucesso!');
            header('Location: /');
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
