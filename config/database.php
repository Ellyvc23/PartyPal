<?php
namespace config;

class Database{
    private $host = '127.0.0.1';
    private $dbname = 'partypal';
    private $usuario = 'root';
    private $senha = '';

    public function conectar(){

        try {
            $conexao = new \PDO("mysql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->senha);
            $conexao->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conexao;
        }catch(\PDOException $e){
            die('Erro de conexão!' . $e->getMessage());
        }
    }
}