<?php
class CompararFreelancers
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    public function GetFreelancers()
    {
        $sql = "SELECT FREELANCERS.ID_FREELANCER, TALENTO.NOME, TALENTO.TELEFONE, TALENTO.EMAIL, FREELANCERS.DESCRICAO, FREELANCERS.SERVICO, FREELANCERS.FORMACAO, FREELANCERS.OBJETIVO,
                FREELANCERS.CURSOS_COMPLEMENTARES, FREELANCERS.EXPERIENCIA
                FROM FREELANCERS
                INNER JOIN TALENTO ON FREELANCERS.ID_FK = TALENTO.ID";

        $resultado = $this->conexao->executarConsulta($sql);
        $freelancers = array();

        if ($resultado !== null && $resultado instanceof mysqli_result && $this->conexao->obterNumLinhas($resultado) > 0) {
            while ($row = $this->conexao->obterProximaLinha($resultado)) {
                $freelancer = array(
                    'ID_FREELANCER' => $row['ID_FREELANCER'],
                    'NOME' => $row['NOME'],
                    'TELEFONE' => $row['TELEFONE'],
                    'EMAIL' => $row['EMAIL'],
                    'DESCRICAO' => $row['DESCRICAO'],
                    'SERVICO' => $row['SERVICO'],
                    'FORMACAO' => $row['FORMACAO'],
                    'OBJETIVO' => $row['OBJETIVO'],
                    'CURSOS_COMPLEMENTARES' => $row['CURSOS_COMPLEMENTARES'],
                    'EXPERIENCIA' => $row['EXPERIENCIA']
                );
                $freelancers[] = $freelancer;
            }
        }

        return $freelancers;
    }

    public function MostrarFreelancersSelecionados($freelancersSelecionados)
    {
        echo '<div class="freelancer">';
        if (is_array($freelancersSelecionados)) {
            echo '<h3>' . $freelancersSelecionados['NOME'] . '</h3>';
            echo '<p>Email: ' . $freelancersSelecionados['EMAIL'] . '</p>';
            echo '<p>Telefone: ' . $freelancersSelecionados['TELEFONE'] . '</p>';
            echo '<p>Descrição: ' . $freelancersSelecionados['DESCRICAO'] . '</p>';
            echo '<p>Serviço: ' . $freelancersSelecionados['SERVICO'] . '</p>';
            echo '<p>Formação: ' . $freelancersSelecionados['FORMACAO'] . '</p>';
            echo '<p>Objetivo: ' . $freelancersSelecionados['OBJETIVO'] . '</p>';
            echo '<p>Cursos Complementares: ' . $freelancersSelecionados['CURSOS_COMPLEMENTARES'] . '</p>';
            echo '<p>Experiência: ' . $freelancersSelecionados['EXPERIENCIA'] . '</p>';
        }
        echo '</div>';
    }

    public function GetFreelancerPorId($freelancerId)
    {
        // Verifique se $freelancerId é um número inteiro válido
        if (!is_numeric($freelancerId) || intval($freelancerId) <= 0) {
            echo 'ID de freelancer inválido.';
            return null;
        }

        $sql = "SELECT FREELANCERS.ID_FREELANCER, TALENTO.NOME, TALENTO.TELEFONE, TALENTO.EMAIL, FREELANCERS.DESCRICAO, FREELANCERS.SERVICO, FREELANCERS.FORMACAO, FREELANCERS.OBJETIVO,
                FREELANCERS.CURSOS_COMPLEMENTARES, FREELANCERS.EXPERIENCIA
                FROM FREELANCERS
                INNER JOIN TALENTO ON FREELANCERS.ID_FK = TALENTO.ID
                WHERE FREELANCERS.ID_FREELANCER = $freelancerId";

        $resultado = $this->conexao->executarConsulta($sql);

        if ($resultado !== null && $resultado instanceof mysqli_result) {
            $row = $this->conexao->obterProximaLinha($resultado);

            if (is_array($row)) {
                $freelancer = array(
                    'ID_FREELANCER' => $row['ID_FREELANCER'],
                    'NOME' => $row['NOME'],
                    'TELEFONE' => $row['TELEFONE'],
                    'EMAIL' => $row['EMAIL'],
                    'DESCRICAO' => $row['DESCRICAO'],
                    'SERVICO' => $row['SERVICO'],
                    'FORMACAO' => $row['FORMACAO'],
                    'OBJETIVO' => $row['OBJETIVO'],
                    'CURSOS_COMPLEMENTARES' => $row['CURSOS_COMPLEMENTARES'],
                    'EXPERIENCIA' => $row['EXPERIENCIA']
                );

                return $freelancer;
            } else {
                echo 'Nenhum resultado encontrado.';
                return null;
            }
        } else {
            echo 'Erro na consulta: ' . $this->conexao->obterErro();
            return null;
        }
    }
}
?>
