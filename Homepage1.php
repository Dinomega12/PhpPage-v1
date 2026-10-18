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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - NeuraMemory</title>
    <link rel="shortcut icon" href="Icon/White-logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="Src/Css/stylehome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <nav id="sidebar">
        <button id="open_btn">
            <i id="open_btn_icon" class="fa-solid fa-chevron-right"></i>
        </button>

        <div id="sidebar_content">
            <div id="user">
                <img src="Src/Img/icon-ascii.png" id="user_avatar" alt="avatar">
                <div id="user_infos">
                    <span class="item-description">User Name</span>
                    <span class="item-description">user@email.com</span>
                </div>
            </div>

            <ul id="side_items">
                <li class="side-item active" data-target="projetos-section">
                    <i class="fa-solid fa-box-archive"></i>
                    <span class="item-description">Projetos</span>
                </li>

                <li class="side-item" data-target="calendarios-section">
                    <i class="fa-solid fa-calendar"></i>
                    <span class="item-description">Calendários</span>
                </li>
                
                <li class="side-item" data-target="configuracoes-section">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span class="item-description">Configurações</span>
                </li>
            </ul>
        </div>

        <div id="Logout">
            <form method="POST">
                <button type="submit" name="logout" id="Logout_btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="item-description">Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <main>
        <section id="projetos-section" class="tab-content active">
            <div class="container-title_projetos">
                <h1>Seus projetos :</h1>
            </div>
            
            <div class="container_projetos">
                <h2>Seus Projetos Ativos</h2>
                <p>Gerencie todos os projetos criados no seu espaço de trabalho.</p>
            </div>
        </section>
    
        <section id="calendarios-section" class="tab-content">
            <div class="container-title_projetos">
            <h1>Calendários</h1>
            </div>

            <div class="container_projetos">
            <h2>Seu Calendários, em tempo real</h2>
            <p>Seus eventos e reunioes aparecerão aqui em breve.</p>
            </div>

        </section>

    
        <section id="configuracoes-section" class="tab-content">
            <div class="container-title_projetos">
            <h1>Configurações</h1>
            </div>
            
            <div class="container_projetos">
            <p>Aqui você poderá alterar as configurações da sua conta.</p>
            </div>
        
        </section>
    </main>

    <script src="Src/JavaScript/script.js"></script>
</body>
</html>