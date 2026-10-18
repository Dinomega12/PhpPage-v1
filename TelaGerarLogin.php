<?php

    session_start(); 

    if (isset($_POST["creat"])) {
        $_SESSION["email0"] = $_POST["email"];
        $_SESSION["username0"] = $_POST["username"];
        $_SESSION["password0"] = $_POST["password"];
        
    header("Location: index.php");

    }
?>


<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - NeuraMemory </title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shorcut icon"href="Icon/White-logo.ico" type="imagem/x-icon">
    <link rel="stylesheet" href="Src/Css/stylegerar.css">

</head>
<body>

    <main class="container">
        <header class="header">
            <h1>Crie sua conta</h1>
            <p>Preencha os dados abaixo para se cadastrar</p>
        </header>

        <form class="form" action="" id="registerForm"  method="POST">
            
            <!-- Campo Nome -->
            <div class="input-box">
                <label>Nome completo:</label>
                <i class="bx bxs-user"></i>
                    <input type="text" id="name" name="username" class="input-field" placeholder="Seu Nome Completo" >
                </div>
            </div>

            <!-- Campo E-mail -->
            <div class="input-box">
                <label for="email">E-mail:</label>
                <i class="bx bxs-user"></i>
                    <input type="email" name = "email" id="email" class="input-field" placeholder="seu@email.com" >
                </div>
            </div>

    
            <!-- Campo Senha -->
            <div class="input-box">
                <label for="password">Senha:</label>
                <i class="bx bxs-lock-alt"></i>
                    <input type="password" name="password" id="password" class="input-field" placeholder="Sua senha" >
            </div>

            <!-- Campo Confirmar Senha -->
            <div class="input-box">
                <label for="confirmPassword">Confirmar Senha:</label>
                <i class="bx bxs-lock-alt"></i>
                    <input type="password" id="confirmPassword" class="input-field" placeholder="Repita a senha" >
                </div>
        

            <!-- Botão Registrar -->
            <div class="input-box">
                <button type="submit" name="creat" class="submit-btn" id="submitBtn">
                    <span id="btnText">Registrar</span>
                </button>
            </div>
        </form>

        <div class="footer-1">
            <span>⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼</span>
        <div></div>

        <div class="footer">
            Já possui uma conta? <a href="index.php">Faça Login</a>
        </div>
    </main>
</body>
</html>