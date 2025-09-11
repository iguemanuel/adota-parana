<?php
// header.php
// Assumindo que $user está disponível (usuário logado)
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Admin - <?= $user->name ?? 'Administrador' ?></title>
    <link rel="stylesheet" href="/css/admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f0f2f5;
        }
        header {
            background: #343a40;
            color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header .logo {
            font-size: 1.5rem;
            font-weight: bold;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .user-info form button {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        .user-info form button:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Adota Paraná</div>

        <nav>
            <a href="/admin/dashboard">Dashboard</a>
            <a href="/">Home</a>
        </nav>

        <div class="user-info">
            <span><?= htmlspecialchars($user->name ?? 'Admin') ?></span>
            <form method="POST" action="/logout">
                <button type="submit">Sair</button>
            </form>
        </div>
    </header>
    <main style="padding: 20px;">
