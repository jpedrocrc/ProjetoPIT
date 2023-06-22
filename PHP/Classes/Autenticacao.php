<?php
class Autenticacao
{
    private $conexao;
    private $idUsuario;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function realizarLogin($email, $senha)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Por favor, insira um email válido.';
            exit;
        }

        $sql = "SELECT ID, nome, email, senha, 'talento' AS tipo FROM talento WHERE email = '$email' 
    UNION
    SELECT ID, nome, email, senha, 'contratante' AS tipo FROM contratante WHERE email = '$email';";
        $resultado = $this->conexao->executarConsulta($sql);
        if ($this->conexao->obterNumLinhas($resultado) > 0) {
            $row = $this->conexao->obterProximaLinha($resultado);
            $senhaArmazenada = $row['senha'];

            if (password_verify($senha, $senhaArmazenada)) {
                $this->idUsuario = $row['ID'];
                $_SESSION['idUsuario'] = $this->idUsuario;
                $_SESSION['permissao'] = $row['tipo']; // Armazena o tipo de usuário na variável de sessão
            } else {
                echo "Login ou senha incorreto";
            }
        } else {
            echo "Login ou senha incorreto";
        }
    }

}
?>