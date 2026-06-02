<?php

namespace App\Controller;

use PDO;
use config\Database;

require_once(__DIR__ . '/../config/database.php');

class DashboardController {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function getMetricas(int $usuario_id): array {
        return [
            'total_eventos'       => $this->totalEventosPlataforma(),
            'meus_eventos'        => $this->totalEventosDoUsuario($usuario_id),
            'total_participantes' => $this->totalParticipantesNosEventos($usuario_id),
            'total_comentarios'   => $this->totalComentariosRecebidos($usuario_id),
        ];
    }

    private function totalEventosPlataforma(): int {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM eventos");
        return (int)$stmt->fetchColumn();
    }

    private function totalEventosDoUsuario(int $usuario_id): int {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM eventos WHERE usuario_id = :uid");
        $stmt->execute([':uid' => $usuario_id]);
        return (int)$stmt->fetchColumn();
    }

    private function totalParticipantesNosEventos(int $usuario_id): int {
        $stmt = $this->conn->prepare("
            SELECT COUNT(p.id)
            FROM participacoes p
            INNER JOIN eventos e ON e.id = p.evento_id
            WHERE e.usuario_id = :uid
        ");
        $stmt->execute([':uid' => $usuario_id]);
        return (int)$stmt->fetchColumn();
    }

    private function totalComentariosRecebidos(int $usuario_id): int {
        $check = $this->conn->query("SHOW TABLES LIKE 'comentarios'");
        if ($check->rowCount() === 0) return 0;

        $stmt = $this->conn->prepare("
            SELECT COUNT(c.id)
            FROM comentarios c
            INNER JOIN eventos e ON e.id = c.evento_id
            WHERE e.usuario_id = :uid
        ");
        $stmt->execute([':uid' => $usuario_id]);
        return (int)$stmt->fetchColumn();
    }

    public function getMinhasParticipacoes(int $usuario_id): array {
        $stmt = $this->conn->prepare("
            SELECT e.id, e.titulo, e.data_evento, e.localizacao, p.status
            FROM participacoes p
            INNER JOIN eventos e ON e.id = p.evento_id
            WHERE p.usuario_id = :uid
            ORDER BY e.data_evento ASC
        ");
        $stmt->execute([':uid' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
