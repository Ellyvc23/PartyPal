<section class="participacoes-section">
    <h2>📋 Minhas Participações</h2>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['sucesso']) ?></div>
    <?php elseif (isset($_GET['erro'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_GET['erro']) ?></div>
    <?php endif; ?>

    <?php if (empty($participacoes)): ?>
        <p style="color: #bdbdbd; text-align: center; margin-top: 20px;">Você ainda não está inscrito em nenhum evento. <a href="index.php?p=eventos" style="color:#e255ff; text-decoration: none; font-weight: 600;">Ver eventos disponíveis</a></p>
    <?php else: ?>
        <div class="participacoes-grid">
            <?php foreach ($participacoes as $p): ?>
            <div class="part-card">
                <div class="part-image" style="background-image: url('<?= !empty($p['imagem']) ? htmlspecialchars($p['imagem']) : 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=1200&auto=format&fit=crop' ?>'); background-size: cover; background-position: center; height: 180px; width: 100%;"></div>
                <div class="part-body">
                    <h5><?= htmlspecialchars($p['titulo']) ?></h5>
                    <p style="margin-top: 10px; line-height: 1.6;">
                        📅 <?= date('d/m/Y \à\s H:i', strtotime($p['data_evento'])) ?><br>
                        📍 <?= htmlspecialchars($p['local']) ?>
                    </p>
                    <div style="margin-top: 15px;">
                        <span class="badge badge-<?= ['confirmado'=>'success', 'pendente'=>'warning', 'cancelado'=>'danger'][$p['status']] ?? 'secondary' ?>">
                            <?= ucfirst(htmlspecialchars($p['status'])) ?>
                        </span>
                    </div>
                </div>
                <div class="part-footer">
                    <a href="index.php?p=detalhes&id=<?= $p['evento_id'] ?>" class="btn-small btn-info">Ver Evento</a>
                    <form action="../controller/ParticipacaoController.php?action=cancelar" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="hidden" name="evento_id" value="<?= $p['evento_id'] ?>">
                        <button type="submit" class="btn-small btn-danger" onclick="return confirm('Cancelar inscrição?')">Cancelar</button>
                    </form>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>