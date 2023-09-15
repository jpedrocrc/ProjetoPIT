<?php
ini_set( 'default_charset', 'UTF-8' );

//Chamando arquivos externos
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/CadastroHabilidade.php';
session_start();

//Classe ConexaoBD
$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

//classe CadastrarHabilidade
$CadastrarHabilidade = new CadastrarHabilidade($conexaoBanco);
$CadastrarHabilidade->verificarUsuarioLogado();
$CadastrarHabilidade->cadastrar();

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
    <link rel="stylesheet" type="text/css" href="../css/cadastroservico.css">
    <title>Document</title>
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
    <h1>Registro de Serviço</h1>

    <form method="POST" onsubmit="return validarFormulario()">
        <label for="descricao">Insira uma descrição do seu serviço:</label><br>
        <textarea name="descricao" rows="5" cols="50"></textarea><br>

        <label for="servico">Tipo de Serviço:</label><br>
        <select id="servico" name="servico" required>
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

        <input type="submit" value="Registrar" href="">
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>
