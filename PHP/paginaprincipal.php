<?php
ini_set('default_charset', 'UTF-8');
session_start();

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../CSS/style.css">
</head>

<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <img id="logoo" src="logo.png" class="navbar-brand img-fluid scale-down" alt="Logo">
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

  <div class="main">
    <div class="main-content">
      <p>Conheça o maior site freelancer para pessoas sem experiência, evidencie suas habilidades,
        procure boas empresas e permita que elas te encontrem.</p>
      <input type="text" placeholder="Procure genios, empresas ou projetos">
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>