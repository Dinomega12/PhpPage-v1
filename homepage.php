<?php
    session_start();
    require_once 'gerarlogin.php'; 

    if (!isset($_SESSION["adimlogin"])) {
        if (!isset($_SESSION["userlogin"])) {
    session_destroy();
    header("Location: index.php");
    exit();
    }
    }

    if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
    
    }

?>


<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - NeuraMemory</title>
    <link rel="shorcut icon"href="Icon/White-logo.ico" type="imagem/x-icon">
    <link rel="stylesheet" href="Src/Css/styleProjeto.css">

</head>
<body>

    <div class="container">
        <nav class="navbar">
            <div class="brand">

            <form method="POST">
            <div class="nav-icon">
                <div class="brand-Icon">
                    <button  type ="submit" class="tab-icon" name="logout" value="logout"></button>
                </div>
            </div>
            </form>
            <span>NeuraMemory</span>
            </div>

            <!-- Botões painel superior -->
            
            <div class="nav-tabs">
                <button class="tab-btn active" onclick="switchTab('dashboard')">
                    <i style="width: 18px; height: 18px;"></i>
                    Meus Projetos
                </button>
    
                <button class="tab-btn" onclick="switchTab('creation')">
                    <i style="width: 18px; height: 18px;"></i>
                    Criar ou Gerenciar
                </button>
            </div>
        </nav>

        <main class="content-card">
           
            <!-- TAB 1: MEUS PROJETOS -->
            <section id="tab-dashboard" class="tab-content active">
                <div class="section-header">
                    <h2><i data-lucide="layers" style="color: var(--text-accent);"></i> Seus Projetos Ativos</h2>
                    <p>Gerencie todos os projetos criados no seu espaço de trabalho.</p>
                </div>

                <div class="projects-grid" id="projectsGrid">
                    <!-- Cards dinâmicos inseridos via JS -->
                </div>
            </section>

            <!-- TAB 2: ABA DE CRIAÇÃO E GERENCIAMENTO -->
            <section id="tab-creation" class="tab-content">
                <div class="section-header">
                    <h2><i data-lucide="sliders" style="color: var(--text-accent);"></i> Central de Criação & Gerenciamento</h2>
                    <p>Selecione um projeto existente para abrir/excluir ou crie um novo.</p>
                </div>

                <!-- Espaço de Seleção do Item / Projeto -->
                <div class="selection-box">
                    <div class="selection-label">
                        <i data-lucide="mouse-pointer-click" style="width: 16px; height: 16px;"></i>
                        Selecione a Ação ou Projeto:
                    </div>

                    <div class="custom-select-wrapper">
                        <select class="select-input" id="projectSelector" onchange="handleSelectionChange()">
                            <option value="NEW">[ + ] Criar Novo Projeto</option>
                            <!-- Projetos existentes serão injetados aqui via JS -->
                        </select>
                        <i data-lucide="chevron-down" class="select-icon"></i>
                    </div>

                    <!-- Botões dinâmicos de Ação (Abrir / Excluir) quando um projeto estiver selecionado -->
                    <div class="action-panel" id="actionPanel" style="display: none;">
                        <button class="action-btn btn-open" onclick="openSelectedProject()">
                            <i data-lucide="external-link" style="width: 18px; height: 18px;"></i>
                            Abrir Projeto
                        </button>
                        <button class="action-btn btn-delete" onclick="deleteSelectedProject()">
                            <i data-lucide="trash-2" style="width: 18px; height: 18px;"></i>
                            Excluir
                        </button>
                    </div>
                </div>

                <!-- Formulario de Criacao / Edição -->
                <form id="projectForm" class="form-grid" onsubmit="handleFormSubmit(event)">
                    <h3 id="formTitle" style="font-size: 1.1rem; color: var(--text-accent); margin-bottom: 0.2rem;">
                        Detalhes do Novo Projeto
                    </h3>

                    <div class="input-group">
                        <label for="projTitle">Nome do Projeto *</label>
                        <input type="text" id="projTitle" class="input-field" placeholder="Ex: Monitoria, Banco Aberto..." required>
                    </div>

                    <div class="input-row">
                        <div class="input-group">
                            <label for="projCategory">Categoria / Tipo</label>
                            <select id="projCategory" class="select-input">
                                <option value="" disabled selected  hidden> Escolha a categoria ↗</option>
                                <option value="Ensino">Ensino</option>
                                <option value="Pesquisa">Pesquisa</option>
                                <option value="Extensão">Extensão</option>
                                <option value="Inova">Inovação</option>
                            </select>                       
                        </div>
                        <div class="input-group">
                            <label for="projStatus">Status Inicial</label>
                            <select id="projStatus" class="select-input">
                                 <option value="" disabled selected  hidden> Defina o Status ↗</option>
                                <option value="Em Andamento">Em Andamento</option>
                                <option value="Planejamento">Planejamento</option>
                                <option value="Concluído">Concluído</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="projDesc">Descrição do Projeto</label>
                        <textarea id="projDesc" class="textarea-field" placeholder="Descreva os objetivos, tecnologias usadas ou notas importantes..."></textarea>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                        <button type="submit" class="action-btn btn-open" id="saveBtn">
                            <i data-lucide="check-circle-2" style="width: 18px; height: 18px;"></i>
                            <span id="saveBtnText">Criar Projeto</span>
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <!-- Modal de Visualização do Projeto (Abrir) -->
    <div class="modal-overlay" id="workspaceModal">
        <div class="modal-card">
            <div class="modal-header">
                <div>
                    <span class="badge" id="modalBadge">Em Andamento</span>
                    <h2 id="modalTitle" style="font-size: 1.6rem; margin-top: 0.4rem; color: var(--text-main);">Título do Projeto</h2>
                </div>
                <button class="modal-close" onclick="closeModal()">
                    <i data-lucide="x" style="width: 24px; height: 24px;"></i>
                </button>
            </div>

            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div>
                    <h4 style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase;">Categoria</h4>
                    <p id="modalCategory" style="font-size: 1rem; font-weight: 500; color: var(--text-accent);">Dev Web</p>
                </div>

                <div>
                    <h4 style="font-size: 0.85rem; color: var(--text-muted); text-transform: uppercase;">Descrição</h4>
                    <p id="modalDesc" style="font-size: 0.95rem; line-height: 1.5; color: var(--text-main); margin-top: 0.2rem;">
                        Descrição completa do projeto.
                    </p>
                </div>

                <div style="padding: 1rem; background: rgba(0,0,0,0.25); border-radius: 12px; border: 1px solid var(--glass-border);">
                    <p style="font-size: 0.85rem; color: var(--text-muted);">
                        <i data-lucide="clock" style="width: 14px; height: 14px; vertical-align: middle;"></i> 
                        Criado em: <span id="modalDate" style="color: var(--text-main);">18/09/2026</span>  
                    </p>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem;">
                    <button class="action-btn btn-secondary" onclick="closeModal()">Fechar</button>
                    <button class="action-btn btn-open" onclick="editModalProject()">
                        <i data-lucide="edit-3" style="width: 16px; height: 16px;"></i> Editar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <i data-lucide="check-circle" style="width: 20px; height: 20px;"></i>
        <span id="toastMsg">Operação realizada com sucesso!</span>
    </div>

    <script>
        // Key LocalStorage
        const STORAGE_KEY = 'devstudio_projects_db';

        // Array de projetos no estado local
        let projects = [];
        let activeProjectInModal = null;

        // Ao carregar a página
        window.addEventListener('DOMContentLoaded', () => {
            loadProjects();
            renderDashboard();
            populateSelector();
            lucide.createIcons();
        });

        // Carregar do LocalStorage
        function loadProjects() {
            const data = localStorage.getItem(STORAGE_KEY);
            if (data) {
                projects = JSON.parse(data);
            } else {
                // Projetos de placeholder
                projects = [
                    {
                        id: 'proj_1',
                        title: 'Monitoria de matematica',
                        category: 'Ensino',
                        status: 'Em Andamento',
                        description: 'Metodoligia aplica para ensino da matematica.',
                        createdAt: new Date().toLocaleDateString('pt-BR')
                    },
                    {
                        id: 'proj_2',
                        title: 'API Rest GraphQL',
                        category: 'Backend',
                        status: 'Concluído',
                        description: 'Microserviços para processamento de relatórios em tempo real.',
                        createdAt: new Date().toLocaleDateString('pt-BR')
                    }
                ];
                saveProjects();
            }
        }

        function saveProjects() {
            localStorage.setItem(STORAGE_KEY, JSON.stringify(projects));
        }

        function switchTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            if (tabName === 'dashboard') {
                document.querySelectorAll('.tab-btn')[0].classList.add('active');
                document.getElementById('tab-dashboard').classList.add('active');
                renderDashboard();
            } else {
                document.querySelectorAll('.tab-btn')[1].classList.add('active');
                document.getElementById('tab-creation').classList.add('active');
            }
        }

        function populateSelector() {
            const selector = document.getElementById('projectSelector');
            selector.innerHTML = `<option value="NEW">[ + ] Criar Novo Projeto</option>`;

            projects.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p.id;
                opt.textContent = `📁 ${p.title} (${p.category || 'Geral'})`;
                selector.appendChild(opt);
            });

            handleSelectionChange();
        }

        function handleSelectionChange() {
            const selectedVal = document.getElementById('projectSelector').value;
            const actionPanel = document.getElementById('actionPanel');
            const formTitle = document.getElementById('formTitle');
            const saveBtnText = document.getElementById('saveBtnText');

            if (selectedVal === 'NEW') {
                actionPanel.style.display = 'none';
                formTitle.textContent = 'Detalhes do Novo Projeto';
                saveBtnText.textContent = 'Criar Projeto';
                document.getElementById('projectForm').reset();
            } else {
                // Projeto Existente Selecionado -> Exibe Abrir / Excluir
                actionPanel.style.display = 'flex';
                formTitle.textContent = 'Editar Projeto Selecionado';
                saveBtnText.textContent = 'Salvar Alterações';

                // Preenche os campos para edição imediata se desejado
                const proj = projects.find(p => p.id === selectedVal);
                if (proj) {
                    document.getElementById('projTitle').value = proj.title;
                    document.getElementById('projCategory').value = proj.category || '';
                    document.getElementById('projStatus').value = proj.status || 'Em Andamento';
                    document.getElementById('projDesc').value = proj.description || '';
                }
            }
        }

        function handleFormSubmit(e) {
            e.preventDefault();

            const selectedVal = document.getElementById('projectSelector').value;
            const title = document.getElementById('projTitle').value;
            const category = document.getElementById('projCategory').value || 'Geral';
            const status = document.getElementById('projStatus').value;
            const description = document.getElementById('projDesc').value;

            if (selectedVal === 'NEW') {
                // Criar Novo
                const newProject = {
                    id: 'proj_' + Date.now(),
                    title,
                    category,
                    status,
                    description,
                    createdAt: new Date().toLocaleDateString('pt-BR')
                };
                projects.push(newProject);
                showToast(`Projeto "${title}" criado com sucesso!`);
            } else {
                // Atualizar Existente
                const idx = projects.findIndex(p => p.id === selectedVal);
                if (idx !== -1) {
                    projects[idx] = {
                        ...projects[idx],
                        title,
                        category,
                        status,
                        description
                    };
                    showToast(`Projeto "${title}" atualizado com sucesso!`);
                }
            }

            saveProjects();
            populateSelector();
            document.getElementById('projectSelector').value = 'NEW';
            handleSelectionChange();
            renderDashboard();
        }

        function openSelectedProject() {
            const selectedVal = document.getElementById('projectSelector').value;
            const proj = projects.find(p => p.id === selectedVal);
            if (proj) {
                openModal(proj);
            }
        }

        function deleteSelectedProject() {
            const selectedVal = document.getElementById('projectSelector').value;
            const proj = projects.find(p => p.id === selectedVal);
            if (!proj) return;

            // Confirm sem alert nativo (deletar diretamente com feedback toast)
            projects = projects.filter(p => p.id !== selectedVal);
            saveProjects();
            populateSelector();
            renderDashboard();
            showToast(`Projeto "${proj.title}" foi excluído.`);
        }

        function openModal(proj) {
            activeProjectInModal = proj;
            document.getElementById('modalTitle').textContent = proj.title;
            document.getElementById('modalCategory').textContent = proj.category || 'Geral';
            document.getElementById('modalStatus') && (document.getElementById('modalStatus').textContent = proj.status);
            document.getElementById('modalBadge').textContent = proj.status || 'Ativo';
            document.getElementById('modalDesc').textContent = proj.description || 'Sem descrição cadastrada.';
            document.getElementById('modalDate').textContent = proj.createdAt || 'Recentemente';

            document.getElementById('workspaceModal').classList.add('open');
        }

        function closeModal() {
            document.getElementById('workspaceModal').classList.remove('open');
            activeProjectInModal = null;
        }

        function editModalProject() {
            if (!activeProjectInModal) return;
            const projId = activeProjectInModal.id;
            closeModal();
            switchTab('creation');
            document.getElementById('projectSelector').value = projId;
            handleSelectionChange();
        }

        function renderDashboard() {
            const grid = document.getElementById('projectsGrid');
            grid.innerHTML = '';

            if (projects.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <i data-lucide="folder-open" style="width: 48px; height: 48px; opacity: 0.4;"></i>
                        <p style="font-size: 1.1rem; font-weight: 600;">Nenhum projeto encontrado</p>
                        <p style="font-size: 0.88rem;">Vá até a "Aba de Criação" para adicionar seu primeiro projeto.</p>
                        <button class="action-btn btn-open" onclick="switchTab('creation')" style="margin-top: 0.5rem;">
                            Ir para Criação
                        </button>
                    </div>
                `;
                lucide.createIcons();
                return;
            }

            projects.forEach(proj => {
                const card = document.createElement('div');
                card.className = 'project-card';
                card.innerHTML = `
                    <div>
                        <span class="badge">${proj.status || 'Ativo'}</span>
                        <h3 class="card-title" style="margin-top: 0.6rem;">${proj.title}</h3>
                        <p style="font-size: 0.8rem; color: var(--text-accent); font-weight: 600; margin-bottom: 0.5rem;">
                            ${proj.category || 'Geral'}
                        </p>
                        <p class="card-desc">${proj.description || 'Sem descrição.'}</p>
                    </div>

                    <div class="card-footer">
                        <span>${proj.createdAt || 'Recentemente'}</span>
                        <button class="action-btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;" onclick="openModalById('${proj.id}')">
                            <i data-lucide="eye" style="width: 14px; height: 14px;"></i> Abrir
                        </button>
                    </div>
                `;
                grid.appendChild(card);
            });

            lucide.createIcons();
        }

        function openModalById(id) {
            const proj = projects.find(p => p.id === id);
            if (proj) openModal(proj);
        }

        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg   ').textContent = msg;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }
    </script>
</body>
</html>
<?php
 
?>
