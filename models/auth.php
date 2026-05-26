<?php

namespace App\models;

class auth{
    private $db;

    public function __construct($conexaoRecebida)
    {
        $this->db = $conexaoRecebida;
    }

    public function criarUsuário($name ,$email, $cpf, $dataNasc, $senha){
        $sql = "INSERT INTO usuarios (nome, email, cpf, data_nascimento, senha) VALUES (:nome, :email, :cpf, :dataNasc, :senha)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nome' => $name, ':email' => $email, ':cpf' => $cpf, ':dataNasc' => $dataNasc, ':senha' => $senha]);
        return true;
    }

    public function logar($email, $senha){
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();
        if ($usuario && password_verify($senha, $usuario['senha'])){
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            return true;
        }
        else{
            return false;
        }
    }
}