<?php
require_once './Classes/ConexaoBD.php';
require_once './Classes/CadastrarEmpresa.php';
include_once './Classes/config.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

$cadastroEmpresa = new CadastroEmpresa($conexaoBanco);
$cadastroEmpresa->cadastrar();

$conexaoBanco->fecharConexao();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/EmpresaeTalento.css">
    <link rel="stylesheet" type="text/css" href="reset.css">
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

        body {
            color: white;
        }

        .main-input {
            background-color: transparent;
            border: solid 0.1px white;
            padding: 10px;
        }
    </style>
</head>

<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
    <header>
        <img src="logo.png" alt="Logo" onclick="window.location.href='paginaprincipal.php'">
    </header>
    <div class="body-content">
        <div class="card-container">
            <form method="POST" onsubmit="return validarFormulario()">
                <div class="form-header">
                    <div class="tittle mt-3 mb-3">
                        <h3>Inscreva-se como Empresa</h3>
                    </div>
                    <div class="text-center mb-2">
                        <button class="btn btn-light border-info rounded w-75 p-0">
                            Entrar com Google
                        </button>
                    </div>
                    <div class="text-center mb-2">
                        <button class="btn btn-light border-secondary rounded w-75 p-0">
                            Entrar com Apple
                        </button>
                    </div>
                    <div class="container text-center mb-2 mt-3">
                        <div class="row px-5">
                            <div class="col border-bottom">
                            </div>
                            <div class="col border-bottom">
                            </div>
                            <div class="col border-bottom">
                            </div>
                        </div>
                    </div>

                    <div class="form-main">
                        <div class="label-area w-100">
                            <label for="user" class="form-label">Nome</label>
                            <input type="text" class="main-input" id="user" name="nome">
                        </div>
                        <div class="container" style="margin-left: 50px">
                            <div class="row">
                                <div class="col">
                                    <div class="label-area px-0">
                                        <label for="cnpj" class="form-label">CNPJ</label>
                                        <input type="text" class="main-input" id="cnpj" oninput="mascara_cnpj()"
                                            name="cnpj" maxlength="18">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-area px-3">
                                        <label for="cep" class="form-label">CEP</label>
                                        <input type="text" class="main-input w-100" style="max-width: 160px" id="cep"
                                            oninput="mascara_cep()" name="cep" maxlength="9">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="label-area w-100">
                            <label for="endereco" class="form-label">Endereco</label>
                            <input type="text" class="main-input" id="endereco" name="endereco">
                        </div>
                        <div class="container" style="margin-left: 50px">
                            <div class="row">
                                <div class="col">
                                    <div class="label-area px-0">
                                        <label for="bairro" class="form-label">Bairro</label>
                                        <input type="text" class="main-input" id="bairro" name="bairro">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="label-area px-3">
                                        <label for="numero" class="form-label">Numero</label>
                                        <input type="text" class="main-input w-100" style="max-width: 160px" id="numero"
                                            name="numero">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="label-area w-100">
                            <label for="email-adress" class="form-label">Cidade</label>
                            <input type="text" class="main-input" id="cidade" name="cidade">
                        </div>
                        <div class="label-area w-100">
                            <label for="email-adress" class="form-label">Email</label>
                            <input type="email" class="main-input" id="email-adress" name="email">
                        </div>
                        <div class="label-area w-100">
                            <label for="site-adress" class="form-label">Site</label>
                            <input type="text" class="main-input" id="site-adress" name="site">
                        </div>
                        <div class="label-area">
                            <label for="tel-number" class="form-label">Telefone</label>
                            <input type="tel" class="main-input" id="telefone" oninput="mascara_telefone()"
                                name="telefone" maxlength="15">
                        </div>
                        <div class="country-area">
                            <label for="estado" class="form-label">Selecione o estado:</label>
                            <select id="estado" name="estado" class="main-input" style="color: black">
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
                            </select>
                        </div>
                        <div class="label-area">
                            <label for="passw" class="form-label">Senha</label>
                            <input type="password" class="main-input" id="passw" name="senha">
                        </div>
                    </div>
                    <div class="form-footer">
                        <!-- <div class="info1-area">
                            <label for="att-check" class="checkbox-label"><input type="checkbox" id="att-check"
                                    class="checkbox-input me-2">Envie-me e-mails com dicas sobre como
                                encontrar
                                talentos que atendam às
                                minhas necessidades.</label>
                        </div> -->
                        <div class="info2-area">
                            <label for="att-check2" class="checkbox-label2 align-text-top"><input type="checkbox"
                                    id="att-check2" class="checkbox-input2 me-2"> Sim, eu entendo e concordo com os
                                Termos de
                                Serviço do HireGeniuses,
                                incluindo o Contrato do Usuário e a Política de Privacidade.</label>
                        </div>
                    </div>
                    <div class="form-footer2">
                        <div class="p-3 text-lg-center">
                            <button type="submit" class="btn btn-light fs-5  px-5" href="">Cadastrar</button>
                        </div>
                        <div class="text-footer">
                            <h2>Já tem uma conta?</h2>
                            <a id="link-conect">
                                <h2>Faça Login</h2>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("nome").value;
            var endereco = document.getElementById("endereco").value;
            var bairro = document.getElementById("bairro").value;
            var numero = document.getElementById("numero").value;
            var cidade = document.getElementById("cidade").value;
            var cep = document.getElementById("cep").value;
            var cnpj = document.getElementById("cnpj").value;
            var telefone = document.getElementById("telefone").value;
            var site = document.getElementById("site").value;
            var email = document.getElementById("email").value;
            var senha = document.getElementById("senha").value;
            var estado =document.getElementById("estado").value

            // Validar campos obrigatórios
            if (nome === "" || endereco === "" || bairro === "" || numero === "" || cidade === "" || site === "" || email === "" || telefone === "" || cnpj === "" || cep === "" || senha === "" || estado === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar telefone
            var telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Insire um número de telefone válido.");
                return false;
            }

            // Validar CNPJ
            var cnpjRegex = /^\d{2}.\d{3}.\d{3}\/\d{4}-\d{2}$/;
            if (!cnpjRegex.test(cnpj)) {
                alert("Insira um CNPJ válido.");
                return false;
            }

            // Validar CEP
            var cepRegex = /^\d{5}-\d{3}$/;
            if (!cepRegex.test(cep)) {
                alert("Insira um CEP válido.");
                return false;
            }

            // Validar email
            var emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }

            return true;
        }
        function formatarTelefone(input) {
            var numero = input.value.replace(/\D/g, "");
            if (numero.length !== 11) {
                input.setCustomValidity("Número de telefone inválido.");
            } else {
                input.setCustomValidity("");
            }
            var telefoneFormatado = `(${numero.substring(0, 2)}) ${numero.substring(2, 7)}-${numero.substring(7)}`;
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
            var cep = input.value.replace(/\D/g, "");
            if (cep.length !== 8) {
                input.setCustomValidity("CEP inválido.");
            } else {
                input.setCustomValidity("");
            }
            var cepFormatado = `${cep.substring(0, 5)}-${cep.substring(5)}`;
            input.value = cepFormatado;
        }
        function mascara_telefone() {
            var telefone = document.getElementById("telefone");
            formatarTelefone(telefone);
        }
        function mascara_cnpj() {
            var cnpj = document.getElementById("cnpj");
            formatarCNPJ(cnpj);
        }
        function mascara_cep() {
            var cep = document.getElementById("cep");
            formatarCEP(cep);
        }

    </script>
</body>

</html>
