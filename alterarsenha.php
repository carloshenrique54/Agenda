<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/services/conn.php';
require __DIR__ . '/services/sessao.php';

$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    header('Location: recuperar_senha.php?erro=1');
    exit;
}

if ($confirm_password !== $password) {
    header('Location: recuperar_senha.php?erro=2');
    exit;
}

if (strlen($password) < 8) {
    header('Location: recuperar_senha.php?erro=3');
    exit;
}

$sql = "SELECT id FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0) {
    header("Location: recuperar_senha.php?erro=4");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET senha_hash = ? WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "ss", $hash, $email);

if (mysqli_stmt_execute($stmt)) {
    header("Location: login.php?sucesso=senha_alterada");
    exit;
} else {
    header("Location: recuperar_senha.php?erro=5");
    exit;
}