<?php
ini_set( 'default_charset', 'UTF-8' );
include_once './Classes/config.php';
require_once './Classes/ConexaoBD.php';
require_once './Classes/ListaFreelancers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $termoBusca = $_POST['termo_busca'];
}

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Freelancers Disponíveis</title>
  <style>
    /* Estilos gerais */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Barra de busca */
    .search-bar {
      background-color: #f2f2f2;
      padding: 20px;
    }

    .search-bar input[type="text"] {
      width: 300px;
      padding: 10px;
      font-size: 16px;
    }

    .search-bar input[type="submit"] {
      padding: 10px 20px;
      background-color: #646B71;
      border: none;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    /* Lista de freelancers */
    .freelancer-list {
      margin: 20px;
    }

    .freelancer {
      border: 1px solid #ccc;
      padding: 20px;
      margin-bottom: 10px;
    }

    .freelancer h3 {
      margin: 0;
      font-size: 20px;
    }

    .freelancer p {
      margin: 0;
      font-size: 16px;
    }
    .freelancer p.extra-info {
  display: none;
}
/* Estilo padrão do botão */
.mostrar-mais-btn {
  background-color: #646B71;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
  border-radius: 5px;
  font-weight: bold;
  transition: background-color 0.3s;
}

.mostrar-mais-btn:hover {
  background-color: #464d53;
}

/* Estilo do botão após ser clicado */
.mostrar-mais-btn.clicked {
  background-color: #464d53;
}

/* Estilo do botão quando os detalhes estão visíveis */
.mostrar-mais-btn.expandido {
  background-color: #ff9900;
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
  <div class="search-bar">
    <form method="POST">
      <input type="text" placeholder="Buscar freelancer" name="termo_busca" value="<?php echo isset($termoBusca) ? $termoBusca : ''; ?>">
      <input class="btn text-white" style="background-color: #646B71" type="button" value="Buscar">
      <a class="btn text-white" style="background-color: #646B71" href="..\PHP\CompararFreelancers.php" role="button">Comparar Freelancers</a>
    </form>
  </div>

  <div class="freelancer-list">
    <?php
    $conexao = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
    $conexao->conectar();

    $listaFreelancers = new ListaFreelancers($conexao);

    if (isset($termoBusca) && !empty($termoBusca)) {
      $listaFreelancers->PesquisarFreelancers($termoBusca);
    } else {
      $listaFreelancers->GetFreelancers();
    }

    $conexao->fecharConexao();
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
    <script>
  function mostrarMais(button) {
    var details = button.parentNode.querySelectorAll('p.extra-info');
    for (var i = 0; i < details.length; i++) {
      details[i].style.display = 'block';
    }
    button.style.display = 'none';
  }
</script>

</body>

</html>
