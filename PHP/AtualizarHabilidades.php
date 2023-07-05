<?php
ini_set('default_charset', 'UTF-8');

// Chamando arquivos externos
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/AtualizarHabilidades.php';

// Criação da instância de conexão
$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

// Verifica se o usuário está logado
session_start();
$AtualizarHabilidades = new AtualizarHabilidades($conexaoBanco);
$AtualizarHabilidades->processarAcoesFormulario();
$dadosServico = $AtualizarHabilidades->obterServico();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="cadastroservico.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
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
    <header>
        <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.html'">
    </header>

    <div class="body-content">
        <h1 id="tittle">Atualizar Habilidades</h1>

        <form method="POST" onsubmit="return validarFormulario()">
            <div class="escolha-servico">
                <label for="descricao">Insira uma descrição do seu serviço:</label>
                <textarea name="descricao" rows="5"
                    cols="50"><?php echo isset($dadosServico['DESCRICAO']) ? $dadosServico['DESCRICAO'] : ''; ?></textarea>
            </div>

            <label for="servico">Tipo de Serviço:</label><br>
            <select id="servico" name="servico" required>
                <option value="">Selecione o serviço</option>
                <?php
                $opcoes = array(
                    "Agricultura",
                    "Alvenaria",
                    "Arquitetura",
                    "Assessoria Contábil",
                    "Assessoria Jurídica",
                    "Concretagem",
                    "Construção civil",
                    "Construção e Reforma",
                    "Demolição",
                    "Design Gráfico",
                    "Design de Interiores",
                    "Desenvolvimento de Software",
                    "Eletricista",
                    "Encanador",
                    "Fotografia",
                    "Jardinagem",
                    "Limpeza residencial",
                    "Manutenção Residencial",
                    "Manutenção de Veículos",
                    "Marketing Digital",
                    "Montagem de móveis",
                    "Movimentação de cargas",
                    "Paisagismo",
                    "Pedreiro",
                    "Pintura residencial",
                    "Redação de Conteúdo",
                    "Serralheria",
                    "Serviços de Delivery",
                    "Serviços de Limpeza",
                    "Serviços de TI",
                    "Telhados",
                    "Topografia",
                    "Tradução",
                    "Vídeo e Edição",
                    "Web Design"
                );

                foreach ($opcoes as $opcao) {
                    $selecionado = ($dadosServico['SERVICO'] === $opcao) ? 'selected' : '';
                    echo '<option value="' . $opcao . '" ' . $selecionado . '>' . $opcao . '</option>';
                }
                ?>
            </select>

            <div class="button-submit">
                <input type="submit" value="Atualizar" id="button" name="atualizar">
                <input type="submit" value="Deletar" id="button" name="deletar">
            </div>
        </form>
    </div>
</body>

</html>