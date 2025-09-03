<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;
use App\Models\User;


class AuthController
{
    public function showLoginForm(Request $request)
    {
        $this->view('auth/login');
    }

    public function login(Request $request)
    {
        $login = $request->post('login');
        $password = $request->post('password');

        $user = User::findByEmail($login);
        if (!$user && is_numeric($login)) {
            $user = User::findByPhone((int)$login);
        }

        if (!$user || !$user->authenticate($password)) {
            FlashMessage::danger('Login ou senha inválidos.');
            header('Location: ' . route('/login'));
            exit;
        }
        
        Auth::login($user);

        FlashMessage::success('Bem-vindo(a), ' . $user->name);
        header('Location: ' . route('/root'));
        exit;
    }

    public function logout(Request $request)
    {
        Auth::logout($user); 
        header('Location: ' . route('/login'));
        exit;
    }
}
