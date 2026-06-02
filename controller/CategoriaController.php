<?php

namespace App\Controller;

use App\Models\Categoria;
use config\Database;

require_once(__DIR__ . '/../models/Categoria.php');
require_once(__DIR__ . '/../config/database.php');

class CategoriaController {
    private Categoria $model;

    public function __construct() {
        $db   = new Database();
        $conn = $db->conectar();
        $this->model = new Categoria($conn);
    }

    public function listar(): array {
        return $this->model->listarTodas();
    }

    public function salvar(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?p=gerenciar");
            exit;
        }

        if (!isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            $_SESSION['erro'] = "Requisição inválida.";
            header("Location: index.php?p=gerenciar");
            exit;
        }

        $nome = trim($_POST['nome_categoria'] ?? '');

        if (empty($nome)) {
            $_SESSION['erro'] = "O nome da categoria não pode ser vazio.";
            header("Location: index.php?p=gerenciar");
            exit;
        }

        if ($this->model->criar($nome)) {
            $_SESSION['sucesso'] = "Categoria \"{$nome}\" criada com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao criar categoria.";
        }

        header("Location: index.php?p=gerenciar");
        exit;
    }

    public function deletar(): void {
        $id = (int)($_GET['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['erro'] = "Categoria inválida.";
            header("Location: index.php?p=gerenciar");
            exit;
        }

        if ($this->model->deletar($id)) {
            $_SESSION['sucesso'] = "Categoria removida com sucesso!";
        } else {
            $_SESSION['erro'] = "Não é possível remover uma categoria com eventos vinculados.";
        }

        header("Location: index.php?p=gerenciar");
        exit;
    }
}
