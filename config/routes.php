<?php

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use Core\Router\Route;
use App\Controllers\AdminController;
use App\Middleware\Authenticate;
use App\Middleware\Admin;

// Authentication
Route::get('/', [HomeController::class, 'index'])->name('root');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/admin', [AdminController::class, 'index'])
    ->addMiddleware(new Authenticate())
    ->addMiddleware(new Admin());


