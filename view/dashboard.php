<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?p=login");
    exit;
}

require_once(__DIR__ . '/../controller/DashboardController.php');

$dashController      = new App\Controller\DashboardController();
$metricas            = $dashController->getMetricas((int)$_SESSION['usuario_id']);
$minhasParticipacoes = $dashController->getMinhasParticipacoes((int)$_SESSION['usuario_id']);
?>

<section class="dashboard-section">
    <aside class="dashboard-sidebar">
        <h3>Visão Geral</h3>
        <div class="metrics-list">
            <div class="metric-card m1">
                <span>Eventos na Plataforma</span>
                <h4><?php echo $metricas['total_eventos']; ?></h4>
            </div>
            <div class="metric-card m2">
                <span>Eventos que Criei</span>
                <h4><?php echo $metricas['meus_eventos']; ?></h4>
            </div>
            <div class="metric-card m3">
                <span>Total de Participantes</span>
                <h4><?php echo $metricas['total_participantes']; ?></h4>
            </div>
            <div class="metric-card m4">
                <span>Comentários Recebidos</span>
                <h4><?php echo $metricas['total_comentarios']; ?></h4>
            </div>
        </div>
    </aside>

    <main class="dashboard-content">

        <?php if (isset($_SESSION['sucesso'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['sucesso']); unset($_SESSION['sucesso']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['erro'])): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['erro']); unset($_SESSION['erro']); ?></div>
        <?php endif; ?>

        <div class="dashboard-card">
            <h2>Eventos que vou participar</h2>
            <div class="participation-list">
                <?php if (empty($minhasParticipacoes)): ?>
                    <p style="color:#888; text-align:center; padding: 30px 0;">Você ainda não se inscreveu em nenhum evento. <a href="index.php?p=eventos" style="color:#e255ff;">Explorar eventos</a></p>
                <?php else: ?>
                    <?php foreach ($minhasParticipacoes as $p): ?>
                        <div class="participation-card">
                            <div class="participation-info">
                                <h4><?php echo htmlspecialchars($p['titulo']); ?></h4>
                                <p>🕒 <?php echo date('d \d\e F \à\s H:i', strtotime($p['data_evento'])); ?> | 📍 <?php echo htmlspecialchars($p['localizacao']); ?> | Status: <span class="participation-status"><?php echo ucfirst(htmlspecialchars($p['status'])); ?></span></p>
                            </div>
                            <a href="index.php?p=detalhes&id=<?php echo $p['id']; ?>" class="participation-link">Acessar Página</a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </main>
</section>
