<?php
require_once './Classes/ConexaoBD.php';
require_once './Classes/CadastrarTalento.php';
include_once './Classes/config.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

$cadastroTalento = new CadastroTalento($conexaoBanco);
$cadastroTalento->cadastrar();

$conexaoBanco->fecharConexao();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/cadastroTalento.css">
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
    <div class="body-content">
        <div class="card-container">
            <form method="POST" onsubmit="return validarFormulario()">
                <div class="form-header">
                    <div class="tittle">
                        <h3>Inscreva-se como talento</h3>
                    </div>
                    <div class="form-main">
                        <div class="area-user1">
                            <label for="user">Primeiro nome</label>
                            <input type="text" class="main-input" id="user" name="nome">
                        </div>
                        <div class="area-user2">
                            <label for="user2">Sobrenome</label>
                            <input type="text" class="main-input" id="user2" name="sobrenome">
                        </div>
                        <div class="email-area">
                            <label for="email-adress">Endereço de email</label>
                            <input type="email" class="main-input" id="email-adress" name="email">
                        </div>
                        <div class="telefone-area">
                            <label for="tel-number">Telefone</label>
                            <input type="tel" class="main-input" id="tel-number" oninput="mascara_telefone()"
                                name="telefone">
                        </div>
                        <div class="cpf-area">
                            <label for="cpf-number">CPF</label>
                            <input type="text" class="main-input" id="cpf-number" oninput="mascara_cpf()" name="cpf">
                        </div>
                        <div class="cep-area">
                            <label for="cep-number">CEP</label>
                            <input type="text" class="main-input" id="cep-number" oninput="mascara_cep()" name="cep">
                        </div>
                        <div class="password-area">
                            <label for="passw">Senha</label>
                            <input type="password" class="main-input" id="passw" name="senha">
                        </div>
                    </div>

                    <div class="country-area">
                        <h1>Selecione um país:</h1>
                        <select id="paises" name="pais">
                            <option value="NULL">Selecione ...</option>
                            <option value="DE">Alemanha</option>
                            <option value="AR">Argentina</option>
                            <option value="BE">Bélgica</option>
                            <option value="BR">Brasil</option>
                            <option value="CA">Canadá</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CO">Colômbia</option>
                            <option value="KR">Coreia do Sul</option>
                            <option value="EC">Equador</option>
                            <option value="ES">Estados Unidos</option>
                            <option value="FR">França</option>
                            <option value="GB">Inglaterra</option>
                            <option value="JP">Japão</option>
                            <option value="MX">México</option>
                            <option value="PE">Peru</option>
                            <option value="VE">Venezuela</option>
                            <option value="">Outro país</option>
                        </select>
                    </div>
                </div>
                <div class="form-footer">
                    <div class="info1-area">
                        <input type="checkbox" id="att-check" class="checkbox-input">
                        <label for="att-check" class="checkbox-label">Envie-me e-mails com dicas sobre como encontrar
                            talentos que atendam às
                            minhas necessidades.</label>
                    </div>
                    <div class="info2-area">
                        <input type="checkbox" id="att-check2" class="checkbox-input2">
                        <label for="att-check2" class="checkbox-label2"> Sim, eu entendo e concordo com os Termos de
                            Serviço do HireGeniuses,
                            incluindo o Contrato do Usuário e a Política de Privacidade.</label>
                    </div>
                </div>
                <div class="form-footer2">
                    <div class="button-footer">
                        <button type="submit" id="enter-button" href="">Criar conta</button>
                    </div>
                    <div class="text-footer">
                        <h2>já tem uma conta?</h2>
                        <a id="link-conect">
                            <h2>Conecte-se</h2>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function validarFormulario() {
            var nome = document.getElementById("user").value;
            var sobrenome = document.getElementById("user2").value;
            var email = document.getElementById("email-adress").value;
            var telefone = document.getElementById("tel-number").value;
            var cpf = document.getElementById("cpf-number").value;
            var cep = document.getElementById("cep-number").value;
            var senha = document.getElementById("passw").value;
            var checkbox = document.getElementById("att-check2").value;

            // Validar campos obrigatórios
            if (nome === "" || sobrenome === "" || email === "" || telefone === "" || cpf === "" || cep === "" || senha === "" || checkbox === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Insire um número de telefone válido.");
                return false;
            }

            // Validar formato do CPF
            var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            if (!cpfRegex.test(cpf)) {
                alert("Insire um CPF válido.");
                return false;
            }

            // Validar formato do CEP
            var cepRegex = /^\d{5}-\d{3}$/;
            if (!cepRegex.test(cep)) {
                alert("Insira um CEP válido.");
                return false;
            }

            // Validar formato do email
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }

            return true;
        }
        function formatarTelefone(input) {
            // Remove qualquer caractere não numérico do número de telefone
            var numero = input.value.replace(/\D/g, "");

            // Verifica se o número de telefone tem o tamanho correto
            if (numero.length !== 11) {
                input.setCustomValidity("Número de telefone inválido.");
            } else {
                input.setCustomValidity("");
            }

            // Aplica a máscara no número formatado
            var telefoneFormatado = `(${numero.substring(0, 2)}) ${numero.substring(2, 7)}-${numero.substring(7)}`;

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
            var cpfFormatado = `${cpf.substring(0, 3)}.${cpf.substring(3, 6)}.${cpf.substring(6, 9)}-${cpf.substring(9)}`;

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
            var cepFormatado = `${cep.substring(0, 5)}-${cep.substring(5)}`;

            // Atualiza o valor do campo de input com o CEP formatado
            input.value = cepFormatado;
        }
        function mascara_telefone() {
            var telefone = document.getElementById("tel-number");
            formatarTelefone(telefone);
        }
        function mascara_cpf() {
            var cpf = document.getElementById("cpf-number");
            formatarCPF(cpf);
        }
        function mascara_cep() {
            var cep = document.getElementById("cep-number");
            formatarCEP(cep);
        }
    </script>
</body>

</html>