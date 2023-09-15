<?php
ini_set('default_charset', 'UTF-8');
require_once './Classes/ConexaoBD.php';
require_once './Classes/CadastrarTalento.php';
include_once './Classes/config.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

$cadastroTalento = new CadastroTalento($conexaoBanco);
$cadastroTalento->cadastrar();

$conexaoBanco->fecharConexao();

$nomeUsuario = isset($_SESSION['Nome']) ? $_SESSION['Nome'] : '';
$nome = isset($nomeUsuario['Nome']) ? $nomeUsuario['Nome'] : '';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Criar Conta</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/EmpresaeTalento.css">
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
    <link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        body {
            color: white;
        }

        .main-input {
            background-color: transparent;
            border: solid 0.1px white;
            padding: 10px;
            padding-right: 30px;
        }

        #erro-senha {
            color: red;
        }

        .valido {
            color: green;
        }
        .label-area {
            display: flex;
            flex-direction: column;
            position: relative;
            margin-bottom: 10px;
        }

        .form-label {
            margin-bottom: 1px;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 72%; 
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>


<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh" onload="mostrarRequisitos()">
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
    <div class="body-content ">
        <div class="card-container">
            <form method="POST" onsubmit="return validarFormulario()">
                <div class="form-header">
                    <div class="tittle mt-3 mb-3">
                        <h3>Inscreva-se como talento</h3>
                    </div>
                    <div class="text-center mb-2">
                        <button class="btn btn-light border-info rounded w-75 p-0">
                            Entrar com Google
                        </button>
                    </div>
                    <div class="text-center mb-2">
                        <button class="btn btn-light border-secondary rounded w-75 p-0">
                            Entrar com Apple
                        </button>
                    </div>
                    <div class="container text-center mb-2 mt-3">
                        <div class="row px-5">
                            <div class="col border-bottom">
                            </div>
                            <div class="col border-bottom">
                            </div>
                            <div class="col border-bottom">
                            </div>
                        </div>
                    </div>
                    <div class="form-main">
                        <div class="label-area w-100">
                            <label for="user" class="form-label">Nome</label>
                            <input type="text" class="main-input" id="user" name="nome">
                        </div>
                        <div class="label-area w-100">
                            <label for="user2" class="form-label">Sobrenome</label>
                            <input type="text" class="main-input " id="user2" name="sobrenome">
                        </div>
                        <div class="container" style="margin-left: 50px">
                            <div class="row">
                                <div class="col">
                                    <div class="label-area px-0">
                                        <label for="cpf-number" class="form-label">CPF</label>
                                        <input type="text" class="main-input" id="cpf-number" oninput="mascara_cpf()" maxlength="14"
                                            name="cpf">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-area px-3">
                                        <label for="cep-number" class="form-label">CEP</label>
                                        <input type="text" class="main-input w-100" style="max-width: 160px"
                                            id="cep-number" oninput="mascara_cep()" name="cep">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="label-area w-100">
                            <label for="email-adress" class="form-label">Email</label>
                            <input type="email" class="main-input" id="email-adress" name="email">
                        </div>
                        <div class="label-area">
                            <label for="tel-number" class="form-label">Telefone</label>
                            <input type="tel" class="main-input" id="tel-number" oninput="mascara_telefone()" maxlength="15"
                                name="telefone">
                        </div>
                        <div class="label-area">
                            <label for="passw" class="form-label">Senha</label>
                            <input type="password" class="main-input" id="passw" name="senha"
                                oninput="mostrarRequisitos()">
                            <span class="password-toggle" onclick="alternarVisualizacao()">👁️</span>
                        </div>
                        <div id="requisitos-senha"></div>
                    </div>
                    <div class="form-footer">
                        <div class="info1-area">
                            <label for="att-check" class="checkbox-label"><input type="checkbox" id="att-check"
                                    class="checkbox-input me-2">Envie-me e-mails com dicas sobre como
                                encontrar
                                talentos que atendam às
                                minhas necessidades.</label>
                        </div>
                        <div class="info2-area">
                            <label for="att-check2" class="checkbox-label2 align-text-top"><input type="checkbox"
                                    id="att-check2" class="checkbox-input2 me-2"> Sim, eu entendo e concordo com os
                                Termos de
                                Serviço do HireGeniuses,
                                incluindo o Contrato do Usuário e a Política de Privacidade.</label>
                        </div>
                    </div>
                    <div class="form-footer2">
                        <div class="p-3 text-lg-center">
                            <button type="submit" class="btn btn-light fs-5  px-5" href="">Cadastrar</button>
                        </div>
                        <div class="text-footer">
                            <h2>Já tem uma conta?</h2>
                            <a id="link-conect">
                                <h2>Faça Login</h2>
                            </a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("user").value;
            var sobrenome = document.getElementById("user2").value;
            var email = document.getElementById("email-adress").value;
            var telefone = document.getElementById("tel-number").value;
            var cpf = document.getElementById("cpf-number").value;
            var cep = document.getElementById("cep-number").value;
            var senha = document.getElementById("passw").value;
            var checkbox = document.getElementById("att-check2").value;

            // Validar campos obrigatórios
            if (nome === "" || sobrenome === "" || email === "" || telefone === "" || cpf === "" || cep === "" || senha === "" || checkbox === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Insire um número de telefone válido.");
                return false;
            }

            // Validar formato do CPF
            var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            if (!cpfRegex.test(cpf)) {
                alert("Insire um CPF válido.");
                return false;
            }

            // Validar formato do CEP
            var cepRegex = /^\d{5}-\d{3}$/;
            if (!cepRegex.test(cep)) {
                alert("Insira um CEP válido.");
                return false;
            }

            // Validar formato do email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }
            // Validar senha
            mostrarRequisitos();
            var senha = document.getElementById('passw').value;
            var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (!pattern.test(senha)) {
                document.getElementById('erro-senha').textContent = "A senha não atende aos requisitos.";
                return false;
            }

            document.getElementById('erro-senha').textContent = "";
            return true;

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
            var cepFormatado = `${cep.substring(0, 5)}-${cep.substring(5)}`;

            // Atualiza o valor do campo de input com o CEP formatado
            input.value = cepFormatado;
        }
        function mascara_telefone() {
            var telefone = document.getElementById("tel-number");
            formatarTelefone(telefone);
        }
        function mascara_cpf() {
            var cpf = document.getElementById("cpf-number");
            formatarCPF(cpf);
        }
        function mascara_cep() {
            var cep = document.getElementById("cep-number");
            formatarCEP(cep);
        }

        function mostrarRequisitos() {
            var senha = document.getElementById('passw').value;
            var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            var mensagem = "A senha deve conter:<br>";
            if (!senha.match(/[a-z]/g)) mensagem += "- Pelo menos uma letra minúscula;<br>";
            else mensagem += "- <span class='valido'>Pelo menos uma letra minúscula;</span><br>";

            if (!senha.match(/[A-Z]/g)) mensagem += "- Pelo menos uma letra maiúscula;<br>";
            else mensagem += "- <span class='valido'>Pelo menos uma letra maiúscula;</span><br>";

            if (!senha.match(/\d/g)) mensagem += "- Pelo menos um número;<br>";
            else mensagem += "- <span class='valido'>Pelo menos um número;</span><br>";

            if (!senha.match(/[@$!%*?&]/g)) mensagem += "- Pelo menos um caracter especial (@, $, !, %, *, ?, &);<br>";
            else mensagem += "- <span class='valido'>Pelo menos um caracter especial (@, $, !, %, *, ?, &);</span><br>";

            if (senha.length >= 8) mensagem += "- <span class='valido'>No mínimo 8 caracteres;</span><br>";
            else mensagem += "- No mínimo 8 caracteres;<br>";

            document.getElementById('requisitos-senha').innerHTML = mensagem;
        }
        function alternarVisualizacao() {
            const senhaInput = document.getElementById("passw");
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
            } else {
                senhaInput.type = "password";
            }
        }
    </script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>