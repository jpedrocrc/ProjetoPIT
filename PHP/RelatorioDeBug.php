<?php
ini_set('default_charset', 'UTF-8');
session_start();

$nomeUsuario = isset($_SESSION['Nome']) ? $_SESSION['Nome'] : '';
$nome = isset($nomeUsuario['Nome']) ? $nomeUsuario['Nome'] : '';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Relatório de Bug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            background-color: #fff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #000000;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
        }

        input[type="file"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
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
    <div class="card text-white bg-dark position-absolute top-50 start-50 translate-middle">
        <h1 class="fs-1 text-center">Relatório de Bug</h1>
        <form action="ProcessarBug.php" method="post" class="p-2" enctype="multipart/form-data" onsubmit="return validarFormulario();">

            <!-- Nome do Remetente -->
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" style="width: 1000px" required>

            <!-- E-mail do Remetente -->
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <!-- Telefone do Remetente -->
            <label for="telefone">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" oninput="mascara_telefone()" maxlength="15">

            <!-- CPF do Remetente -->
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf"oninput="mascara_cpf()" maxlength="14">

            <!-- Descrição do Bug -->
            <label for="descricao">Descrição do Bug:</label>
            <textarea id="descricao" name="descricao" rows="5" required></textarea>

            <!-- Botão de Envio -->
            <div class="text-center">
            <input class="btn btn-light btn-lg" type="button" value="Enviar Relatório">
            </div>
        </form>
    </div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("nome").value;
            var email = document.getElementById("email").value;
            var telefone = document.getElementById("telefone").value;
            var cpf = document.getElementById("cpf").value;
            var descricao = document.getElementById("descricao").value;
    
            // Validar campos obrigatórios
            if (nome === "" || email === "" || descricao === "") {
                alert("Todos os campos obrigatórios devem ser preenchidos.");
                return false;
            }
    
            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
            if (telefone !== "" && !telefoneRegex.test(telefone)) {
                alert("Insira um número de telefone válido.");
                return false;
            }
    
            // Validar formato do CPF
            var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            if (cpf !== "" && !cpfRegex.test(cpf)) {
                alert("Insira um CPF válido.");
                return false;
            }
    
            // Validar formato do email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }
    
            // Resto da validação (se necessário)
    
            return true;
        }
        function formatarTelefone(input) {
            // Remove qualquer caractere não numérico do número de telefone
            var numero = input.value.replace(/\D/g, "");

            // Verifica se o número de telefone tem o tamanho correto
            if (numero.length !== 11) {
                input.setCustomValidity("Número de telefone inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no número formatado
            var telefoneFormatado = `(${numero.substring(0, 2)}) ${numero.substring(2, 7)}-${numero.substring(7)}`;

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
            var cpfFormatado = `${cpf.substring(0, 3)}.${cpf.substring(3, 6)}.${cpf.substring(6, 9)}-${cpf.substring(9)}`;

            // Atualiza o valor do campo de input com o CPF formatado
            input.value = cpfFormatado;
        }
        function mascara_telefone() {
            var telefone = document.getElementById("telefone");
            formatarTelefone(telefone);
        }
        function mascara_cpf() {
            var cpf = document.getElementById("cpf");
            formatarCPF(cpf);
        }
    </script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
          crossorigin="anonymous"></script>
</body>

</html>
