<?php
class CadastrarHabilidade
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    public function verificarUsuarioLogado()
    {
        if (!isset($_SESSION['idUsuario'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function obterIdUsuario()
    {
        return $_SESSION['idUsuario'];
    }
    public function cadastrar()
    {
        // Verifica se o usuário já possui um serviço cadastrado
        $idUsuario = $this->obterIdUsuario();
        $sql = "SELECT * FROM SERVICO WHERE ID_FK = '$idUsuario'";
        $result = $this->conexao->executarConsulta($sql);

        if ($result->num_rows > 0) {
            echo "Usuário já possui um serviço cadastrado.";
            header("Location:AtualizarServiços.php");
            exit();
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'];
            $servico = $_POST['servico'];

            // Prepara a consulta SQL
            $sql = "INSERT INTO FREELANCERS (ID_FK, DESCRICAO, SERVICO) VALUES ('$idUsuario', '$descricao', '$servico')";

            // Executa a consulta SQL
            $resultado = $this->conexao->executarConsulta($sql);

            if ($resultado === TRUE) {
                header("Location: ListaFreelancers.php");
                exit();
            } else {
                echo "Erro ao inserir os dados no banco de dados: " . $this->conexao->obterErro();
            }
        }
    }

}

?>