<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/services/conn.php';
require __DIR__ . '/services/sessao.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

$usuarioId = (int) $_SESSION['usuario']['id'];
$erro = '';

if (isset($_GET['sair'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'adicionar') {
    $titulo = trim($_POST['titulo'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $prazo = $_POST['prazo'] !== '' ? $_POST['prazo'] : null;
    $prioridade = $_POST['prioridade'] ?? 'media';

    if ($titulo === '') {
        $erro = 'O título da tarefa é obrigatório.';
    } else {
        $stmt = $conn->prepare(
            'INSERT INTO tarefas (usuario_id, titulo, descricao, prazo, prioridade, concluida, criado_em)
             VALUES (?, ?, ?, ?, ?, 0, NOW())'
        );

        if (!$stmt) {
            die('Erro no prepare (INSERT tarefas): ' . $conn->error);
        }

        $stmt->bind_param('issss', $usuarioId, $titulo, $descricao, $prazo, $prioridade);

        if (!$stmt->execute()) {
            die('Erro no execute (INSERT tarefas): ' . $stmt->error);
        }

        header('Location: home.php');
        exit;
    }
}

if (isset($_GET['concluir'])) {
    $id = (int) $_GET['concluir'];
    $stmt = $conn->prepare('UPDATE tarefas SET concluida = NOT concluida WHERE id = ? AND usuario_id = ?');
    $stmt->bind_param('ii', $id, $usuarioId);
    $stmt->execute();

    header('Location: home.php');
    exit;
}

if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    $stmt = $conn->prepare('DELETE FROM tarefas WHERE id = ? AND usuario_id = ?');
    $stmt->bind_param('ii', $id, $usuarioId);
    $stmt->execute();

    header('Location: home.php');
    exit;
}

$stmt = $conn->prepare(
    'SELECT id, titulo, descricao, prazo, prioridade, concluida, criado_em
     FROM tarefas
     WHERE usuario_id = ?
     ORDER BY concluida ASC, prazo IS NULL, prazo ASC, criado_em DESC'
);

if (!$stmt) {
    die('Erro no prepare (SELECT tarefas): ' . $conn->error);
}

$stmt->bind_param('i', $usuarioId);
$stmt->execute();
$tarefas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$rotuloPrioridade = [
    'alta' => 'Alta',
    'media' => 'Média',
    'baixa' => 'Baixa',
];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./styles/modal.css">
    <link rel="icon" type="image/x-icon" href="./assets/lista.ico">
</head>
<body>
    <header>
        <h1>Olá, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?></h1>
        <a href="logout.php">Sair</a>
    </header>

    <main>
        <section class="form">
            <h2>Nova tarefa</h2>

            <?php if ($erro): ?>
                <p style="color:red;"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>

            <form method="post" action="home.php">
                <input type="hidden" name="acao" value="adicionar">

                <div class="inputBox">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>

                <div class="inputBox">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" name="descricao" rows="2"></textarea>
                </div>

                <div class="inputBox">
                    <label for="prazo">Prazo</label>
                    <input type="date" id="prazo" name="prazo">
                </div>

                <div class="inputBox">
                    <label for="prioridade">Prioridade</label>
                    <select id="prioridade" name="prioridade">
                        <option value="baixa">Baixa</option>
                        <option value="media" selected>Média</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>

                <button type="submit">Adicionar tarefa</button>
            </form>
        </section>

        <section>
            <h2>Tarefas (<?= count($tarefas) ?>)</h2>

            <?php if (empty($tarefas)): ?>
                <p>Você ainda não tem tarefas. Adicione a primeira acima!</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <li>
                            <input
                                type="checkbox"
                                onchange="window.location.href='home.php?concluir=<?= $tarefa['id'] ?>'"
                                <?= $tarefa['concluida'] ? 'checked' : '' ?>
                            >

                            <strong<?= $tarefa['concluida'] ? ' style="text-decoration:line-through;"' : '' ?>>
                                <?= htmlspecialchars($tarefa['titulo']) ?>
                            </strong>

                            (<?= $rotuloPrioridade[$tarefa['prioridade']] ?? ucfirst($tarefa['prioridade']) ?>)

                            <?php if (!empty($tarefa['descricao'])): ?>
                                <p><?= htmlspecialchars($tarefa['descricao']) ?></p>
                            <?php endif; ?>

                            <?php if (!empty($tarefa['prazo'])): ?>
                                <span>Prazo: <?= date('d/m/Y', strtotime($tarefa['prazo'])) ?></span>
                            <?php endif; ?>

                            <a href="home.php?excluir=<?= $tarefa['id'] ?>" onclick="return confirm('Excluir esta tarefa?');">Excluir</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>

    <div class="modal-overlay" id="modalOverlay">
        <div class="modal-box" id="modalBox">
            <p class="modal-icone" id="modalIcone"></p>
            <h2 class="modal-titulo" id="modalTitulo">Sucesso!</h2>
            <p class="modal-mensagem" id="modalMensagem"></p>
            <button type="button" class="modal-botao" id="modalBotao">OK</button>
        </div>
    </div>

    <script src="./scripts/modal.js"></script>
    <script>
        const params = new URLSearchParams(window.location.search);

        if (params.get('sucesso') === 'login') {
            abrirModal('Login realizado com sucesso! Bem-vindo(a).', 'sucesso');
        }
    </script>
</body>
</html>