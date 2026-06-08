<?php
class Participacao {
    private $conn;
    private $table = 'participacoes';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function inscrever($usuario_id, $evento_id) {
        if ($this->jaInscrito($usuario_id, $evento_id)) {
            return ['success' => false, 'msg' => 'Você já está inscrito neste evento.'];
        }

        $sql = "INSERT INTO participacoes (usuario_id, evento_id, status, data_inscricao)
                VALUES (:usuario_id, :evento_id, 'confirmado', NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':evento_id', $evento_id);

        if ($stmt->execute()) {
            return ['success' => true, 'msg' => 'Inscrição realizada com sucesso!'];
        }
        return ['success' => false, 'msg' => 'Erro ao realizar inscrição.'];
    }

    public function cancelar($usuario_id, $evento_id) {
        $sql = "DELETE FROM participacoes WHERE usuario_id = :usuario_id AND evento_id = :evento_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':evento_id', $evento_id);

        if ($stmt->execute()) {
            return ['success' => true, 'msg' => 'Inscrição cancelada.'];
        }
        return ['success' => false, 'msg' => 'Erro ao cancelar inscrição.'];
    }

    public function jaInscrito($usuario_id, $evento_id) {
        $sql = "SELECT id FROM participacoes WHERE usuario_id = :usuario_id AND evento_id = :evento_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':evento_id', $evento_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function buscarPorUsuario($usuario_id) {
        $sql = "SELECT p.*, e.titulo, e.data_evento, e.localizacao AS local, e.descricao, e.imagem_url AS imagem
                FROM participacoes p
                JOIN eventos e ON p.evento_id = e.id
                WHERE p.usuario_id = :usuario_id
                ORDER BY p.data_inscricao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorEvento($evento_id) {
        $sql = "SELECT p.*, u.nome, u.email
                FROM participacoes p
                JOIN usuarios u ON p.usuario_id = u.id
                WHERE p.evento_id = :evento_id
                ORDER BY p.data_inscricao ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':evento_id', $evento_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($participacao_id, $status) {
        $permitidos = ['confirmado', 'pendente', 'cancelado'];
        if (!in_array($status, $permitidos)) {
            return ['success' => false, 'msg' => 'Status inválido.'];
        }

        $sql = "UPDATE participacoes SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $participacao_id);

        if ($stmt->execute()) {
            return ['success' => true, 'msg' => 'Status atualizado.'];
        }
        return ['success' => false, 'msg' => 'Erro ao atualizar status.'];
    }

    public function contarConfirmados($evento_id) {
        $sql = "SELECT COUNT(*) as total FROM participacoes 
                WHERE evento_id = :evento_id AND status = 'confirmado'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':evento_id', $evento_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}