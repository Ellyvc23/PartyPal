<?php

namespace App\Controller;

use App\models\auth;
use config\Database;

class authController{
    public function criarUser(){
        $db = new Database();
        $conexao = $db->conectar();

        $name = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $dataNasc = $_POST['data_nascimento'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $modelUser = new auth($conexao);

        if($modelUser->criarUsuário($name, $email, $cpf, $dataNasc, $senha) == true){
                $_SESSION['alerta_sucesso'] = 'Usuário cadastrado com sucesso!';
                header("Location: index.php?p=login");
                exit;
        }
        else{
            echo "<script> alert('Não foi possivel completar o cadastro, tente novamente.'); </script>";
        }
    }

    public function logar(){
        $db = new Database();
        $conexao = $db->conectar();

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $modelLogar = new auth($conexao);

        if($modelLogar->logar($email, $senha)){
            header("Location: index.php?p=home");
            exit;
        } else {
            header("Location: index.php?p=login");
            exit;
        }
    }

    public function logout(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php?p=home");
        exit;
    }
}