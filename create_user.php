<?php

// Conexão com o banco usando PDO
$host = 'db';
$db   = 'adota_parana';
$user = 'adota_user';
$pass = 'adota_pwd';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Dados do usuário
$name = 'Administrador';
$email = 'admin@adota.com';
$password = 'senha123'; // senha em texto puro
$role_admin = 1;

// Gerar hash da senha
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Inserir no banco
$stmt = $pdo->prepare("
    INSERT INTO users (name, email, encrypted_password, role_admin)
    VALUES (:name, :email, :password, :role_admin)
");
$stmt->execute([
    ':name' => $name,
    ':email' => $email,
    ':password' => $hashedPassword,
    ':role_admin' => $role_admin
]);

echo "Usuário criado com sucesso!\n";
