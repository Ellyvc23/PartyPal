<?php

namespace App\Controller;

use config\Database;
use Participacao;

require_once __DIR__ . '/../models/Participacao.php';

class ParticipacaoController {
    private $db;
    private $participacao;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conectar();
        $this->participacao = new Participacao($this->db);
    }

    public function inscrever() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ../view/login.php?msg=login_necessario');
            exit;
        }

        $this->verificarCSRF();

        $evento_id  = filter_input(INPUT_POST, 'evento_id', FILTER_VALIDATE_INT);
        $usuario_id = $_SESSION['usuario_id'];

        if (!$evento_id) {
            header('Location: ../view/eventos.php?erro=evento_invalido');
            exit;
        }

        $resultado = $this->participacao->inscrever($usuario_id, $evento_id);

        $tipo = $resultado['success'] ? 'sucesso' : 'erro';
        header("Location: ../view/detalhes_evento.php?id={$evento_id}&{$tipo}=" . urlencode($resultado['msg']));
        exit;
    }

    public function cancelar() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ../view/login.php');
            exit;
        }

        $this->verificarCSRF();

        $evento_id  = filter_input(INPUT_POST, 'evento_id', FILTER_VALIDATE_INT);
        $usuario_id = $_SESSION['usuario_id'];

        $resultado = $this->participacao->cancelar($usuario_id, $evento_id);

        $tipo = $resultado['success'] ? 'sucesso' : 'erro';
        header("Location: ../view/detalhes_evento.php?id={$evento_id}&{$tipo}=" . urlencode($resultado['msg']));
        exit;
    }

    public function minhasParticipacoes() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ../view/login.php');
            exit;
        }

        $participacoes = $this->participacao->buscarPorUsuario($_SESSION['usuario_id']);
        include __DIR__ . '/../view/minhas_participacoes.php';
    }

    public function participantesEvento() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ../view/login.php');
            exit;
        }

        $evento_id = filter_input(INPUT_GET, 'evento_id', FILTER_VALIDATE_INT);
        if (!$evento_id) {
            header('Location: ../view/eventos.php');
            exit;
        }

        $participantes = $this->participacao->buscarPorEvento($evento_id);
        include __DIR__ . '/../view/participantes_evento.php';
    }

    public function atualizarStatus() {
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ../view/login.php');
            exit;
        }

        $this->verificarCSRF();

        $participacao_id = filter_input(INPUT_POST, 'participacao_id', FILTER_VALIDATE_INT);
        $status          = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_SPECIAL_CHARS);
        $evento_id       = filter_input(INPUT_POST, 'evento_id', FILTER_VALIDATE_INT);

        $resultado = $this->participacao->atualizarStatus($participacao_id, $status);

        $tipo = $resultado['success'] ? 'sucesso' : 'erro';
        header("Location: ../view/participantes_evento.php?evento_id={$evento_id}&{$tipo}=" . urlencode($resultado['msg']));
        exit;
    }

    private function verificarCSRF() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            die('Token CSRF inválido.');
        }
    }
}

// Roteamento
$controller = new ParticipacaoController();
$action = $_GET['action'] ?? '';

match($action) {
    'inscrever'        => $controller->inscrever(),
    'cancelar'         => $controller->cancelar(),
    'minhas'           => $controller->minhasParticipacoes(),
    'participantes'    => $controller->participantesEvento(),
    'atualizar_status' => $controller->atualizarStatus(),
    default            => header('Location: ../view/eventos.php')
};
