<?php

namespace App\Controllers;

use Core\Http\Request;
use App\Services\Auth;
use Lib\FlashMessage;
use App\Models\User;

class AuthController
{
    public function showRegistrationForm(Request $request): void
    {
        require __DIR__ . '/../views/auth/Register.php';
    }

    public function register(Request $request): void
    {
        $name = $request->getParam('name');
        $email = $request->getParam('email');
        $phone = $request->getParam('phone');
        $password = $request->getParam('password');
        $password_confirmation = $request->getParam('password_confirmation');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->password = $password;
        $user->password_confirmation = $password_confirmation;
        $user->role = 'User';

        if ($user->save()) {
            FlashMessage::success('Registro realizado com sucesso! Efetue o login.');
            header('Location: /login');
        } else {
            $errors = $user->errors;
            FlashMessage::danger(implode("<br>", $errors));
            header('Location: /register');
        }
    }

    public function showLoginForm(Request $request): void
    {
        require __DIR__ . '/../views/auth/Login.php';
    }

    public function login(Request $request): void
    {
        $email = $request->getParam('email');
        $password = $request->getParam('password');
        
        $user = User::findByEmail($email);
        
        if ($user && $user->authenticate($password)) {
            Auth::login($user);
            FlashMessage::success('Login realizado com sucesso!');

            if($user->role === 'Admin'){
                header('Location: /admin/dashboard');
            } else {
                header('Location: /');
            }

        } else {
            FlashMessage::danger('Credenciais inválidas.');
            header('Location: /login');
        }
    }

    public function logout(Request $request): void
    {
        Auth::logout();
        FlashMessage::success('Você saiu da sua conta.');
        header('Location: /login');
        exit;
    }
}
