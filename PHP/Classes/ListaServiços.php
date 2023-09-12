<?php
class ListaServicos
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function GetServicos()
{
    $sql = "SELECT SERVICO.ID_SERVICO, CONTRATANTE.NOME, CONTRATANTE.TELEFONE, CONTRATANTE.EMAIL, SERVICO.DESCRICAO, SERVICO.SERVICO, CONTRATANTE.ENDERECO, CONTRATANTE.CIDADE, CONTRATANTE.BAIRRO
    FROM SERVICO
    INNER JOIN CONTRATANTE ON SERVICO.ID_FK = CONTRATANTE.ID";

    $resultado = $this->conexao->executarConsulta($sql);
    $servicos = array();

    if ($this->conexao->obterNumLinhas($resultado) > 0) {
        while ($row = $this->conexao->obterProximaLinha($resultado)) {
            $servicos[] = $row;
        }
    }

    return $servicos;
}

    private function MostrarServicos($row)
    {
        echo '<div class="freelancer">';
        echo '<h3>' . $row['NOME'] . '</h3>';
        echo '<p>Email: ' . $row['EMAIL'] . '</p>';
        echo '<p>Telefone: ' . $row['TELEFONE'] . '</p>';
        echo '<p>Endereço: ' . $row['ENDERECO'] . '</p>';
        echo '<p>Cidade: ' . $row['CIDADE'] . '</p>';
        echo '<p>Bairro: ' . $row['BAIRRO'] . '</p>';
        echo '<p>Descrição: ' . $row['DESCRICAO'] . '</p>';
        echo '<p>Serviço: ' . $row['SERVICO'] . '</p>';
        echo '</div>';
    }

    public function PesquisarServicos($busca)
    {
        $sql = "SELECT CONTRATANTE.NOME, CONTRATANTE.TELEFONE, CONTRATANTE.EMAIL, SERVICO.DESCRICAO, SERVICO.SERVICO, CONTRATANTE.ENDERECO, CONTRATANTE.CIDADE, CONTRATANTE.BAIRRO
        FROM SERVICO
        INNER JOIN CONTRATANTE ON SERVICO.ID_FK = CONTRATANTE.ID
        WHERE CONTRATANTE.NOME LIKE '%{$busca}%' OR SERVICO.DESCRICAO LIKE '%{$busca}%' OR SERVICO.SERVICO LIKE '%{$busca}%' OR CONTRATANTE.CIDADE LIKE '%{$busca}%'";


        $resultado = $this->conexao->executarConsulta($sql);

        if ($this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $this->MostrarServicos($row);
            }
        } else {
            echo 'Nenhum serviço encontrado.';
        }
    }
}
?>