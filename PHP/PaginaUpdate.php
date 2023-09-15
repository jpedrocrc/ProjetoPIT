<?php
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/UpdatePerfilTalento.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
 $conexaoBanco->conectar();
// Iniciar a sessão
session_start();
$UpdatePerfilTalento = new UpdatePerfilTalento($conexaoBanco);
$UpdatePerfilTalento->verificarUsuarioLogado();
$UpdatePerfilTalento->verificaPermissoes();
$idUsuario = $UpdatePerfilTalento->obterIdUsuario();
$UpdatePerfilTalento->atualizarDadosPerfil();
$dadosTalento = $UpdatePerfilTalento->obterDados();

$nomeUsuario = isset($_SESSION['Nome']) ? $_SESSION['Nome'] : '';
$nome = isset($nomeUsuario['Nome']) ? $nomeUsuario['Nome'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/upadate_pagina.css">
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
    <link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
  </style>
</head>

<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img id="logoo" src="logo.png" onclick="window.location.href='paginaprincipal.php'" class="navbar-brand img-fluid scale-down" alt="Logo" style="width: 150px">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown"
        aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Encontrar genios
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="ListaFreelancers.php">Lista de gênios</a></li>
              <li><a class="dropdown-item" href="CadastroHabilidade.php">Cadastrar Serviço</a></li>
              <li><a class="dropdown-item" href="AtualizarHabilidades.php">Atualizar Habilidades</a></li>
              <li><a class="dropdown-item" href="PaginaUpdateTalento.php">Atualizar perfil </a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Encontrar Empresas
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="CadastroEmpresa.php">Cadastrar como Empresa</a></li>
              <li><a class="dropdown-item" href="PaginaUpdateContratante.php">Atualizar dados Empresa</a></li>
              <li><a class="dropdown-item" href="CadastroServiço.php">Cadastrar Serviço</a></li>
              <li><a class="dropdown-item" href="AtualizarServiços.php">Atualizar Serviço</a></li>
              <li><a class="dropdown-item" href="ListaServiços.php">Lista de Serviços</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Nossa Empresa
            </button>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="FAQ.html">FAQ</a></li>
              <li><a class="dropdown-item" href="RelatorioDeBug.html">Relate seus Bugs</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
        </ul>
        <?php if (!empty($nomeUsuario)) : ?>
  <label class="navbar-text text-light">Bem-vindo, <?php echo $nomeUsuario; ?></label>
<?php endif; ?>

      </div>
      <div class="d-flex">
        <?php if (!empty($nomeUsuario)): ?>
          <form method="post" action="logout.php">
            <button class="btn btn-outline-light me-2" type="submit">Logout</button>
          </form>
        <?php else: ?>
          <button class="btn btn-outline-light me-2" type="button"
            onclick="window.location.href='PaginaLogin.php'">Login</button>
        <?php endif; ?>
        <button class="btn btn-light" type="button"
          onclick="window.location.href='CadastroTalento.php'">Registrar-se</button>
      </div>
    </div>
  </nav>
    <div class="card bg-dark text-white position-absolute top-50 start-50 translate-middle p-2">
    <h3 class="mb-4 p-2">Alterar os Dados do Perfil</h3>
    <form method="POST" onsubmit="return validarFormulario()">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" value="<?php echo isset($dadosTalento['NOME']) ? $dadosTalento['NOME'] : ""; ?>">
      </div>
      <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" placeholder="Digite seu telefone" 
        value="<?php echo isset($dadosTalento['TELEFONE']) ? $dadosTalento['TELEFONE'] : ""; ?>">
      </div>
      <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="CPF" placeholder="Digite seu CPF"
        value="<?php echo isset($dadosTalento['CPF']) ? $dadosTalento['CPF'] : ""; ?>">
      </div>
      <div class="mb-3">
        <label for="cep" class="form-label">CEP</label>
        <input type="text" class="form-control" id="CEP" placeholder="Digite seu CEP"
        value="<?php echo isset($dadosTalento['CEP']) ? $dadosTalento['CEP'] : ""; ?>">
      </div>
      <div class="text-center">
      <button type="submit" class="btn mt-3 btn-light">Atualizar Dados</button></div>
    </form>
  </div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("nome").value;
            var telefone = document.getElementById("telefone").value;
            var cpf = document.getElementById("CPF").value;
            var cep = document.getElementById("CEP").value;

            // Validar campos obrigatórios
            if (nome === "" || telefone === "" || cpf === "" || cep === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Insira um número de telefone válido.");
                return false;
            }

            // Validar formato do CPF
            var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            if (!cpfRegex.test(cpf)) {
                alert("Insira um CPF válido.");
                return false;
            }

            // Validar formato do CEP
            var cepRegex = /^\d{5}-\d{3}$/;
            if (!cepRegex.test(cep)) {
                alert("Insira um CEP válido.");
                return false;
            }

            return true;
        }
        function formatarTelefone(input) {
            // Remove qualquer caractere não numérico do número de telefone
            var numero = input.value.replace(/\D/g, "");

            // Verifica se o número de telefone tem o tamanho correto
            if (numero.length !== 10 && numero.length !== 11) {
                input.setCustomValidity("Número de telefone inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no número formatado
            var telefoneFormatado = "(" + numero.substring(0, 2) + ") ";
            if (numero.length === 10) {
                telefoneFormatado += numero.substring(2, 6) + "-" + numero.substring(6);
            } else {
                telefoneFormatado += numero.substring(2, 7) + "-" + numero.substring(7);
            }

            // Atualiza o valor do campo de input com o número formatado
            input.value = telefoneFormatado;
        }
        function formatarCPF(input) {
            // Remove qualquer caractere não numérico do CPF
            var cpf = input.value.replace(/\D/g, "");

            // Verifica se o CPF tem o tamanho correto
            if (cpf.length !== 11) {
                input.setCustomValidity("CPF inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no CPF formatado
            var cpfFormatado = cpf.substring(0, 3) + "." + cpf.substring(3, 6) + "." + cpf.substring(6, 9) + "-" + cpf.substring(9);

            // Atualiza o valor do campo de input com o CPF formatado
            input.value = cpfFormatado;
        }
        function formatarCEP(input) {
            // Remove qualquer caractere não numérico do CEP
            var cep = input.value.replace(/\D/g, "");

            // Verifica se o CEP tem o tamanho correto
            if (cep.length !== 8) {
                input.setCustomValidity("CEP inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no CEP formatado
            var cepFormatado = cep.substring(0, 5) + "-" + cep.substring(5);

            // Atualiza o valor do campo de input com o CEP formatado
            input.value = cepFormatado;
        }
        function mascara_telefone() {
            var telefone = document.getElementById("telefone");
            formatarTelefone(telefone);
        }
        function mascara_cpf() {
            var cpf = document.getElementById("CPF");
            formatarCPF(cpf);
        }
        function mascara_cep() {
            var cep = document.getElementById("CEP");
            formatarCEP(cep);
        }
    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>
