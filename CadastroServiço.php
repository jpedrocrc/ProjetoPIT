<?php
ini_set('default_charset', 'UTF-8');

// Chamando arquivos externos
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/CadastrarServico.php';
session_start();

// Classe ConexaoBD
$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

// classe CadastrarServico
$cadastrarServico = new CadastrarServico($conexaoBanco);
$cadastrarServico->verificarUsuarioLogado();
$cadastrarServico->cadastrar();

$conexaoBanco->fecharConexao();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cadastroservico.css">
    <title>Document</title>
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
    <h1>Registro de Serviço</h1>

    <form method="POST" onsubmit="return validarFormulario()">
        <label for="descricao">Insira uma descrição do seu serviço:</label><br>
        <textarea name="descricao" rows="5" cols="50"></textarea><br>

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
        </select><br>

        <label for="nomeEmpresa">Nome da Empresa:</label><br>
        <input type="text" id="nomeEmpresa" name="nomeEmpresa"><br>

        <label for="horario">Horário:</label><br>
        <input type="time" id="horario" name="horario" onsubmit="validarFormulario()"><br>

        <label for="habilidades">Habilidades:</label><br>
        <input type="checkbox" name="habilidades[]" value="Inglês"> Inglês<br>
        <input type="checkbox" name="habilidades[]" value="Competência"> Competência<br>
        <input type="checkbox" name="habilidades[]" value="Criatividade"> Criatividade<br>
        <input type="checkbox" name="habilidades[]" value="Comunicação"> Comunicação<br>
        <input type="checkbox" name="habilidades[]" value="Resolução de Problemas"> Resolução de Problemas<br>
        <input type="checkbox" name="habilidades[]" value="Trabalho em Equipe"> Trabalho em Equipe<br>
        <input type="checkbox" name="habilidades[]" value="Pensamento Analítico"> Pensamento Analítico<br>
        <input type="checkbox" name="habilidades[]" value="Gestão de Tempo"> Gestão de Tempo<br>
        <input type="checkbox" name="habilidades[]" value="Liderança"> Liderança<br>
        <input type="checkbox" name="habilidades[]" value="Negociação"> Negociação<br>
        <input type="checkbox" name="habilidades[]" value="Adaptabilidade"> Adaptabilidade<br>
        <input type="checkbox" name="habilidades[]" value="Empatia"> Empatia<br>
        <input type="checkbox" name="habilidades[]" value="Organização"> Organização<br>
        <input type="checkbox" name="habilidades[]" value="Aprendizado Contínuo"> Aprendizado Contínuo<br>
        <input type="checkbox" name="habilidades[]" value="Pensamento Criativo"> Pensamento Criativo<br>
        <input type="checkbox" name="habilidades[]" value="Gestão de Projetos"> Gestão de Projetos<br>
        <input type="checkbox" name="habilidades[]" value="Habilidades Interpessoais"> Habilidades Interpessoais<br>
        <input type="checkbox" name="habilidades[]" value="Trabalho Sob Pressão"> Trabalho Sob Pressão<br>
        <input type="checkbox" name="habilidades[]" value="Tomada de Decisão"> Tomada de Decisão<br>
        <input type="checkbox" name="habilidades[]" value="Paciência"> Paciência<br>
        <input type="checkbox" name="habilidades[]" value="Resiliência"> Resiliência<br>
        <input type="checkbox" name="habilidades[]" value="Facilidade de Comunicação"> Facilidade de Comunicação<br>
        <input type="checkbox" name="habilidades[]" value="Empreendedorismo"> Empreendedorismo<br>
        <input type="checkbox" name="habilidades[]" value="Habilidades Analíticas"> Habilidades Analíticas<br>
        <input type="checkbox" name="habilidades[]" value="Flexibilidade"> Flexibilidade<br>
        <input type="checkbox" name="habilidades[]" value="Organização de Eventos"> Organização de Eventos<br>

        <label for="valor">Valor:</label><br>
        <input type="text" id="valor" name="valor"><br>

        <label for="contato">Contato:</label><br>
        <input type="text" id="contato" name="contato"><br>

        <input type="submit" value="Registrar">
    </form>

    <script>
        function validarFormulario() {
            const horarioInput = document.getElementById('horario');
            const horarioPattern = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;

            if (horarioPattern.test(horarioInput.value)) {
                // O horário é válido, envie o formulário
                return true;
            } else {
                // O horário é inválido, exiba uma mensagem de erro
                alert('Insira um horário válido no formato HH:MM');
                return false;
            }
        }
    </script>
</body>

</html>