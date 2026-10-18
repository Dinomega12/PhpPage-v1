<?php
    session_start();
    require_once 'gerarlogin.php'; 

    if(isset($_POST["login"])){

    # Responsavel pela captura da informação user 
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["password"] = $_POST["password"];
    
    # Responsavel por receber dados de TelaGerarLogin.php
    $email0 = $_SESSION["email0"] ?? null;
    $password0 = $_SESSION["password0"] ?? null;

    # Debug
    
    echo $email0; #tirar alguma hora 
    echo $password0; #tirar alguma hora 

        #Verefica caso seja adm
        if($_SESSION["email"] === "adm" && $_SESSION[ "password"] === "adm"){
    
            $_SESSION["adimlogin"] = true; 
            registrarLog($_SESSION["email"], "login feito");
            header("Location: Homepage1.php");
            exit(); 

        #Verefica caso seja user
        } else if($_SESSION["email"] === $email0 && $_SESSION["password"] == $password0){

            $_SESSION["userlogin"] = true;
            registrarLog($_SESSION["email"], "login feito");
            header("Location: Homepage1.php");
            exit();
            echo "67" . "<br>";
        } else { 

            $erro = "erro ao fazer login tente novamente"; #futoro pop pra isso

        }
        
        
        
}
?>


<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça Login - NeuraMemory</title>
    <link rel="shorcut icon"href="Src/Icon/White-logo.ico" type="imagem/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Arquivo CSS Externo --> 
    <link rel="stylesheet" href="Src/Css/styleTela.css">

</head>
<body>
    <main class="container">
    
        <header class="header">
            <h1>Bem-vindo(a)</h1>
            <p>Faça login para acessar NeuraMemory</p>
        </header>

        <form class="form" id="loginForm"  action= "index.php" method="POST">
            

            <!-- Campo de E-mail -->
            <div class="input-box">
                <label for="username">E-mail:</label>
                <i class="bx bxs-user"></i>
                    <input type="text" name="email" placeholder="email@email.com" >         
            </div>

            <!-- Campo de Senha -->
            <div class="input-box">
                <label for="password">Senha:</label>
                <i class="bx bxs-lock-alt"></i>
                <input type="password" name="password" placeholder="DigiteSuaSenha"  >
            </div>

            <!-- Botão de Login -->
        <div class="input-box">
            <button type="submit" name = "login">
                <span id="btnText">Entrar</span>
            </button>
        </div> 
        </form>

        <div class="footer-1">
            <span>⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼⎼</span>
        <div>
        
        <!-- Rodapé -->
        <div class="register-footer">
            Não tem uma conta? <a href="TelaGerarLogin.php">Cadastre-se</a>
        </div>
    </main>

</body>
</html>

<?php

?>
