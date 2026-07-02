<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/cadastro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./styles/modal.css">
    <link rel="icon" type="image/x-icon" href="./assets/lista.ico">
</head>
<body>
    <main>
        <div class="form">
            <form method="post" action="cadastrar.php">
                <h1>Cadastro</h1>
                <div class="inputBox">
                    <label for="name">Nome</label>
                    <input name="name" type="text">
                </div>
                <div class="inputBox">
                    <label for="email">E-mail</label>
                    <input name="email" type="text">
                </div>
                <div class="inputBox">
                    <label for="password">Senha</label>
                    <input name="password" type="password">
                </div>
                <div class="inputBox">
                    <label for="confirm-password">Confirmar senha</label>
                    <input name="confirm_password" type="password">
                </div>
                <button type="submit">Cadastrar</button>
                <div class="links">
                    <a href="index.php">Ja tenho conta</a>
                    <a href="recuperar_senha.php">Esqueci minha senha</a>
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

    <script src="./scripts/cadastro.js"></script>
    <script src="./scripts/modal.js"></script>
    <script>
        const params = new URLSearchParams(window.location.search);

        const errosCadastro = {
            '1': 'Preencha todos os campos.',
            '2': 'As senhas não coincidem.',
            '3': 'A senha deve ter no mínimo 8 caracteres.',
            '4': 'Já existe uma conta com esse e-mail.',
        };

        if (params.has('erro')) {
            abrirModal(errosCadastro[params.get('erro')] ?? 'Ocorreu um erro. Tente novamente.', 'erro');
        }
    </script>
</body>
</html>