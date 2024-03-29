<?php
ini_set('default_charset', 'UTF-8');
require_once(__DIR__ . '/../src/PHPMailer.php'); // Caminho correto para o PHPMailer.php
require_once(__DIR__ . '/../src/SMTP.php'); // Se você também estiver usando SMTP
require_once(__DIR__ . '/../src/Exception.php'); // Se você também estiver usando exceções
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $descricao = $_POST["descricao"];
    
    // Configuração do PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Altere para o seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'hiregeniuses@gmail.com';
        $mail->Password = 'ccxh iuhw awiv rsqk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // A porta do servidor SMTP
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('hiregeniuses@gmail.com', $nome);
        $mail->addAddress('hiregeniuses@gmail.com', 'Administrador'); // E-mail do administrador
        $mail->isHTML(true);
        
        $mail->Subject = 'Relatório de Bug - ';
        $mail->Body = "<p><strong>Nome:</strong> $nome</p>
                       <p><strong>E-mail:</strong> $email</p>
                       <p><strong>Telefone:</strong> $telefone</p>
                       <p><strong>CPF:</strong> $cpf</p>
                       <p><strong>Descrição:</strong> $descricao</p>";       
        $mail->send();
        echo 'E-mail enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }
}   echo 'E-mail enviado com sucesso!';
header("Location: RelatorioDeBug.html"); 
?>
