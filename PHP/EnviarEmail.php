<?php
require_once(__DIR__ . '/../src/PHPMailer.php'); // Caminho correto para o PHPMailer.php
require_once(__DIR__ . '/../src/SMTP.php'); // Se você também estiver usando SMTP
require_once(__DIR__ . '/../src/Exception.php'); // Se você também estiver usando exceções
include_once './Classes/config.php';
require_once './Classes/ConexaoBD.php';

// Configuração do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// ... suas configurações do PHPMailer aqui, por exemplo:
$mail = new PHPMailer(true);
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'hiregeniuses@gmail.com';
$mail->Password = 'ccxh iuhw awiv rsqk';
$mail->Port = 587;

// ...

$conexaoBanco = new ConexaoBD($nomeServidor, $nomeUsuario, $senha, $nomeBanco);
$conexaoBanco->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailProcurado = $_POST['email']; // Obtém o e-mail fornecido pelo usuário

    // Consulta SQL para encontrar o ID do usuário com base no e-mail
    $sql = "SELECT id FROM talento WHERE email = '$emailProcurado'";
    $resultado = $conexaoBanco->executarConsulta($sql);
}   

if ($resultado && $conexaoBanco->obterNumLinhas($resultado) > 0) {
    $linha = $conexaoBanco->obterProximaLinha($resultado);
    $idUsuario = $linha['id'];

    // Gere um token único
    $token = bin2hex(random_bytes(32)); // Gera um token de 64 caracteres (32 bytes em hexadecimal)

    // Insira o token e a data de expiração no banco de dados
    $dataExpiracao = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token válido por 1 hora (ajuste conforme necessário)
    $sql = "INSERT INTO tokens (usuario_id, token, data_expiracao) VALUES ('$idUsuario', '$token', '$dataExpiracao')";
    $conexaoBanco->executarConsulta($sql);


try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'hiregeniuses@gmail.com';
    $mail->Password = 'ccxh iuhw awiv rsqk';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom('hiregeniuses@gmail.com');
    $mail->addAddress($emailProcurado);
    $linkRedefinicaoSenha = 'http://localhost/projetopit/PHP/RedefinirSenha.php?token=' . $token;

    $mail->Subject = 'Recuperação de Senha';
        $mail->Body = 'Clique no link a seguir para redefinir sua senha: <a href="' . $linkRedefinicaoSenha . '">Redefinir Senha</a>';
        $mail->AltBody = 'Para redefinir sua senha, copie e cole o seguinte link no seu navegador: ' . $linkRedefinicaoSenha;

        if ($mail->send()) {
            echo 'Um e-mail de recuperação de senha foi enviado para o endereço de e-mail fornecido.';
        } else {
            echo 'Não foi possível enviar o e-mail de recuperação de senha.';
        }
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
} else {
    echo 'Nenhum usuário encontrado com o endereço de e-mail fornecido.';
}
header("Location: paginaprincipal.html"); 
?>