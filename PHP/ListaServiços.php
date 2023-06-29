<?php
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
  <div class="search-bar">
    <form method="POST">
      <input type="text" placeholder="Buscar freelancer" name="termo_busca" value="<?php echo isset($termoBusca) ? $termoBusca : ''; ?>">
      <input type="submit" value="Buscar">
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
</body>

</html>
