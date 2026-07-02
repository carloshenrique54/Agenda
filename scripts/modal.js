function abrirModal(mensagem, tipo = 'sucesso', titulo = null) {
    const overlay = document.getElementById('modalOverlay');
    const box = document.getElementById('modalBox');
    const icone = document.getElementById('modalIcone');
    const tituloEl = document.getElementById('modalTitulo');
    const mensagemEl = document.getElementById('modalMensagem');

    box.classList.toggle('modal-erro', tipo === 'erro');

    icone.innerHTML = tipo === 'erro'
        ? '<i class="fa-solid fa-circle-exclamation"></i>'
        : '<i class="fa-solid fa-circle-check"></i>';

    tituloEl.textContent = titulo ?? (tipo === 'erro' ? 'Ops!' : 'Sucesso!');
    mensagemEl.textContent = mensagem;

    overlay.classList.add('ativo');
}

function fecharModal() {
    const overlay = document.getElementById('modalOverlay');
    overlay.classList.remove('ativo');

    const url = new URL(window.location.href);
    url.search = '';
    window.history.replaceState({}, document.title, url);
}

document.addEventListener('DOMContentLoaded', () => {
    const botao = document.getElementById('modalBotao');
    const overlay = document.getElementById('modalOverlay');

    if (botao) {
        botao.addEventListener('click', fecharModal);
    }

    if (overlay) {
        overlay.addEventListener('click', (evento) => {
            if (evento.target.id === 'modalOverlay') {
                fecharModal();
            }
        });
    }
});