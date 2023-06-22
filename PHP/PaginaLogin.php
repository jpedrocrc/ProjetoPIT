<?php
require_once './Classes/ConexaoBD.php';
require_once './Classes/Autenticacao.php';
include_once './Classes/config.php';

session_start();

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();
$autenticacao = new Autenticacao($conexaoBanco);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $autenticacao->realizarLogin($email, $senha);   

    if (isset($_SESSION['idUsuario'])) {
        $idUsuario = $_SESSION['idUsuario'];
        $permissao = $_SESSION['permissao'];
        echo "ID do usuário: " . $idUsuario;
        echo $permissao;

    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="CSS\reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/
<link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
    <style>
    header {
      background-color: #646B71;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header img {
      cursor: pointer;
    }
  </style>
</head>
<body>
<header>
        <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.html'">
    </header>
    <div class="card">
        <div class="card-content">
            <div class="card-header">
                <h2>Bem-vindo de volta!</h2>
                <p>Estamos entusiasmados por tê-lo de volta!</p>
            </div>
            <form method="POST" onsubmit="return validarFormulario()">
                <div class="user-area">
                    <label>E-mail ou número de telefone</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="password-area">
                    <label>Senha</label>
                    <input type="password" id="password" name="senha">
                </div>
                <div class="password-save">
                    <h3><a>Esqueceu sua senha?</a></h3>
                </div>
                <div class="button-area">
                    <button type="submit" href="">Entrar</button>
                </div>
                <div class="new-account">
                    <h4>Precisando de uma conta?<span>Registre-se</span></h4>
                </div>
            </form>
        </div>
    </div>
    <script>
        function validarFormulario() {
            var email = document.getElementById("email").value;
            var senha = document.getElementById("password").value;

            // Validar campos obrigatórios
            if (email === "" || senha === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }

            return true;
        }
    </script>
</body>

</html>
