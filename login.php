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
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $sql = "SELECT * FROM talento WHERE email = '$email' AND senha = '$senha'";

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        echo "Login bem sucedido";
    } else {
        echo "Login ou senha incorreto";
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
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@200&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="img-logo">
                <img src="  ">
            </div>
            <div class="tittle-login">
                <h2>Faça login no Hire Geniuses</h2>
            </div>
        </div>


        <div class="card">
            <div class="card-content">
                <form method="POST">
                    <div class="error-label">
                        <label>Usuário ou senha incorreto.</label>
                    </div>
                    <div class="user-aerea">
                        <label for="user">Email</label>
                        <input type="text" id="user" name="email" required>
                    </div>
                    <div class="password-aerea">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="senha" required>
                    </div>
                    <span>
                        <h4><a id="password-forget">Esqueci minha senha</a></h4>
                    </span>
                    <button class="myButton">Entrar</button>
                </form>
            </div>
        </div>
        <div class="card-conten2">
            <div class="text-header">
                <h2>Novo no Hire Geniuses?</h2>
                <a>
                    <h2>Crie uma conta</h2>
                </a><span>.</span>
            </div>
        </div>
    </div>
    <script></script>
</body>

</html>