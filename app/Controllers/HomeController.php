<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $title = 'Pagina Inicial - Adota Paraná';
        $this->render('home/index', compact('title'));
    }
}
