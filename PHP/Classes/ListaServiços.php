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
        $sql = "SELECT TALENTO.NOME, TALENTO.TELEFONE, TALENTO.EMAIL, SERVICO.DESCRICAO, SERVICO.SERVICO
                FROM SERVICO
                INNER JOIN TALENTO ON SERVICO.ID_FK = TALENTO.ID";

        $resultado = $this->conexao->executarConsulta($sql);

        if ($this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $this->MostrarServicos($row);
            }
        } else {
            echo 'Nenhum freelancer encontrado.';
        }
    }

    private function MostrarServicos($row)
    {
        echo '<div class="freelancer">';
        echo '<h3>' . $row['NOME'] . '</h3>';
        echo '<p>Email: ' . $row['EMAIL'] . '</p>';
        echo '<p>Telefone: ' . $row['TELEFONE'] . '</p>';
        echo '<p>Descrição: ' . $row['DESCRICAO'] . '</p>';
        echo '<p>Serviço: ' . $row['SERVICO'] . '</p>';
        echo '</div>';
    }

    public function PesquisarServicos($busca)
    {
        $sql = "SELECT TALENTO.NOME, TALENTO.TELEFONE, TALENTO.EMAIL, SERVICO.DESCRICAO, SERVICO.SERVICO
                FROM SERVICO
                INNER JOIN TALENTO ON SERVICO.ID_FK = TALENTO.ID
                WHERE TALENTO.NOME LIKE '%{$busca}%' OR SERVICO.DESCRICAO LIKE '%{$busca}%' OR SERVICO.SERVICO LIKE '%{$busca}%'";

        $resultado = $this->conexao->executarConsulta($sql);

        if ($this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $this->MostrarServicos($row);
            }
        } else {
            echo 'Nenhum freelancer encontrado.';
        }
    }
}
?>