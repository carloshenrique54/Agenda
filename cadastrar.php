<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/services/conn.php';
require __DIR__ . '/services/sessao.php';

$nome = trim($_POST['name']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$hash = password_hash($password, PASSWORD_DEFAULT);

if(!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '' || $nome   === '') {
    header('Location: cadastro.php?erro=1');
    exit;
}

if($confirm_password !== $password ){
    header('Location: cadastro.php?erro=2');
    exit;
}

if(strlen($password) < 8) {
    header('Location: cadastro.php?erro=3');
    exit;
}

$sql = "SELECT id FROM usuarios WHERE email = ?";   
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    header("Location: cadastro.php?erro=4");
    exit;
}

$sql = "INSERT INTO usuarios (nome, email, senha_hash) VALUES (?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $hash);
mysqli_stmt_execute($stmt);

header("Location: login.php?cadastrado");
exit;