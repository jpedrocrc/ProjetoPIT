<?php
class UpdatePerfilTalento
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
    public function verificaPermissoes(){
        if (!isset($_SESSION['permissao']) || $_SESSION['permissao'] !== 'talento'){
            header("Location:PaginaUpdateContratante.php");
            exit;
        }
    }

    public function obterIdUsuario()
    {
        return $_SESSION['idUsuario'];
    }

    public function obterDados()
    {
        $idUsuario = $this->obterIdUsuario();
        $sql = "SELECT * FROM TALENTO WHERE ID = '$idUsuario'";

        $result = $this->conexao->executarConsulta($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    

    public function atualizarDadosPerfil()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $telefone = $_POST["telefone"];
            $cpf = $_POST["cpf"];
            $cep = $_POST["cep"];

            $idUsuario = $this->obterIdUsuario();

            $sql = "UPDATE talento SET nome = '$nome',telefone = '$telefone',cpf = '$cpf',cep ='$cep' WHERE id = '$idUsuario'";

            if ($this->conexao->executarConsulta($sql)) {
                echo "Dados de perfil atualizados com sucesso!";
            } else {
                echo "Erro ao atualizar os dados de perfil.";
            }
        }
    }
}
?>