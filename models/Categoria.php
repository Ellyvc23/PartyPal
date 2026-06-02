<?php

namespace App\Models;

use PDO;

class Categoria {
    private PDO $conn;
    private string $table = 'categorias';

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function listarTodas(): array {
        $stmt = $this->conn->query("SELECT * FROM {$this->table} ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array|false {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar(string $nome): bool {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (nome) VALUES (:nome)");
        return $stmt->execute([':nome' => trim($nome)]);
    }

    public function atualizar(int $id, string $nome): bool {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET nome = :nome WHERE id = :id");
        return $stmt->execute([':nome' => trim($nome), ':id' => $id]);
    }

    public function deletar(int $id): bool {
        $check = $this->conn->prepare("SELECT COUNT(*) FROM eventos WHERE categoria_id = :id");
        $check->execute([':id' => $id]);
        if ($check->fetchColumn() > 0) {
            return false;
        }
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
