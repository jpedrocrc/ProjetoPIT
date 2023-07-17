<?php
class UpdatePerfilContratante
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
    public function verificaPermissoes()
    {
        if (!isset($_SESSION['permissao']) || $_SESSION['permissao'] !== 'contratante') {
            header("Location:PaginaUpdateTalento.php");
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
        $sql = "SELECT * FROM contratante WHERE ID = '$idUsuario'";

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
            $CNPJ = $_POST["CNPJ"];
            $cep = $_POST["cep"];
            $ENDERECO = $_POST["ENDERECO"];
            $bairro = $_POST["bairro"];
            $cidade = $_POST["cidade"];
            // $estado = $_POST["estado"];
            $site = $_POST["site"];

            $idUsuario = $this->obterIdUsuario();

            $sql = "UPDATE contratante SET nome = '$nome',telefone = '$telefone',CNPJ = '$CNPJ',cep ='$cep', bairro = '$bairro', cidade = '$cidade', site = '$site', endereco = '$ENDERECO' WHERE id = '$idUsuario'";
            if ($this->conexao->executarConsulta($sql)) {
                echo "Dados de perfil atualizados com sucesso!";
            } else {
                echo "Erro ao atualizar os dados de perfil: " . $this->conexao->obterErro();
            }
        }
    }
}
