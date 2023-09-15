<?php
ini_set('default_charset', 'UTF-8');

// Chamando arquivos externos
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/CadastrarServico.php';
session_start();

// Classe ConexaoBD
$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

// classe CadastrarServico
$cadastrarServico = new CadastrarServico($conexaoBanco);
$cadastrarServico->verificarUsuarioLogado();
$cadastrarServico->cadastrar();

$conexaoBanco->fecharConexao();

$nomeUsuario = isset($_SESSION['Nome']) ? $_SESSION['Nome'] : '';
$nome = isset($nomeUsuario['Nome']) ? $nomeUsuario['Nome'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="../css/cadastroservico.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .custom-form {
            height: auto;
            margin: 0 auto;
        }
    </style>
</head>

<body style="background-image: url('../PHP/mainimg.png'); height: 100vh">
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
    <div class="container mb-2">
        <div class="card bg-dark text-white custom-form position-absolute top-50 start-50 translate-middle p-2">
            <div class="card-body">
                <h1 class="card-title mb-2">Registro de Serviço</h1>

                <form method="POST" onsubmit="return validarFormulario()">
                    <div class="mb-1 row">
                        <label for="descricao" class="form-label col-sm-4">Descrição:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="descricao" rows="2" cols="50"></textarea>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="servico" class="form-label col-sm-4">Tipo de Serviço:</label>
                        <div class="col-sm-8">
                            <select class="form-select" id="servico" name="servico" required>
                                <option value="">Selecione o serviço</option>
                                <option value="Agricultura">Agricultura</option>
                                <option value="Alvenaria">Alvenaria</option>
                                <option value="Arquitetura">Arquitetura</option>
                                <option value="Assessoria Contábil">Assessoria Contábil</option>
                                <option value="Assessoria Jurídica">Assessoria Jurídica</option>
                                <option value="Concretagem">Concretagem</option>
                                <option value="Construção civil">Construção civil</option>
                                <option value="Construção e Reforma">Construção e Reforma</option>
                                <option value="Demolição">Demolição</option>
                                <option value="Design Gráfico">Design Gráfico</option>
                                <option value="Design de Interiores">Design de Interiores</option>
                                <option value="Desenvolvimento de Software">Desenvolvimento de Software</option>
                                <option value="Eletricista">Eletricista</option>
                                <option value="Encanador">Encanador</option>
                                <option value="Fotografia">Fotografia</option>
                                <option value="Jardinagem">Jardinagem</option>
                                <option value="Limpeza residencial">Limpeza residencial</option>
                                <option value="Manutenção Residencial">Manutenção Residencial</option>
                                <option value="Manutenção de Veículos">Manutenção de Veículos</option>
                                <option value="Marketing Digital">Marketing Digital</option>
                                <option value="Montagem de móveis">Montagem de móveis</option>
                                <option value="Movimentação de cargas">Movimentação de cargas</option>
                                <option value="Paisagismo">Paisagismo</option>
                                <option value="Pedreiro">Pedreiro</option>
                                <option value="Pintura residencial">Pintura residencial</option>
                                <option value="Redação de Conteúdo">Redação de Conteúdo</option>
                                <option value="Serralheria">Serralheria</option>
                                <option value="Serviços de Delivery">Serviços de Delivery</option>
                                <option value="Serviços de Limpeza">Serviços de Limpeza</option>
                                <option value="Serviços de TI">Serviços de TI</option>
                                <option value="Telhados">Telhados</option>
                                <option value="Topografia">Topografia</option>
                                <option value="Tradução">Tradução</option>
                                <option value="Vídeo e Edição">Vídeo e Edição</option>
                                <option value="Web Design">Web Design</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="nomeEmpresa" class="form-label col-sm-4">Nome da Empresa:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nomeEmpresa" name="nomeEmpresa">
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="horario" class="form-label col-sm-4">Horário:</label>
                        <div class="col-sm-8">
                            <input type="time" class="form-control" id="horario" name="horario">
                        </div>
                    </div>

                    <!-- <div class="mb-1">
                        <label class="form-label">Habilidades:</label><br>
                        <div class="container">
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="habilidades[]" value="Inglês"> Inglês <br>
                                <input type="checkbox" name="habilidades[]" value="Competência"> Competência<br>
                                <input type="checkbox" name="habilidades[]" value="Criatividade"> Criatividade<br>
                                <input type="checkbox" name="habilidades[]" value="Comunicação"> Comunicação <br>
                                <input type="checkbox" name="habilidades[]" value="Resolução de Problemas"> Resolução de Problemas <br>
                                <input type="checkbox" name="habilidades[]" value="Trabalho em Equipe"> Trabalho em Equipe<br>
                                <input type="checkbox" name="habilidades[]" value="Pensamento Analítico"> Pensamento Analítico<br>

                            </div>
                            <div class="col">
                                <input type="checkbox" name="habilidades[]" value="Organização"> Organização<br>
                                <input type="checkbox" name="habilidades[]" value="Pensamento Criativo"> Pensamento Criativo<br>
                                <input type="checkbox" name="habilidades[]" value="Gestão de Projetos"> Gestão de Projetos<br>
                                <input type="checkbox" name="habilidades[]" value="Habilidades Interpessoais"> Habilidades Interpessoais<br>
                                <input type="checkbox" name="habilidades[]" value="Tomada de Decisão"> Tomada de Decisão<br>
                                <input type="checkbox" name="habilidades[]" value="Paciência"> Paciência<br>
                                <input type="checkbox" name="habilidades[]" value="Resiliência"> Resiliência<br>
                            </div>
                        </div>
                        </div> -->

            </div>

            <div class="mb-1">
                <label for="valor" class="form-label">Valor:</label>
                <input type="text" class="form-control" id="valor" name="valor">
            </div>

            <div class="mb-1">
                <label for="contato" class="form-label">Contato:</label>
                <input type="text" class="form-control" id="contato" name="contato">
            </div>

            <div class="text-center mt-2">
                <button type="submit" class="btn btn-light" href="">Registrar</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    <script>
        function validarFormulario() {
            const horarioInput = document.getElementById('horario');
            const horarioPattern = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;

            if (horarioPattern.test(horarioInput.value)) {
                // O horário é válido, envie o formulário
                return true;
            } else {
                // O horário é inválido, exiba uma mensagem de erro
                alert('Insira um horário válido no formato HH:MM');
                return false;
            }
        }
    </script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>