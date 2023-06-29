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
            header("Location: PaginaLogin.php");
            exit;
        }
    }

    public function obterIdUsuario()
    {
        return $_SESSION['idUsuario'];
    }
    public function cadastrar()
    {
        $idUsuario = $this->obterIdUsuario();
        $sql = "SELECT * FROM FREELANCERS WHERE ID_FK = '$idUsuario'";
        $result = $this->conexao->executarConsulta($sql);

        if ($result && $result->num_rows > 0) {
            echo "Usuário já possui um serviço cadastrado.";
            header("Location: AtualizarServiços.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'];
            $servico = $_POST['servico'];

            $sql = "INSERT INTO FREELANCERS (ID_FK, DESCRICAO, SERVICO) VALUES ('$idUsuario', '$descricao', '$servico')";

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