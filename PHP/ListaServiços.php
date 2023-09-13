<?php
ini_set( 'default_charset', 'UTF-8' );
include_once './Classes/config.php';
require_once './Classes/ConexaoBD.php';
require_once './Classes/ListaServiços.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $termoBusca = $_POST['termo_busca'];
}

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title>Serviços Disponiveis</title>
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
    <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.php'">
  </header>
  <div class="search-bar">
    <form method="POST">
      <input type="text" placeholder="Buscar serviço" name="termo_busca" value="<?php echo isset($termoBusca) ? $termoBusca : ''; ?>">
      <input class="btn text-white" style="background-color: #646B71" type="button" value="Buscar">
      <a class="btn text-white" style="background-color: #646B71" href="..\PHP\CompararServiços.php" role="button">Comparar Serviços</a>
    </form>
  </div>

  <div class="freelancer-list">
    <?php
    $conexao = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
    $conexao->conectar();

    $ListaServicos = new ListaServicos($conexao);

    if (isset($termoBusca) && !empty($termoBusca)) {
      $ListaServicos->PesquisarServicos($termoBusca);
    } else {
      $ListaServicos->GetServicos();
    }

    $conexao->fecharConexao();
    ?>
  </div>
</body>

</html>
