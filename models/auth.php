<?php

namespace App\models;

class auth{
    private $db;

    public function __construct($conexaoRecebida)
    {
        $this->db = $conexaoRecebida;
    }

    public function criarUsuário($name ,$email, $cpf, $dataNasc, $senha){
        $sql = "SELECT * FROM usuarios WHERE email = :email OR cpf = :cpf";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->execute();
        
        if($stmt->fetch()){
            return false;
        }
        else{
            $sql = "INSERT INTO usuarios (nome, email, cpf, data_nascimento, senha) VALUES (:nome, :email, :cpf, :dataNasc, :senha)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nome' => $name,
                ':email' => $email,
                ':cpf' => $cpf,
                ':dataNasc' => $dataNasc,
                ':senha' => $senha
                ]);
            return true;
        }
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

    public function resetarSenha($email, $cpf, $dataNasc, $novaSenha){
        $sql = "UPDATE usuarios SET senha = :senha WHERE email = :email AND cpf = :cpf AND data_nascimento = :dataNasc";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':cpf',  $cpf);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':dataNasc', $dataNasc);
        $stmt->bindValue(':senha', $novaSenha);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}