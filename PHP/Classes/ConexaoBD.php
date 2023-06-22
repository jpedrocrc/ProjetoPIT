<?php

class ConexaoBD
{
    private $nomeServidor;
    private $nomeUsuario;
    private $senha;
    private $nomeBanco;
    private $conexao;

    public function __construct($nomeServidor, $nomeUsuario, $senha, $nomeBanco)
    {
        $this->nomeServidor = $nomeServidor;
        $this->nomeUsuario = $nomeUsuario;
        $this->senha = $senha;
        $this->nomeBanco = $nomeBanco;
    }

    // Conectar ao banco
    public function conectar()
    {
        $this->conexao = new mysqli($this->nomeServidor, $this->nomeUsuario, $this->senha, $this->nomeBanco);

        if ($this->conexao->connect_error) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    // Fechar conexão com o banco
    public function fecharConexao()
    {
        $this->conexao->close();
    }

    // Executar a consulta
    public function executarConsulta($sql)
    {
        return $this->conexao->query($sql);
    }

    // Verificar erro
    public function obterErro()
    {
        return $this->conexao->error;
    }

    // Obter o número de linhas do resultado da consulta
    public function obterNumLinhas($resultado)
    {
        return $resultado->num_rows;
    }

    // Obter a próxima linha do resultado da consulta
    public function obterProximaLinha($resultado)
    {
        return $resultado->fetch_assoc();
    }
}

?>