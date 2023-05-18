<?php

$servername = "localhost";
$username = "root";
$password = "jpedro05";
$dbname = "HIREGENIUSES";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $cep = $_POST["cep"];

    echo "Nome: " . $nome . "<br>";
    echo "Sobrenome: " . $sobrenome . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Telefone: " . $telefone . "<br>";
    echo "CPF: " . $cpf . "<br>";
    echo "CEP: " . $cep . "<br>";
    echo "Senha: " . $senha . "<br>";
    
    $sql = "INSERT INTO TALENTO (NOME, EMAIL, SENHA, TELEFONE, CPF, CEP)
            VALUES ('$nome', '$email', '$senha', '$telefone', '$cpf', '$cep')";

    if ($conn->query($sql) === TRUE) {
        echo "Cadastro feito com sucesso!";
        header("Location: index(1).php");
        exit;
    } else {
        echo "Erro ao inserir os dados: " . $conn->error;
    }
}

$conn->close();
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
        <form method="POST">
            <div class="form-header">
                <div class="tittle">
                    <h3>Inscreva-se para contratar talentos</h3>
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
                        <input type="text" id="user" name="nome" required>
                        <input type="text" id="user2" name="sobrenome" required>
                    </div>
                </div>
                <div class="email-area">
                    <label for="email-adress">Endereço de email</label>
                    <input type="email" id="email-adress" name="email" required>
                </div>
                <div class="telefone-area">
                    <label for="tel-number">Telefone</label>
                    <input type="tel" id="tel-number" oninput="mascara_telefone()" name="telefone" required>
                </div>
                <div class="cpf-area">
                    <label for="cpf-number">CPF</label>
                    <input type="text" id="cpf-number" oninput="mascara_cpf()" name="cpf" required>
                </div>
                <div class="cep-area">
                    <label for="cep-number">CEP</label>
                    <input type="text" id="cep-number" oninput="mascara_cep()" name="cep" required>
                </div>
                <div class="password-area">
                    <label for="passw">Senha</label>
                    <input type="password" id="passw" name="senha" required>
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
        function mascara_telefone(){
    var tel = document.getElementById("tel-number").value
    tel=tel.slice(0,14)
    document.getElementById("tel-number").value=tel
    tel=document.getElementById("tel-number").value.slice(0,10)
    
    var tel2 = document.getElementById("tel-number").value
    if(tel2[0]!="(")
    {
        if(tel2[0]!= undefined){
            document.getElementById("tel-number").value="("+tel2[0];
        }
    }
    if(tel2[3]!=")"){
        if(tel2[3]!= undefined){
            document.getElementById("tel-number").value=tel2.slice(0,3)+")"+tel2[3]
        }
    }
    if (tel2[9]!="-")
    {
        if(tel2[9]!=undefined)
        {
            document.getElementById("tel-number").value=tel2.slice(0,9)+"-"+tel2[9]
        }
    }
}

function mascara_cep(){
    var cep = document.getElementById("cep-number").value
    if(cep[2]!=".")
    {
        if(cep[2]!=undefined)
        {
            document.getElementById("cep-number").value=cep.slice(0,2)+"."+cep[2];
        }
    }
    if(cep[6]!="-")
    {
        if(cep[6]!=undefined)
        {
            document.getElementById("cep-number").value=cep.slice(0,6)+"-"+cep[6];
        }
    }
}

function mascara_cpf(){
    var cpf = document.getElementById("cpf-number").value
    cpf=cpf.slice(0,13)
    if(cpf[3]!=".")
    {
        if(cpf[3]!=undefined)
        {
            document.getElementById("cpf-number").value=cpf.slice(0,3)+"."+cpf[3];
        }
    }
    if(cpf[7]!=".")
    {
        if(cpf[7]!=undefined)
        {
            document.getElementById("cpf-number").value=cpf.slice(0,7)+"."+cpf[7];
        }
    }
    if(cpf[11]!="-")
    {
        if(cpf[11]!=undefined)
        {
            document.getElementById("cpf-number").value=cpf.slice(0,11)+"-"+cpf[11];
        }
    }
}
    </script>
</body>

</html>