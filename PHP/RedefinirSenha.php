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
</head>
<body>
    <h1>Redefinir Senha</h1>
    <p>Informe a nova senha para redefinir sua senha.</p>

    <?php echo $mensagem; ?>

    <form action="" method="post">
        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>
        <br>
        <button type="submit">Redefinir Senha</button>
    </form>
</body>
</html>
