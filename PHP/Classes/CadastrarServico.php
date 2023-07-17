<?php
class CadastrarServico
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
        // Verifica se o usuário já possui um serviço cadastrado
        $idUsuario = $this->obterIdUsuario();
        $sql = "SELECT * FROM SERVICO WHERE ID_FK = '$idUsuario'";
        $result = $this->conexao->executarConsulta($sql);

        if ($result->num_rows > 0) {
            echo "Usuário já possui um serviço cadastrado.";
            header("Location: AtualizarServiços.php");
            exit;
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descricao = $_POST['descricao'];
            $servico = $_POST['servico'];
            $nomeEmpresa = $_POST['nomeEmpresa'];
            $horario = $_POST['horario'];
            $horario = date("Y-m-d H:i:s", strtotime("2023-01-01 $horario"));
            // $habilidades = isset($_POST['habilidades']) ? $_POST['habilidades'] : array();
            // $habilidades = is_array($habilidades) ? implode(", ", $habilidades) : "";
            $valor = $_POST['valor'];
            $contato = $_POST['contato'];

            // Prepara a consulta SQL
            $sql = "INSERT INTO SERVICO (ID_FK, DESCRICAO, SERVICO, NOME_EMPRESA, HORARIO, VALOR, CONTATO) VALUES ('$idUsuario', '$descricao', '$servico', '$nomeEmpresa', '$horario','$valor', '$contato')";

            // Executa a consulta SQL
            if ($this->conexao->executarConsulta($sql) === TRUE) {
                header("Location: ListaServiços.php");
                exit();
            } else {
                echo "Erro ao inserir os dados no banco de dados: " . $this->conexao->obterErro();
            }
        }
    }
}
?>
