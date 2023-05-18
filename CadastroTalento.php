<?php

class ConexaoBD
{
    private $nomeServidor;
    private $nomeUsuario;
    private $senha;
    private $nomeBanco;
    private $conexao;

    public function __construct($nomeServidor, $nomeUsuario, $senha, $nomeBanco)
    {
        $this->nomeServidor = $nomeServidor;
        $this->nomeUsuario = $nomeUsuario;
        $this->senha = $senha;
        $this->nomeBanco = $nomeBanco;
    }

    public function conectar()
    {
        $this->conexao = new mysqli($this->nomeServidor, $this->nomeUsuario, $this->senha, $this->nomeBanco);

        if ($this->conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    public function fecharConexao()
    {
        $this->conexao->close();
    }

    public function executarConsulta($sql)
    {
        return $this->conexao->query($sql);
    }

    public function obterErro()
    {
        return $this->conexao->error;
    }
}

class CadastroTalento
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function cadastrar()
    {
        $erros = array(); // Array para armazenar mensagens de erro

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $telefone = $_POST["telefone"];
            $cpf = $_POST["cpf"];
            $cep = $_POST["cep"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Por favor, insira um email válido.';
                exit;
            }

            $sql = "INSERT INTO TALENTO (NOME, EMAIL, SENHA, TELEFONE, CPF, CEP)
                        VALUES ('$nome', '$email', '$senha', '$telefone', '$cpf', '$cep')";

            if ($this->conexao->executarConsulta($sql) === TRUE) {
                header("Location: login.php");
                exit();
            } else {
                echo "Erro ao inserir os dados no banco de dados: " . $this->conexao->obterErro();
            }
        }
    }
}

$nomeServidor = "localhost";
$nomeUsuario = "root";
$senha = "jpedro05";
$nomeBanco = "HIREGENIUSES";

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
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com%22%3E/
<link rel=" preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300&display=swap" rel="stylesheet">
</head>
<header>
    <div class="header">
        <div class="img-logo">
            <img src="/Imagens/logo.png">
        </div>
    </div>
</header>


<body>
    <div class="body-content">
        <form method="POST" onsubmit="return validarFormulario()">
            <div class="form-header">
                <div class="tittle">
                    <h3>INScrevAa-se para contratar talentos</h3>
                </div>
                <div class="form-header-buttons">
                    <a href="#" id="red">Entrar com a apple</a>
                    <a href="#" id="blue">Entrar com o google</a>
                </div>
                <div class="card-right-center">
                    <div class="divisor1"></div>
                    <span id="divisor">ou</span>
                    <div class="divisor2"></div>
                </div>
            </div>
            <div class="form-main">
                <div class="user-area">
                    <div class="label-user">
                        <label for="user">Primeiro nome</label>
                        <label for="user2">Sobrenome</label>
                    </div>
                    <div class="input-user">
                        <input type="text" id="user" name="nome">
                        <input type="text" id="user2" name="sobrenome">
                    </div>
                </div>
                <div class="email-area">
                    <label for="email-adress">Endereço de email</label>
                    <input type="email" id="email-adress" name="email">
                </div>
                <div class="telefone-area">
                    <label for="tel-number">Telefone</label>
                    <input type="tel" id="tel-number" oninput="mascara_telefone()" name="telefone">
                </div>
                <div class="cpf-area">
                    <label for="cpf-number">CPF</label>
                    <input type="text" id="cpf-number" oninput="mascara_cpf()" name="cpf">
                </div>
                <div class="cep-area">
                    <label for="cep-number">CEP</label>
                    <input type="text" id="cep-number" oninput="mascara_cep()" name="cep">
                </div>
                <div class="password-area">
                    <label for="passw">Senha</label>
                    <input type="password" id="passw" name="senha">
                </div>
            </div>

            <div class="country-area">
                <h1>Selecione um país:</h1>
                <select id="paises" name="pais">
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
            <input type="checkbox" id="att-check">
            <label for="att-check">Envie-me e-mails com dicas sobre como encontrar talentos que atendam às
                minhas necessidades.</label>
        </div>
        <div class="info2-area">
            <input type="checkbox" id="att-check2">
            <label for="att-check2"> Sim, eu entendo e concordo com os Termos de Serviço do HireGenius ,
                incluindo o Contrato do Usuário e a Política de Privacidade .</label>
        </div>
    </div>
    <div class="form-footer2">
        <div class="button-footer">
            <button type="submit" id="enter-button">Criar conta</button>
        </div>
        <div class="text-footer">
            <h2>já tem uma conta?</h2>
            <a id="link-conect">
                <h2>Conecte-se</h2>
            </a><span>.</span>
        </div>
    </div>
    </form>
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

            // Validar campos obrigatórios
            if (nome === "" || sobrenome === "" || email === "" || telefone === "" || cpf === "" || cep === "" || senha === "") {
                alert("Todos os campos devem ser preenchidos.");
                return false;
            }

            // Validar formato do telefone
            var telefoneRegex = /^\(\d{2}\) \d{5}-\d{4}$/;
            if (!telefoneRegex.test(telefone)) {
                alert("Por favor, insira um número de telefone válido. Exemplo: (99) 99999-9999");
                return false;
            }

            // Validar formato do CPF
            var cpfRegex = /^\d{3}\.\d{3}\.\d{3}-\d{2}$/;
            if (!cpfRegex.test(cpf)) {
                alert("Por favor, insira um CPF válido. Exemplo: 999.999.999-99");
                return false;
            }

            // Validar formato do CEP
            var cepRegex = /^\d{5}-\d{3}$/;
            if (!cepRegex.test(cep)) {
                alert("Por favor, insira um CEP válido. Exemplo: 99999-999");
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