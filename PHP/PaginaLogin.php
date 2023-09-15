<?php
ini_set( 'default_charset', 'UTF-8');
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
    <!--<link rel="stylesheet" type="text/css" href="CSS\EmpresaeTalento.css">
    <link rel="stylesheet" type="text/css" href="CSS\style.css">
    <link rel="stylesheet" type="text/css" href="CSS\reset.css">-->
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
    <link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
      .password-toggle {
            position: absolute;
            right: 20px;
            top: 53%; 
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
<div class="container">
    <div class="card text-white bg-dark position-absolute top-50 start-50 translate-middle" style="max-width: 400px;">
      <div class="card-body">
        <h5 class="card-title">Bem-vindo de volta!</h5>
        <p class="card-text">Estamos entusiasmados por tê-lo de volta!</p>
        <form method="POST" onsubmit="return validarFormulario()">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Digite seu email"name="email">
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>   
            <input type="password" class="form-control" id="senha" placeholder="Digite sua senha" name="senha">
    <span class="password-toggle" onclick="alternarVisualizacao()">👁️</span>
          </div>
          <div class="mb-3">
            <a href="PaginaRecuperacaoSenha.html" class="text-decoration-none text-white">Esqueceu a senha?</a>
          </div>
          <button type="submit" class="btn form-control btn-light">Entrar</button>
          <div class="mt-1 mb-1 text-center">ou</div>
          <a type="submit" class="btn form-control btn-light" href="CadastroTalento.php">Cadastre-se</a>
        </form>
      </div>
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
        function alternarVisualizacao() {
            const senhaInput = document.getElementById("senha");
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
            } else {
                senhaInput.type = "password";
            }
        }
    </script>
</body>
</html>