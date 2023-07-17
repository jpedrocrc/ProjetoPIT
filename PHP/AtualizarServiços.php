<?php
// Chamando arquivos externos
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/Servico.php';

// Criação da instância de conexão
$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

// Verifica se o usuário está logado
session_start();
$servico = new Servico($conexaoBanco);
$servico->processarAcoesFormulario();
$dadosServico = $servico->obterServico();
$servico->exibirInformacoesServico($dadosServico);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="cadastroservico.css">
  <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/">
  <link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

</body>

</html>

<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
  <header>
    <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.php'">
  </header>
  <div class="card text-white bg-dark position-absolute top-50 start-50 translate-middle p-3" style="max-width: 400px;">
    <h1>Registro de Serviço</h1>

    <form method="POST" onsubmit="return validarFormulario()">
      <label for="descricao">Insira uma descrição sobre sua habilidade:</label>
      <div class="text-center">
        <textarea name="descricao" rows="5"
          cols="45"><?php echo isset($dadosServico['DESCRICAO']) ? $dadosServico['DESCRICAO'] : ''; ?></textarea>
      </div>

      <label for="servico">Tipo de Serviço:</label><br>
      <select id="servico" name="servico" required>
        option value="">Selecione o serviço</option>
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

      <div class="text-center mt-2">
        <button type="submit" class="btn btn-light" value="Atualizar" id="button" name="atualizar"
          href="">Atualizar</button>
        <button type="submit" class="btn btn-light" value="Deletar" id="button" name="deletar" href="">Deletar</button>
      </div>
    </form>
  </div>
</body>

</html>