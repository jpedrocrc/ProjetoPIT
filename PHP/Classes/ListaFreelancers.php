<?php
class ListaFreelancers
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function GetFreelancers()
    {
        $sql = "SELECT TALENTO.NOME, TALENTO.TELEFONE, TALENTO.EMAIL, FREELANCERS.DESCRICAO, FREELANCERS.SERVICO, FREELANCERS.FORMACAO,FREELANCERS.OBJETIVO,
                FREELANCERS.CURSOS_COMPLEMENTARES,FREELANCERS.EXPERIENCIA FROM FREELANCERS
                INNER JOIN TALENTO ON FREELANCERS.ID_FK = TALENTO.ID";

        $resultado = $this->conexao->executarConsulta($sql);

        if ($this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $this->MostrarFreelancers($row);
            }
        } else {
            echo 'Nenhum freelancer encontrado.';
        }
    }

    private function MostrarFreelancers($row)
{
    echo '<div class="freelancer">';
    echo '<h3>' . $row['NOME'] . '</h3>';
    echo '<p>Email: ' . $row['EMAIL'] . '</p>';
    echo '<p>Telefone: ' . $row['TELEFONE'] . '</p>';
    echo '<p>Descrição: ' . $row['DESCRICAO'] . '</p>';
    echo '<p>Serviço: ' . $row['SERVICO'] . '</p>';
    echo '<button class="mostrar-mais-btn" onclick="mostrarMais(this)">Mostrar Mais</button>';
    echo '<p class="extra-info" style="display:none">Formação: ' . $row['FORMACAO'] . '</p>';
    echo '<p class="extra-info" style="display:none">Objetivo: ' . $row['OBJETIVO'] . '</p>';
    echo '<p class="extra-info" style="display:none">Cursos Complementares: ' . $row['CURSOS_COMPLEMENTARES'] . '</p>';
    echo '<p class="extra-info" style="display:none">Experiência: ' . $row['EXPERIENCIA'] . '</p>';
    echo '</div>';
}


    public function PesquisarFreelancers($busca)
    {
        $sql = "SELECT TALENTO.NOME, TALENTO.TELEFONE, TALENTO.EMAIL, FREELANCERS.DESCRICAO, FREELANCERS.SERVICO
                FROM FREELANCERS
                INNER JOIN TALENTO ON FREELANCERS.ID_FK = TALENTO.ID
                WHERE TALENTO.NOME LIKE '%{$busca}%' OR FREELANCERS.DESCRICAO LIKE '%{$busca}%' OR FREELANCERS.SERVICO LIKE '%{$busca}%'";

        $resultado = $this->conexao->executarConsulta($sql);

        if ($this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $this->MostrarFreelancers($row);
            }
        } else {
            echo 'Nenhum freelancer encontrado.';
        }
    }
}
?>