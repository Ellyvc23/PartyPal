<?php
namespace App\Controller;

use App\models\Evento;
use config\Database;

class EventoController {

    private function getModel() {
        $db = new Database();
        $conexao = $db->conectar();
        return new Evento($conexao);
    }

    public function salvarEvento() {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erro de segurança: Token CSRF inválido.");
        }

        $titulo      = $_POST['titulo'];
        $descricao   = $_POST['descricao'];
        $data_evento = $_POST['data_evento'];
        $localizacao = $_POST['localizacao'];
        $imagem_url  = $_POST['imagem_url'];
        $categoria_id = $_POST['categoria_id'];
        $usuario_id  = $_SESSION['usuario_id'];

        $model = $this->getModel();
        $model->salvar($titulo, $descricao, $data_evento, $localizacao, $imagem_url, $categoria_id, $usuario_id);

        $_SESSION['alerta_sucesso'] = 'Evento criado com sucesso!';
        header("Location: index.php?p=meusEventos");
        exit;
    }
    public function editarEvento() {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die("Erro de segurança: Token CSRF inválido.");
            }

            $id          = $_POST['id'];
            $titulo      = $_POST['titulo'];
            $descricao   = $_POST['descricao'];
            $data_evento = $_POST['data_evento'];
            $localizacao = $_POST['localizacao'];
            $imagem_url  = $_POST['imagem_url'];
            $categoria_id = $_POST['categoria_id'];

            $model = $this->getModel();
            $model->editar($id, $titulo, $descricao, $data_evento, $localizacao, $imagem_url, $categoria_id);

            $_SESSION['alerta_sucesso'] = 'Evento atualizado com sucesso!';
            header("Location: index.php?p=meusEventos");
            exit;
        }
        public function deletarEvento() {
        $id         = $_GET['id'];
        $usuario_id = $_SESSION['usuario_id'];

        $model = $this->getModel();
        $result = $model->deletar($id, $usuario_id);

        if ($result) {
            $_SESSION['alerta_sucesso'] = 'Evento excluído com sucesso!';
        } else {
            $_SESSION['alerta_erro'] = 'Não foi possível excluir. Este evento não pertence a você.';
        }

        header("Location: index.php?p=meusEventos");
        exit;
    }
    public function carregarHome() {
        $model = $this->getModel();
        return $model->listarDestaques();
    }
    public function carregarEventos() {
        $busca       = $_GET['busca'] ?? null;
        $categoria_id = $_GET['categoria'] ?? null;

        $model = $this->getModel();
        return $model->listarComFiltros($busca, $categoria_id);
    }
    public function carregarMeusEventos() {
        $usuario_id = $_SESSION['usuario_id'];

        $model = $this->getModel();
        return $model->listarPorUsuario($usuario_id);
    }
    public function carregarEditar($id) {
        $model = $this->getModel();
        return $model->buscarPorId($id);
    }
}