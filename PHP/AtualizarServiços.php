<?php
ini_set( 'default_charset', 'UTF-8' );
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
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/
<link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
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
    
</body>
</html>

<body>
<header>
    <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.html'">
  </header>
    <div class="body-content">
    <h1 id="tittle">Registro de Serviço</h1>

    <form method="POST" onsubmit="return validarFormulario()">
        <div class="escolha-servico">
        <label for="descricao">Insira uma descrição do seu serviço:</label>
        <textarea name="descricao" rows="5" cols="50"></textarea>
    </div>

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
        <div class="button-submit">
        <input type="submit" value="Registrar" id="button">
        </div>
    </form>
</div>
</body>

</html>
