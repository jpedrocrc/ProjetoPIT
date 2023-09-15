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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Comparação de Serviços</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            margin: 20px;
            color: white;
        }

        .freelancer {
            background-color: #212529;
            color: white;
            margin: 10px;
            max-width: 45%;
        }

        .table-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            max-width: 45%;
            background-color: #212529;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body class="bg-image" style="background-image: url('../PHP/mainimg.png');">
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
    <?php
    ini_set('default_charset', 'UTF-8');
    include_once './Classes/config.php';
    require_once './Classes/ConexaoBD.php';
    require_once './Classes/CompararServiços.php';

    $conexao = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
    $conexao->conectar();

    $listaServicos = new CompararServicos($conexao);
    $servicos = $listaServicos->GetServicos();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['servico1']) && isset($_POST['servico2'])) {
        $servico1Id = $_POST['servico1'];
        $servico2Id = $_POST['servico2'];

        if ($servico1Id === $servico2Id) {
            echo "<h3 class='m-2 p-0 text-center'>Erro: Você não pode selecionar o mesmo freelancer duas vezes.</h3>";
        } else {
            $servico1Dados = $listaServicos->GetServicoPorId($servico1Id);
            $servico2Dados = $listaServicos->GetServicoPorId($servico2Id);

            if ($servico1Dados !== null && $servico2Dados !== null) {
                echo "<h3 class='mt-5 p-0 text-center'>Comparação de Serviços</h3>";
                 echo "<div class='container position-absolute top-50 start-50 translate-middle'>";

                echo "<div class='table-container'>";
                echo "<table>";
                echo "<tr><th>Serviço 1</th></tr>";
                echo "<tr><td>";
                $listaServicos->MostrarServicosSelecionados($servico1Dados);
                echo "</td></tr>";
                echo "</table>";
                echo "</div>";

                echo "<div class='table-container'>";
                echo "<table>";
                echo "<tr><th>Serviço 2</th></tr>";
                echo "<tr><td>";
                $listaServicos->MostrarServicosSelecionados($servico2Dados);
                echo "</td></tr>";
                echo "</table>";
                echo "</div>";

                echo "</div>";
            } else {
                echo "Erro ao obter dados dos serviços selecionados.";
            }
        }
    } else {
        echo "<h3 class='m-2 mt-5 text-center'>Selecione dois serviços para comparar:</h3>";
        echo "<form class='position-absolute top-50 start-50 translate-middle bg-dark p-1' action='' method='post'>";
        echo "<div class='text-center'>";
        echo "<label class='text-white' for='servico1'>Serviço 1:</label>";
        echo "<select name='servico1' id='servico1' class='form-select'>";
        foreach ($servicos as $servico) {
            echo "<option value='{$servico['ID_SERVICO']}'>{$servico['SERVICO_DESCRICAO']}</option>";
        }
        echo "</select>";

        echo "<label class='text-white mx-2' for='servico2'>Serviço 2:</label>";
        echo "<select name='servico2' id='servico2' class='form-select'>";
        foreach ($servicos as $servico) {
            echo "<option value='{$servico['ID_SERVICO']}'>{$servico['SERVICO_DESCRICAO']}</option>";
        }
        echo "</select>";

        echo "<div class='mt-2 text-center'><button class='btn btn-light' type='submit' onclick='return validarSelecao()'>Comparar</button></div>";
        echo "</div>";
        echo "</form>";
    }
    ?>
<script>
        function validarSelecao() {
            var freelancer1 = document.getElementById('freelancer1').value;
            var freelancer2 = document.getElementById('freelancer2').value;

            if (freelancer1 === freelancer2) {
                alert('Você não pode selecionar o mesmo freelancer duas vezes.');
                return false;
            }
            return true;
        }
    </script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
</body>

</html>
