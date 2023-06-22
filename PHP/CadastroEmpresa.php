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
    <link rel="stylesheet" type="text/css" href="../css/cadastroempresa.css">
    <link rel="stylesheet" type="text/css" href="reset.css"> 
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
        <form method="POST" onsubmit="return validarFormulario()">
            <div class="form-header">
                <h1 id="tittle">Cadastro de Empresas</h1>
                
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="input-submit">

                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" class="input-submit">

                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" class="input-submit">

                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" class="input-submit">

                <label for="numero">Numero:</label>
                <input type="text" id="numero" name="numero" class="input-submit">

                <label for="cep">CEP:</label>
                <input type="text" id="cep" oninput="mascara_cep()" name="cep" maxlength="9" class="input-submit">

                <label for="cnpj">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" oninput="mascara_cnpj()" maxlength="18" class="input-submit">

                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" oninput="mascara_telefone()" name="telefone" maxlength="15" class="input-submit">

                <label for="site">Site:</label>
                <input type="text" id="site" name="site" class="input-submit">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="input-submit">

                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" class="input-submit">

                <label for="estado">Selecione o estado:</label>
                <select id="estado" name="estado">
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
                <input type="submit" value="Cadastrar" id="button" href="">
                <div class="footer">
                    <h2 id="text-footer">já tem uma conta?</h2>
                    <a id="link-conect">
                        <h2 id="text-footer2">Conecte-se</h2>
                    </a>
                    <span>.</span>
            </div>
            </div>
        </form>
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
