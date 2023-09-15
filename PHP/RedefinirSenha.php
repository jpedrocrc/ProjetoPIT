<?php
include_once './Classes/config.php';
require_once './Classes/ConexaoBD.php';

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

$mensagem = '';
$tokenProcurado = ''; // Inicialize a variável $tokenProcurado

// Obtenha o token da URL
if (isset($_GET['token'])) {
    $tokenProcurado = $_GET['token'];

    // Consulta SQL para encontrar o ID do usuário com base no token
    $sql = "SELECT usuario_id FROM tokens WHERE token = '$tokenProcurado'";
    $resultado = $conexaoBanco->executarConsulta($sql);

    if ($resultado && $conexaoBanco->obterNumLinhas($resultado) > 0) {
        $linha = $conexaoBanco->obterProximaLinha($resultado);
        $idUsuario = $linha['usuario_id'];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $novaSenha = $_POST['nova_senha'];

            if (strlen($novaSenha) < 8) {
                $mensagem = "A senha deve conter pelo menos 8 caracteres.";
            } else {
                // Crie um hash da nova senha
                $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

                // Atualize a senha no banco de dados usando o ID do usuário
                $sql = "UPDATE talento SET senha = '$senhaCriptografada' WHERE id = '$idUsuario'";

                if ($conexaoBanco->executarConsulta($sql)) {
                    $mensagem = "Senha atualizada com sucesso.";
                    header("Location: PaginaLogin.php");
                } else {
                    $mensagem = "Erro ao atualizar a senha.";
                }
            }
        }
    } else {
        $mensagem = "Token inválido.";
    }
} else {
    $mensagem = "Token não fornecido na URL.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
      .password-toggle {
            position: absolute;
            right: 150px;
            top: 33%; 
            transform: translateY(-50%);
            cursor: pointer;
        }
        #erro-senha {
            color: red;
        }

        .valido {
            color: green;
        }
    </style>
</head>
<body class="bg-image" style="background-image: url('../PHP/mainimg.png'); height: 100vh">
    <div class="card text-white bg-dark position-absolute top-50 start-50 translate-middle" style="max-width: 400px">
        <div class="card-body">
            <h1>Redefinir Senha</h1>
            <p>Informe a nova senha para redefinir sua senha.</p>

            <?php echo $mensagem; ?>

            <form action="" method="post">
            <label for="nova_senha" class="form-label">Senha</label> 
                <input type="password" id="nova_senha" name="nova_senha" required oninput="mostrarRequisitos()">
                <span class="password-toggle" onclick="alternarVisualizacao()">👁️</span>
                <div id="requisitos-senha"></div>
                <div class="mb-3"></div>
                <button type="submit" class="btn form-control btn-light">Redefinir Senha</button>
            </form>
        </div>
    </div>
    <script>
        function alternarVisualizacao() {
            const senhaInput = document.getElementById("nova_senha");
            if (senhaInput.type === "password") {
                senhaInput.type = "text";
            } else {
                senhaInput.type = "password";
            }
        }
        function mostrarRequisitos() {
            var senha = document.getElementById('nova_senha').value;
            var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            var mensagem = "A senha deve conter:<br>";
            if (!senha.match(/[a-z]/g)) mensagem += "- Pelo menos uma letra minúscula;<br>";
            else mensagem += "- <span class='valido'>Pelo menos uma letra minúscula;</span><br>";

            if (!senha.match(/[A-Z]/g)) mensagem += "- Pelo menos uma letra maiúscula;<br>";
            else mensagem += "- <span class='valido'>Pelo menos uma letra maiúscula;</span><br>";

            if (!senha.match(/\d/g)) mensagem += "- Pelo menos um número;<br>";
            else mensagem += "- <span class='valido'>Pelo menos um número;</span><br>";

            if (!senha.match(/[@$!%*?&]/g)) mensagem += "- Pelo menos um caracter especial (@, $, !, %, *, ?, &);<br>";
            else mensagem += "- <span class='valido'>Pelo menos um caracter especial (@, $, !, %, *, ?, &);</span><br>";

            if (senha.length >= 8) mensagem += "- <span class='valido'>No mínimo 8 caracteres;</span><br>";
            else mensagem += "- No mínimo 8 caracteres;<br>";

            document.getElementById('requisitos-senha').innerHTML = mensagem;
        }
        mostrarRequisitos();
    </script>
</body>
</html>