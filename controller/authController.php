<?php

namespace App\Controller;

use App\models\auth;
use config\Database;

class authController{
    public function criarUser(){
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erro de segurança: Token CSRF inválido.");
        }
        $db = new Database();
        $conexao = $db->conectar();

        $name = $_POST['nome'];
        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $dataNasc = $_POST['data_nascimento'];
        $senhaOriginal = $_POST['senha'];
        $passConfirm = $_POST['senha_confirma'];

        $cpfLimpo = preg_replace('/[^0-9]/', '', $cpf);
        if(strlen($cpfLimpo) !== 11) {
            echo "<script> 
                    alert('CPF inválido!'); 
                    window.history.back(); 
                    </script>";
            exit;
        }

        if(strtotime($dataNasc) > time()) {
            echo "<script> 
                    alert('Data de nascimento inválida!'); 
                    window.history.back(); 
                    </script>";
            exit;
        }

        if($senhaOriginal != $passConfirm){
            echo "<script> 
                    alert('As senhas não coincidem! Tente novamente.'); 
                    window.history.back(); 
                    </script>";
            exit;
        }

        $senha = password_hash($senhaOriginal, PASSWORD_DEFAULT);

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
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erro de segurança: Token CSRF inválido.");
        }
        $db = new Database();
        $conexao = $db->conectar();

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $modelLogar = new auth($conexao);

        if($modelLogar->logar($email, $senha)){
            setcookie('email_salvo', $email, time() + (86400 * 30), "/");
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

    public function recuperarSenha(){
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erro de segurança: Token CSRF inválido.");
        }
        $db = new Database();
        $conexao = $db->conectar();

        $email = $_POST['email'];
        $cpf = $_POST['cpf'];
        $dataNasc = $_POST['data_nascimento'];
        $novaSenha = $_POST['nova_senha'];
        $passConfirm = $_POST['nova_senha_confirma'];

        if($novaSenha != $passConfirm){
            echo "<script> 
                    alert('As senhas não coincidem! Tente novamente.'); 
                    window.history.back(); 
                    </script>";
            exit;
        }

        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);

        $modelRecuperar = new auth($conexao);

        if($modelRecuperar->resetarSenha($email, $cpf, $dataNasc, $senhaHash)) {
                if(session_status() === PHP_SESSION_NONE){ session_start(); }
            $_SESSION['alerta_sucesso'] = 'Senha redefinida com sucesso! Faça login com sua nova senha.';
            header("Location: index.php?p=login");
            exit;
        } 
        else {
            echo "<script> 
                    alert('Dados incorretos! Verifique se os dados digitados estão corretos.'); 
                    window.history.back(); 
                    </script>";
            exit;
        }
    }
}