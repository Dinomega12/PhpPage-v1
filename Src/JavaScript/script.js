// Abre/fecha a sidebar
const openBtn = document.getElementById('open_btn');
const sidebar = document.getElementById('sidebar');

if (openBtn && sidebar) {
    openBtn.addEventListener('click', function () {
        sidebar.classList.toggle('open-sidebar');
    });
}

// Abre/fecha o shell (só roda se os elementos existirem na página)
const shellBtn = document.getElementById('shell-btn');
const shell = document.getElementById('shell');

if (shellBtn && shell) {
    shellBtn.addEventListener('click', function () {
        shell.classList.toggle('shell-open');
    });
}

// Troca de abas
const sideItems = document.querySelectorAll('.side-item');
const tabSections = document.querySelectorAll('.tab-content');

sideItems.forEach(item => {
    item.addEventListener('click', () => {
        // Remove 'active' de todos os itens do menu e marca só o clicado
        sideItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        // Esconde todas as seções
        tabSections.forEach(section => section.classList.remove('active'));

        // Mostra a seção alvo (definida em data-target)
        const targetId = item.getAttribute('data-target');
        const targetSection = document.getElementById(targetId);

        if (targetSection) {
            targetSection.classList.add('active');
        }
    });
});