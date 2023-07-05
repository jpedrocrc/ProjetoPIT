<?php
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/UpdatePerfilTalento.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();
// Iniciar a sessão
session_start();
$UpdatePerfilTalento = new UpdatePerfilTalento($conexaoBanco);
$UpdatePerfilTalento->verificarUsuarioLogado();
$UpdatePerfilTalento->verificaPermissoes();
$idUsuario = $UpdatePerfilTalento->obterIdUsuario();
$UpdatePerfilTalento->atualizarDadosPerfil();
$dadosTalento = $UpdatePerfilTalento->obterDados();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/upadate_pagina.css">
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
<header>
        <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.html'">
    </header>
    <div class="content-card">
    <div class="tittle"><h1>Alterar Dados de Perfil</h1></div>
    <form method="POST" onsubmit="return validarFormulario()">
        <div class="form-content">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" class="forms-input"
            value="<?php echo isset($dadosTalento['NOME']) ? $dadosTalento['NOME'] : ""; ?>">
        <br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" oninput="mascara_telefone()" class="forms-input"
            value="<?php echo isset($dadosTalento['TELEFONE']) ? $dadosTalento['TELEFONE'] : ""; ?>">
        <br>
        <label for="CPF">CPF:</label>
        <input type="text" id="CPF" name="cpf" oninput="mascara_cpf()" class="forms-input"
            value="<?php echo isset($dadosTalento['CPF']) ? $dadosTalento['CPF'] : ""; ?>">
        <br>
        <label for="CEP">CEP:</label>
        <input type="text" id="CEP" name="cep" oninput="mascara_cep()" class="forms-input"
            value="<?php echo isset($dadosTalento['CEP']) ? $dadosTalento['CEP'] : ""; ?>">
        <br>
        <input type="submit" value="Atualizar Dados" id="button" href="">
    </div>
    </form>
</div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("nome").value;
            var telefone = document.getElementById("telefone").value;
            var cpf = document.getElementById("CPF").value;
            var cep = document.getElementById("CEP").value;

            // Validar campos obrigatórios
            if (nome === "" || telefone === "" || cpf === "" || cep === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Insira um número de telefone válido.");
                return false;
            }

            // Validar formato do CPF
            var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            if (!cpfRegex.test(cpf)) {
                alert("Insira um CPF válido.");
                return false;
            }

            // Validar formato do CEP
            var cepRegex = /^\d{5}-\d{3}$/;
            if (!cepRegex.test(cep)) {
                alert("Insira um CEP válido.");
                return false;
            }

            return true;
        }
        function formatarTelefone(input) {
            // Remove qualquer caractere não numérico do número de telefone
            var numero = input.value.replace(/\D/g, "");

            // Verifica se o número de telefone tem o tamanho correto
            if (numero.length !== 10 && numero.length !== 11) {
                input.setCustomValidity("Número de telefone inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no número formatado
            var telefoneFormatado = "(" + numero.substring(0, 2) + ") ";
            if (numero.length === 10) {
                telefoneFormatado += numero.substring(2, 6) + "-" + numero.substring(6);
            } else {
                telefoneFormatado += numero.substring(2, 7) + "-" + numero.substring(7);
            }

            // Atualiza o valor do campo de input com o número formatado
            input.value = telefoneFormatado;
        }
        function formatarCPF(input) {
            // Remove qualquer caractere não numérico do CPF
            var cpf = input.value.replace(/\D/g, "");

            // Verifica se o CPF tem o tamanho correto
            if (cpf.length !== 11) {
                input.setCustomValidity("CPF inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no CPF formatado
            var cpfFormatado = cpf.substring(0, 3) + "." + cpf.substring(3, 6) + "." + cpf.substring(6, 9) + "-" + cpf.substring(9);

            // Atualiza o valor do campo de input com o CPF formatado
            input.value = cpfFormatado;
        }
        function formatarCEP(input) {
            // Remove qualquer caractere não numérico do CEP
            var cep = input.value.replace(/\D/g, "");

            // Verifica se o CEP tem o tamanho correto
            if (cep.length !== 8) {
                input.setCustomValidity("CEP inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no CEP formatado
            var cepFormatado = cep.substring(0, 5) + "-" + cep.substring(5);

            // Atualiza o valor do campo de input com o CEP formatado
            input.value = cepFormatado;
        }
        function mascara_telefone() {
            var telefone = document.getElementById("telefone");
            formatarTelefone(telefone);
        }
        function mascara_cpf() {
            var cpf = document.getElementById("CPF");
            formatarCPF(cpf);
        }
        function mascara_cep() {
            var cep = document.getElementById("CEP");
            formatarCEP(cep);
        }
    </script>

</body>

</html>
