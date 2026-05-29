<?php
use config\Database;
require_once __DIR__ . '/../models/Participacao.php';

$database = new Database();
$db = $database->conectar();

$evento_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$participacaoModel = new Participacao($db);
$usuario_logado    = isset($_SESSION['usuario_id']);
$ja_inscrito       = $usuario_logado
    ? $participacaoModel->jaInscrito($_SESSION['usuario_id'], $evento_id)
    : false;
$total_confirmados = $participacaoModel->contarConfirmados($evento_id);
?>
<section class="event-details-section">
    <div class="event-details-flex">
        <div class="event-details-media">
            <img src="https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop" alt="Imagem do Evento">
        </div>

        <div class="event-details-info">
            <div>
                <span class="event-tag">Festas & Shows</span>
                <h1>Neon Night Party 2026</h1>
                
                <div class="event-detail-item">
                    <span class="meta-icon">📅</span>
                    <strong>Data e Hora:</strong> 12 de Junho, às 22:00
                </div>
                
                <div class="event-detail-item">
                    <span class="meta-icon">📍</span>
                    <strong>Local:</strong> Espaço VIP, Curitiba
                </div>
                
                <div class="event-detail-item">
                    <span class="meta-icon">👤</span>
                    <strong>Organizado por:</strong> Pekas Eventos
                </div>
                
                <div class="event-detail-item">
                    <span class="meta-icon">🏷️</span>
                    <strong>Capacidade:</strong> 500 pessoas
                </div>

                <div class="event-description-box">
                    <h3>Sobre o Evento</h3>
                    <p class="event-description">A maior festa neon da região está de volta com open bar premium e line-up de DJs internacionais. Venha com roupas brancas ou fluorescentes para aproveitar ao máximo a iluminação ultravioleta, as tintas neon espalhadas pelo espaço e os brindes exclusivos que preparamos para a comunidade PartyPal.</p>
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
            <span class="badge badge-success">✅ Você está inscrito</span>
            <form action="../controller/ParticipacaoController.php?action=cancelar" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="evento_id"  value="<?= $evento_id ?>">
                <button type="submit" class="presence-btn"
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
        <a href="login.php?msg=login_necessario" class="presence-btn">
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

    <div class="comments-container">
        <h3>Espaço da Comunidade</h3>
        
        <form class="comment-form" method="POST" action="">
            <textarea class="comment-textarea" name="comentario" rows="4" placeholder="Escreva um comentário ou tire suas dúvidas sobre o evento..."></textarea>
            <div class="comment-form-footer">
                <button type="submit" class="comment-submit-btn">Publicar Comentário</button>
            </div>
        </form>

        <div class="comments-list">
            <div class="comment-card">
                <div class="comment-header">
                    <span class="comment-author">Samuel</span>
                    <span class="comment-date">26/05/2026</span>
                </div>
                <p class="comment-text">Esse line-up de DJs está simplesmente sensacional! Estarei lá com certeza.</p>
                <div class="comment-actions">
                    <a href="#" class="comment-edit">Editar</a>
                    <a href="#" class="comment-delete">Excluir</a>
                </div>
            </div>

            <div class="comment-card">
                <div class="comment-header">
                    <span class="comment-author">Pazuch</span>
                    <span class="comment-date">25/05/2026</span>
                </div>
                <p class="comment-text">Alguém sabe se vai ter estacionamento conveniado perto do Espaço VIP?</p>
                <div class="comment-actions">
                    <a href="#" class="comment-edit">Editar</a>
                    <a href="#" class="comment-delete">Excluir</a>
                </div>
            </div>
        </div>
    </div>
</section>
