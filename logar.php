<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'sessao.php';
require 'conn.php';

$email = trim($_POST["email"] ?? '');
$password = $_POST["password"] ?? '';

if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    header('Location: index.php?erro=1');
    exit;
}

$stmt = $conn->prepare('SELECT id, nome, senha FROM usuarios WHERE email = ?');
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt -> get_result();
$u = $result -> fetch_assoc();

if(!$u || !password_verify($password, $u['senha'])) {
    header('Location: index.php?erro=2');
    exit;
}

session_regenerate_id(true);

$_SESSION['usuario'] = [
    'id' => (int)$u['id'],
    'email'=> $email,
    'nome'=> $u['nome'],
];

header('Location: home.php');
exit;