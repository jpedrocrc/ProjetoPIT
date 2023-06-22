<?php
class CadastroTalento
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    public function gerarIdAleatorio($tamanho = 8) {
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
        //Ler os dados do Formulário
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            $telefone = $_POST["telefone"];
            $cpf = $_POST["cpf"];
            $cep = $_POST["cep"];
            $id = $this->gerarIdAleatorio();
            $genero = $_POST["genero"];
            //Validar email
            $verificarEmail = "SELECT * FROM taletno WHERE email = '$email'";
            $resultado = $this->conexao->executarConsulta($verificarEmail);

            if ($resultado && $resultado->num_rows > 0) {
                echo "Email inválido";
                return;
            }

            //Realizar a criptogração da senha
            $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            //realizar insert no banco
            $sql = "INSERT INTO TALENTO (ID,NOME, EMAIL, SENHA, TELEFONE, CPF, CEP,GENERO)
                        VALUES ('$id','$nome $sobrenome', '$email', '$senhaCriptografada', '$telefone', '$cpf', '$cep','$genero')";

            if ($this->conexao->executarConsulta($sql) === TRUE) {
                header("Location: PaginaLogin.php");
                exit();
            } else {
                echo "Erro ao inserir os dados no banco de dados: " . $this->conexao->obterErro();
            }
        }
    }
}

?>