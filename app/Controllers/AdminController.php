<?php

namespace App\Controllers;

use Core\Http\Request;
use App\Services\Auth;
use Lib\FlashMessage;
use App\Models\User;

class AdminController
{

    public function index(Request $request)
    {
        $stats = [
            'users' => 120,
            'animals' => 40,
        ];

        return $this->view('admin/Dashboard', compact('stats'));
    }

    public function users(Request $request)
    {
        $users = \App\Models\User::all();

        return $this->view('admin/users', compact('users'));
    }

        protected function view(string $path, array $data = [])
    {
        extract($data); // transforma array em variáveis
        $user = \App\Services\Auth::user(); // usuário logado, se quiser disponível
        include __DIR__ . "/../views/{$path}.php";
    }
}