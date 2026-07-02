<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/recuperar_senha.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./styles/modal.css">
    <link rel="icon" type="image/x-icon" href="./assets/lista.ico">
</head>
<body>
    <main>
        <div class="form">
            <form method="post" action="alterarsenha.php">
                <h1>Recuperar Senha</h1>
                <div class="inputBox">
                    <label for="email">E-mail</label>
                    <input name="email" type="text">
                </div>
                <div class="inputBox">
                    <label for="password">Nova senha</label>
                    <input name="password" type="password">
                </div>
                <div class="inputBox">
                    <label for="password">Confirmar nova senha</label>
                    <input name="confirm_password" type="password">
                </div>
                <button type="submit">Login</button>
                <div class="links">
                    <a href="cadastro.php">Não tenho conta</a>
                    <a href="index.php">Ja tenho conta</a>
                </div>
            </form>
            <img src="./assets/images/login-image.png" alt="Imagem de login">
        </div>
    </main>

    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box" id="modalBox">
            <p class="modal-icone" id="modalIcone"></p>
            <h2 class="modal-titulo" id="modalTitulo">Sucesso!</h2>
            <p class="modal-mensagem" id="modalMensagem"></p>
            <button type="button" class="modal-botao" id="modalBotao">OK</button>
        </div>
    </div>

    <script src="./scripts/login.js"></script>
    <script src="./scripts/modal.js"></script>
    <script>
        const params = new URLSearchParams(window.location.search);

        const errosSenha = {
            '1': 'Preencha e-mail e nova senha.',
            '2': 'As senhas não coincidem.',
            '3': 'A senha deve ter no mínimo 8 caracteres.',
            '4': 'Não encontramos uma conta com esse e-mail.',
            '5': 'Não foi possível alterar a senha. Tente novamente.',
        };

        if (params.has('erro')) {
            abrirModal(errosSenha[params.get('erro')] ?? 'Ocorreu um erro. Tente novamente.', 'erro');
        }
    </script>
</body>
</html>