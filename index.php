<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
    <main>
        <div class="form">
            <form method="post" action="logar.php">
                <h1>Login</h1>
                <div class="inputBox">
                    <label for="email">E-mail</label>
                    <input name="email" type="text">
                </div>
                <div class="inputBox">
                    <label for="password">Senha</label>
                    <input name="password" type="password">
                </div>
                <button type="submit">Login</button>
                <div class="links">
                    <a href="cadastro.php">Não tenho conta</a>
                    <a href="recuperar_senha.php">Esqueci minha senha</a>
                </div>
            </form>
            <img src="./assets/images/login-image.png" alt="Imagem de login">
        </div>
    </main>
    <script src="./scripts/login.js"></script>
</body>
</html>