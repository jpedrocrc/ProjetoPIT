<?php
class AtualizarHabilidades
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

    public function obterServico()
    {
        $idUsuario = $this->obterIdUsuario();
        $sql = "SELECT * FROM FREELANCERS WHERE ID_FK = '$idUsuario'";
        $result = $this->conexao->executarConsulta($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            header("Location: CadastroHabilidade.php");
            return false;
        }
    }

    public function deletarServico()
    {
        $idUsuario = $this->obterIdUsuario();
        $sql = "DELETE FROM FREELANCERS WHERE ID_FK = '$idUsuario'";

        if ($this->conexao->executarConsulta($sql) === TRUE) {
            echo "Serviço deletado com sucesso.";
        } else {
            echo "Erro ao deletar serviço: " . $this->conexao->obterErro();
        }
    }

    public function atualizarServico($descricao, $servico)
    {
        $idUsuario = $this->obterIdUsuario();
        $sql = "UPDATE FREELANCERS SET DESCRICAO = '$descricao', SERVICO = '$servico' WHERE ID_FK = '$idUsuario'";

        if ($this->conexao->executarConsulta($sql) === TRUE) {
            echo "Serviço atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar serviço: " . $this->conexao->obterErro();
        }
    }

    public function processarAcoesFormulario()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['atualizar'])) {
                $descricao = $_POST['descricao'];
                $servicoInput = $_POST['servico'];
                $this->atualizarServico($descricao, $servicoInput);
            } elseif (isset($_POST['deletar'])) {
                $this->deletarServico();
            }
        }
    }


    public function exibirInformacoesServico($dadosServico)
    {
        if ($dadosServico) {
            echo "Descrição: " . $dadosServico['DESCRICAO'] . "<br>";
            echo "Serviço: " . $dadosServico['SERVICO'] . "<br>";
        } else {
            echo "Você não possui um serviço cadastrado.";
            header("Location: CadastrarHabilidade.php");
        }
    }
}
?>