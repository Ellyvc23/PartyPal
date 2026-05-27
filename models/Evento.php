<?php 
namespace App\models;

class Evento {
    private $db;

    public function __construct($conexao)
    {
        $this->db = $conexao;
    }

    public function listar() {
        $sql = "SELECT eventos.*, categorias.nome AS categoria_nome
        FROM eventos
        JOIN categorias ON eventos.categoria_id = categorias.id
        ORDER BY eventos.data_evento ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
    public function salvar($titulo, $descricao, $data_evento, $localizacao, $imagem_url, $categoria_id, $usuario_id) {
        $sql = "INSERT INTO eventos (titulo, descricao, data_evento, localizacao, imagem_url, categoria_id, usuario_id) 
        VALUES (:titulo, :descricao, :data_evento, :localizacao, :imagem_url, :categoria_id, :usuario_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo, 
            ':descricao' => $descricao, 
            ':data_evento' => $data_evento, 
            ':localizacao' => $localizacao, 
            ':imagem_url' => $imagem_url, 
            ':categoria_id' => $categoria_id, 
            ':usuario_id' => $usuario_id
        ]);
        return true;
    }
    public function buscarPorId($id) {
        $sql = "SELECT eventos.*, categorias.nome AS categoria_nome
        FROM eventos
        JOIN categorias ON eventos.categoria_id = categorias.id
        WHERE eventos.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function editar($id, $titulo, $descricao, $data_evento, $localizacao, $imagem_url, $categoria_id) {
        $sql = "UPDATE eventos 
                SET titulo = :titulo,
                    descricao = :descricao,
                    data_evento = :data_evento,
                    localizacao = :localizacao,
                    imagem_url = :imagem_url,
                    categoria_id = :categoria_id
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id'          => $id,
            ':titulo'      => $titulo,
            ':descricao'   => $descricao,
            ':data_evento' => $data_evento,
            ':localizacao' => $localizacao,
            ':imagem_url'  => $imagem_url,
            ':categoria_id'=> $categoria_id
        ]);
        return true;
    }
    public function deletar($id, $usuario_id) {
        $sql = "DELETE FROM eventos WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id, ':usuario_id' => $usuario_id]);
        return $stmt->rowCount() > 0;
    }
    public function listarComFiltros($busca = null, $categoria_id = null) {
        $sql = "SELECT eventos.*, categorias.nome AS categoria_nome 
                FROM eventos 
                JOIN categorias ON eventos.categoria_id = categorias.id
                WHERE 1=1";

        $params = [];

        if (!empty($busca)) {
            $sql .= " AND eventos.titulo LIKE :busca";
            $params[':busca'] = '%' . $busca . '%';
        }

        if (!empty($categoria_id)) {
            $sql .= " AND eventos.categoria_id = :categoria_id";
            $params[':categoria_id'] = $categoria_id;
        }

        $sql .= " ORDER BY eventos.data_evento ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    public function listarDestaques() {
        $sql = "SELECT eventos.*, categorias.nome AS categoria_nome 
                FROM eventos 
                JOIN categorias ON eventos.categoria_id = categorias.id
                WHERE eventos.destaque = 1
                ORDER BY eventos.data_evento ASC
                LIMIT 3";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function listarPorUsuario($usuario_id) {
        $sql = "SELECT eventos.*, categorias.nome AS categoria_nome 
                FROM eventos 
                JOIN categorias ON eventos.categoria_id = categorias.id
                WHERE eventos.usuario_id = :usuario_id
                ORDER BY eventos.data_evento ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario_id' => $usuario_id]);
        return $stmt->fetchAll();
    }
}
?>