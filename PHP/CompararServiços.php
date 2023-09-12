<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparação de Serviços</title>
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
    </style>
</head>

<body>
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

    $servico1Dados = $listaServicos->GetServicoPorId($servico1Id);
    $servico2Dados = $listaServicos->GetServicoPorId($servico2Id);

    if ($servico1Dados !== null && $servico2Dados !== null) {
        echo "<h1>Comparação de Serviços</h1>";
        echo "<div class='container'>";
        
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
} else {
    echo "<h1>Selecione dois serviços para comparar:</h1>";
    echo "<form action='' method='post'>";
    echo "<label for='servico1'>Serviço 1:</label>";
    echo "<select name='servico1' id='servico1'>";
    foreach ($servicos as $servico) {
        echo "<option value='{$servico['ID_SERVICO']}'>{$servico['SERVICO_DESCRICAO']}</option>";
    }
    echo "</select>";

    echo "<label for='servico2'>Serviço 2:</label>";
    echo "<select name='servico2' id='servico2'>";
    foreach ($servicos as $servico) {
        echo "<option value='{$servico['ID_SERVICO']}'>{$servico['SERVICO_DESCRICAO']}</option>";
    }
    echo "</select>";

    echo "<button type='submit'>Comparar</button>";
    echo "</form>";
}
?>

</body>

</html>