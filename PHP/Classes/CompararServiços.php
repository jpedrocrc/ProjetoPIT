<?php
class CompararServicos
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function GetServicos()
    {
        $sql = "SELECT SERVICO.ID_SERVICO, CONTRATANTE.NOME AS CONTRATANTE_NOME, CONTRATANTE.TELEFONE AS CONTRATANTE_TELEFONE, CONTRATANTE.EMAIL AS CONTRATANTE_EMAIL, SERVICO.DESCRICAO AS SERVICO_DESCRICAO, SERVICO.SERVICO AS SERVICO_NOME, CONTRATANTE.ENDERECO AS CONTRATANTE_ENDERECO, CONTRATANTE.CIDADE AS CONTRATANTE_CIDADE, CONTRATANTE.BAIRRO AS CONTRATANTE_BAIRRO
        FROM SERVICO
        INNER JOIN CONTRATANTE ON SERVICO.ID_FK = CONTRATANTE.ID";

        $resultado = $this->conexao->executarConsulta($sql);
        $servicos = array();

        if ($resultado !== null && $resultado instanceof mysqli_result && $this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $servico = array(
                    'ID_SERVICO' => $row['ID_SERVICO'],
                    'CONTRATANTE_NOME' => $row['CONTRATANTE_NOME'],
                    'CONTRATANTE_TELEFONE' => $row['CONTRATANTE_TELEFONE'],
                    'CONTRATANTE_EMAIL' => $row['CONTRATANTE_EMAIL'],
                    'SERVICO_DESCRICAO' => $row['SERVICO_DESCRICAO'],
                    'SERVICO_NOME' => $row['SERVICO_NOME'],
                    'CONTRATANTE_ENDERECO' => $row['CONTRATANTE_ENDERECO'],
                    'CONTRATANTE_CIDADE' => $row['CONTRATANTE_CIDADE'],
                    'CONTRATANTE_BAIRRO' => $row['CONTRATANTE_BAIRRO']
                );
                $servicos[] = $servico;
            }
        }

        return $servicos;
    }

    public function GetServicoPorId($servicoId)
    {
        // Verifique se $servicoId é um número inteiro válido
        if (!is_numeric($servicoId) || intval($servicoId) <= 0) {
            echo 'ID de serviço inválido.';
            return null;
        }

        $sql = "SELECT SERVICO.ID_SERVICO, CONTRATANTE.NOME AS CONTRATANTE_NOME, CONTRATANTE.TELEFONE AS CONTRATANTE_TELEFONE, CONTRATANTE.EMAIL AS CONTRATANTE_EMAIL, SERVICO.DESCRICAO AS SERVICO_DESCRICAO, SERVICO.SERVICO AS SERVICO_NOME, CONTRATANTE.ENDERECO AS CONTRATANTE_ENDERECO, CONTRATANTE.CIDADE AS CONTRATANTE_CIDADE, CONTRATANTE.BAIRRO AS CONTRATANTE_BAIRRO
        FROM SERVICO
        INNER JOIN CONTRATANTE ON SERVICO.ID_FK = CONTRATANTE.ID
        WHERE SERVICO.ID_SERVICO = $servicoId";

        $resultado = $this->conexao->executarConsulta($sql);

        if ($resultado !== null && $resultado instanceof mysqli_result) {
            $row = $this->conexao->obterProximaLinha($resultado);

            if (is_array($row)) {
                $servico = array(
                    'ID_SERVICO' => $row['ID_SERVICO'],
                    'CONTRATANTE_NOME' => $row['CONTRATANTE_NOME'],
                    'CONTRATANTE_TELEFONE' => $row['CONTRATANTE_TELEFONE'],
                    'CONTRATANTE_EMAIL' => $row['CONTRATANTE_EMAIL'],
                    'SERVICO_DESCRICAO' => $row['SERVICO_DESCRICAO'],
                    'SERVICO_NOME' => $row['SERVICO_NOME'],
                    'CONTRATANTE_ENDERECO' => $row['CONTRATANTE_ENDERECO'],
                    'CONTRATANTE_CIDADE' => $row['CONTRATANTE_CIDADE'],
                    'CONTRATANTE_BAIRRO' => $row['CONTRATANTE_BAIRRO']
                );

                return $servico;
            } else {
                echo 'Nenhum resultado encontrado.';
                return null;
            }
        } else {
            echo 'Erro na consulta: ' . $this->conexao->obterErro();
            return null;
        }
    }

    public function MostrarServicosSelecionados($servicosSelecionados)
    {
        echo '<div class="freelancer">';
        if (is_array($servicosSelecionados)) {
            echo '<h3>' . $servicosSelecionados['CONTRATANTE_NOME'] . '</h3>';
            echo '<p>Email: ' . $servicosSelecionados['CONTRATANTE_EMAIL'] . '</p>';
            echo '<p>Telefone: ' . $servicosSelecionados['CONTRATANTE_TELEFONE'] . '</p>';
            echo '<p>Endereço: ' . $servicosSelecionados['CONTRATANTE_ENDERECO'] . '</p>';
            echo '<p>Cidade: ' . $servicosSelecionados['CONTRATANTE_CIDADE'] . '</p>';
            echo '<p>Bairro: ' . $servicosSelecionados['CONTRATANTE_BAIRRO'] . '</p>';
            echo '<p>Descrição: ' . $servicosSelecionados['SERVICO_DESCRICAO'] . '</p>';
            echo '<p>Serviço: ' . $servicosSelecionados['SERVICO_NOME'] . '</p>';
        }
        echo '</div>';
    }
}
?>
