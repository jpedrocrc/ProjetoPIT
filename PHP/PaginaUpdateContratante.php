<?php
require_once './Classes/ConexaoBD.php';
include_once './Classes/config.php';
require_once './Classes/UpdatePerfilContratante.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();
// Iniciar a sessão
session_start();
$UpdatePerfilContratante = new UpdatePerfilContratante($conexaoBanco);
$UpdatePerfilContratante->verificarUsuarioLogado();
$UpdatePerfilContratante->verificaPermissoes();
$idUsuario = $UpdatePerfilContratante->obterIdUsuario();
$UpdatePerfilContratante->atualizarDadosPerfil();
$dadosTalento = $UpdatePerfilContratante->obterDados();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/upadate_pagina.css">
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

<body class="bg-image" style="background-image: url('../PHP/mainimg.png');">
    <header>
        <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.php'">
    </header>
    <div class="content-card text-white">
        <div class="tittle">
            <h1>Alterar Dados de Perfil</h1>
        </div>
        <form method="POST" onsubmit="return validarFormulario()">
            <div class="form-content">
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome"
                            value="<?php echo isset($dadosTalento['NOME']) ? $dadosTalento['NOME'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone"
                            placeholder="Digite seu telefone" oninput="mascara_telefone()" class="forms-input"
                            value="<?php echo isset($dadosTalento['TELEFONE']) ? $dadosTalento['TELEFONE'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="CNPJ" name="CNPJ" placeholder="Digite seu CNPJ"
                            oninput="mascara_CNPJ()" class="forms-input"
                            value="<?php echo isset($dadosTalento['CNPJ']) ? $dadosTalento['CNPJ'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" id="CEP" name="cep" placeholder="Digite seu CEP"
                            oninput="mascara_cep()" class="forms-input"
                            value="<?php echo isset($dadosTalento['CEP']) ? $dadosTalento['CEP'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="ENDERECO" name="ENDERECO"
                            placeholder="Digite seu Endereço"
                            value="<?php echo isset($dadosTalento['ENDERECO']) ? $dadosTalento['ENDERECO'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro"
                            placeholder="Digite seu Bairro"
                            value="<?php echo isset($dadosTalento['bairro']) ? $dadosTalento['bairro'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade"
                            placeholder="Digite sua Cidade"
                            value="<?php echo isset($dadosTalento['cidade']) ? $dadosTalento['cidade'] : ""; ?>">
                    </div>

                    <!-- <label for="estado">Selecione o estado:</label>
                <select id="estado" name="estado" class="forms-input" >>
                    <option value="">Selecione...</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select> -->
                    <div class="mb-3">
                        <label for="site" class="form-label">Site</label>
                        <input type="text" class="form-control" id="site" name = "site" placeholder="Digite seu site"
                            value="<?php echo isset($dadosTalento['site']) ? $dadosTalento['site'] : ""; ?>">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn form-control mt-3 btn-light">Atualizar Dados</button>
                    </div>
                </div>
        </form>
    </div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("nome").value;
            var telefone = document.getElementById("telefone").value;
            var CNPJ = document.getElementById("CNPJ").value;
            var cep = document.getElementById("CEP").value;

            // Validar campos obrigatórios
            if (nome === "" || telefone === "" || CNPJ === "" || cep === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{4,5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Insira um número de telefone válido.");
                return false;
            }

            // Validar formato do CNPJ
            var cnpjRegex = /^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/;
            if (!cnpjRegex.test(cnpj)) {
                alert("Insira um CNPJ válido.");
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

        function formatarCNPJ(input) {
            var cnpj = input.value.replace(/\D/g, "");
            if (cnpj.length !== 14) {
                input.setCustomValidity("CNPJ inválido.");
            } else {
                input.setCustomValidity("");
            }
            var cnpjFormatado = `${cnpj.substring(0, 2)}.${cnpj.substring(2, 5)}.${cnpj.substring(5, 8)}/${cnpj.substring(8, 12)}-${cnpj.substring(12)}`;
            input.value = cnpjFormatado;
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

        function mascara_CNPJ() {
            var CNPJ = document.getElementById("CNPJ");
            formatarCNPJ(CNPJ);
        }

        function mascara_cep() {
            var cep = document.getElementById("CEP");
            formatarCEP(cep);
        }
    </script>

</body>

</html>