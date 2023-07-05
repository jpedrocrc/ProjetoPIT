<?php
class CadastroEmpresa
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    public function gerarIdAleatorio($tamanho = 8)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id = '';
        $length = strlen($caracteres);

        for ($i = 0; $i < $tamanho; $i++) {
            $id .= $caracteres[rand(0, $length - 1)];
        }

        return $id;
    }

    public function cadastrar()
    {
        //Pegar os dados do Formulário
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST['nome'];
            $endereco = $_POST['endereco'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $cep = $_POST['cep'];
            $cnpj = $_POST['cnpj'];
            $telefone = $_POST['telefone'];
            $site = $_POST['site'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $estado = $_POST["estado"];
            $id = $this->gerarIdAleatorio();

            //Valida o email para ver se já não existe no banco de dados
            $verificarEmail = "SELECT * FROM CONTRATANTE WHERE email = '$email'";
            $resultado = $this->conexao->executarConsulta($verificarEmail);

            if ($resultado && $resultado->num_rows > 0) {
                echo "Email inválido";
                return;
            }

            //Realizar a criptogração da senha
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            //Realizar insert no banco de dados
            $sqlInserir = "INSERT INTO CONTRATANTE (id,nome, email, cnpj, telefone, cep, endereco, bairro, cidade, estado, site, senha)
                VALUES ('$id','$nome', '$email', '$cnpj', '$telefone', '$cep', '$endereco', '$bairro', '$cidade', '$estado', '$site', '$senhaCriptografada')";

            if ($this->conexao->executarConsulta($sqlInserir) === TRUE) {
                header("Location: PaginaLogin.php");
                exit();
            } else {
                echo "Erro ao inserir os dados no banco de dados: " . $this->conexao->obterErro();
            }
        }
    }

}
?>