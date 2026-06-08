<?php
use config\Database;
require_once __DIR__ . '/../models/Participacao.php';

$database = new Database();
$db = $database->conectar();

$evento_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $db->prepare("SELECT e.*, c.nome AS categoria_nome, u.nome AS organizador_nome 
                      FROM eventos e 
                      JOIN categorias c ON e.categoria_id = c.id 
                      JOIN usuarios u ON e.usuario_id = u.id 
                      WHERE e.id = :id");
$stmt->execute([':id' => $evento_id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    echo "<h2 style='color: white; text-align: center; margin-top: 50px;'>Evento não encontrado.</h2>";
    exit;
}

$participacaoModel = new Participacao($db);
$usuario_logado    = isset($_SESSION['usuario_id']);
$ja_inscrito       = $usuario_logado
    ? $participacaoModel->jaInscrito($_SESSION['usuario_id'], $evento_id)
    : false;
$total_confirmados = $participacaoModel->contarConfirmados($evento_id);

$data_formatada = date('d/m/Y \à\s H:i', strtotime($evento['data_evento']));
?>
<section class="event-details-section">
    <div class="event-details-flex">
        <div class="event-details-media">
            <img src="<?= !empty($evento['imagem_url']) ? htmlspecialchars($evento['imagem_url']) : 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop' ?>" alt="Imagem do Evento">
        </div>

        <div class="event-details-info">
            <div>
                <span class="event-tag"><?= htmlspecialchars($evento['categoria_nome']) ?></span>
                <h1><?= htmlspecialchars($evento['titulo']) ?></h1>
                
                <div class="event-detail-item">
                    <span class="meta-icon">📅</span>
                    <strong>Data e Hora:</strong> <?= $data_formatada ?>
                </div>
                
                <div class="event-detail-item">
                    <span class="meta-icon">📍</span>
                    <strong>Local:</strong> <?= htmlspecialchars($evento['localizacao']) ?>
                </div>
                
                <div class="event-detail-item">
                    <span class="meta-icon">👤</span>
                    <strong>Organizado por:</strong> <?= htmlspecialchars($evento['organizador_nome']) ?>
                </div>

                <div class="event-description-box">
                    <h3>Sobre o Evento</h3>
                    <p class="event-description"><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                </div>
            </div>

            <div class="presence-box">

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['sucesso']) ?></div>
    <?php elseif (isset($_GET['erro'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['erro']) ?></div>
    <?php endif; ?>

    <p>👥 <strong><?= $total_confirmados ?></strong> confirmado(s)</p>

    <?php if ($usuario_logado): ?>
        <?php if ($ja_inscrito): ?>
            <span class="badge badge-success" style="display:inline-block; margin-bottom:10px; color:#00d4aa; font-weight:bold;">✅ Você está inscrito</span>
            <form action="../controller/ParticipacaoController.php?action=cancelar" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="evento_id"  value="<?= $evento_id ?>">
                <button type="submit" class="presence-btn" style="background: #ff4f4f; color: white;"
                        onclick="return confirm('Cancelar sua inscrição?')">
                    ❌ Cancelar Inscrição
                </button>
            </form>
        <?php else: ?>
            <form action="../controller/ParticipacaoController.php?action=inscrever" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="evento_id"  value="<?= $evento_id ?>">
                <button type="submit" class="presence-btn">
                    🎉 Inscrever-se neste Evento
                </button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <a href="index.php?p=login&action=login" class="presence-btn" style="display:inline-block; text-align:center; text-decoration:none; box-sizing:border-box; padding-top:14px;">
            🔑 Faça login para se inscrever
        </a>
    <?php endif; ?>

</div>
        </div>
    </div>

    <div class="participants-box">
    <h3>Confirmados no Rolê (<?= $total_confirmados ?>)</h3>
    <ul class="participants-list">
        <?php
        $participantes = $participacaoModel->buscarPorEvento($evento_id);
        foreach ($participantes as $p): ?>
            <li class="participant-item"><?= htmlspecialchars($p['nome']) ?></li>
        <?php endforeach; ?>

        <?php if (empty($participantes)): ?>
            <li class="participant-item">Nenhum confirmado ainda.</li>
        <?php endif; ?>
    </ul>
</div>
</section>