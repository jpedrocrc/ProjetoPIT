<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Comparação de Freelancers</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            margin: 20px;
        }

        .freelancer {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            max-width: 45%;
        }

        .table-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            max-width: 45%;
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
<div class="bg-dark text-white position-absolute top-50 start-50 translate-middle">
    <?php
    ini_set('default_charset', 'UTF-8');
    include_once './Classes/config.php';
    require_once './Classes/ConexaoBD.php';
    require_once './Classes/CompararFreelancers.php';

    $conexao = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
    $conexao->conectar();

    $listaFreelancers = new CompararFreelancers($conexao);
    $freelancers = $listaFreelancers->GetFreelancers();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['freelancer1']) && isset($_POST['freelancer2'])) {
        $freelancer1Id = $_POST['freelancer1'];
        $freelancer2Id = $_POST['freelancer2'];

        $freelancer1Dados = $listaFreelancers->GetFreelancerPorId($freelancer1Id);
        $freelancer2Dados = $listaFreelancers->GetFreelancerPorId($freelancer2Id);

        if ($freelancer1Dados !== null && $freelancer2Dados !== null) {
            echo "<h3 class='m-2'>Comparação de Freelancers</h3>";
            echo "<div class='container'>";

            echo "<div class='table-container'>";
            echo "<table>";
            echo "<tr><th>Freelancer 1</th></tr>";
            echo "<tr><td>";
            $listaFreelancers->MostrarFreelancersSelecionados($freelancer1Dados);
            echo "</td></tr>";
            echo "</table>";
            echo "</div>";

            echo "<div class='table-container'>";
            echo "<table>";
            echo "<tr><th>Freelancer 2</th></tr>";
            echo "<tr><td>";
            $listaFreelancers->MostrarFreelancersSelecionados($freelancer2Dados);
            echo "</td></tr>";
            echo "</table>";
            echo "</div>";

            echo "</div>";
        } else {
            echo "Erro ao obter dados dos freelancers selecionados.";
        }
    } else {
        echo "<h3 class='m-2'>Selecione dois freelancers para comparar:</h3>";
        echo "<form action='' method='post'>";
        echo "<div class='text-center'>";
        echo "<label for='freelancer1'>Freelancer 1:</label>";
        echo "<select name='freelancer1' id='freelancer1'>";
        foreach ($freelancers as $freelancer) {
            echo "<option value='{$freelancer['ID_FREELANCER']}'>{$freelancer['NOME']}</option>";
        }
        echo "</select>";

        echo "<label for='freelancer2'>Freelancer 2:</label>";
        echo "<select name='freelancer2' id='freelancer2'>";
        foreach ($freelancers as $freelancer) {
            echo "<option value='{$freelancer['ID_FREELANCER']}'>{$freelancer['NOME']}</option>";
        }
        echo "</select>";

        echo "<div class='mt-2 text-center'><button class='btn btn-light' type='submit'>Comparar</button></div>";
        echo "</div>";
        echo "</form>";
    }
    ?>
</div>
</body>

</html>
