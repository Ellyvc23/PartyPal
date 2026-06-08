<div class="logo">
    <div class="logo-icon">🤘</div>
    <div>
        <h1>PARTYPAL</h1>
        <p>O seu rolê começa aqui.</p>
    </div>
</div>

<div class="nav-links">
    <a href="./?p=home">Home</a>
    <a href="./?p=eventos">Eventos</a>
    <a href="./?p=sobre">Sobre</a>
    <a href="./?p=contato">Contato</a>
</div>

<div class="buttons-header">
    <?php if (isset($_SESSION['usuario_id'])): ?>

        <!-- Painel rápido de métricas -->
        <?php
            require_once(__DIR__ . '/../controller/DashboardController.php');
            $_menuDash    = new App\Controller\DashboardController();
            $_menuMetrics = $_menuDash->getMetricas((int)$_SESSION['usuario_id']);
        ?>
        <div class="metrics-popup-container">
            <button class="metrics-popup-btn" onclick="toggleMetricsPanel()" title="Visão Geral">
                🔔
                <span class="metrics-badge"><?php echo $_menuMetrics['meus_eventos']; ?></span>
            </button>
            <div id="metricsPanel" class="metrics-popup-panel">
                <div class="metrics-popup-header">Visão Geral</div>
                <div class="metrics-popup-item">
                    <span class="mpi-icon">🎉</span>
                    <span class="mpi-label">Eventos na Plataforma</span>
                    <span class="mpi-value"><?php echo $_menuMetrics['total_eventos']; ?></span>
                </div>
                <div class="metrics-popup-item">
                    <span class="mpi-icon">✏️</span>
                    <span class="mpi-label">Eventos que Criei</span>
                    <span class="mpi-value"><?php echo $_menuMetrics['meus_eventos']; ?></span>
                </div>
                <div class="metrics-popup-item">
                    <span class="mpi-icon">👥</span>
                    <span class="mpi-label">Total de Participantes</span>
                    <span class="mpi-value"><?php echo $_menuMetrics['total_participantes']; ?></span>
                </div>
                <a href="index.php?p=dashboard" class="metrics-popup-link">Ver Dashboard completo →</a>
            </div>
        </div>

        <!-- Menu do usuário -->
        <div class="user-menu-container">
            <button class="user-menu-btn" onclick="toggleUserMenu()">
                <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?> ▾
            </button>
            <div id="userDropdown" class="user-dropdown-menu">
                <a href="index.php?p=dashboard">Dashboard</a>
                <a href="index.php?p=meusEventos">Meus Eventos</a>
                <a href="index.php?p=gerenciar">Categorias</a>
                <a href="index.php?p=participacoes">Participações</a>
                <a href="index.php?p=logout" class="logout-link">Sair</a>
            </div>
        </div>

    <?php else: ?>
        <a href="index.php?p=login&action=login" class="btn-login" style="text-decoration: none; display: inline-block;">Entrar</a>
        <a href="index.php?p=login&action=cadastro" class="btn-register" style="text-decoration: none; display: inline-block;">Cadastrar</a>
    <?php endif; ?>
</div>

<script>
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
    document.getElementById('metricsPanel')?.classList.remove('show');
}

function toggleMetricsPanel() {
    const panel = document.getElementById('metricsPanel');
    panel.classList.toggle('show');
    document.getElementById('userDropdown')?.classList.remove('show');
}

window.onclick = function(event) {
    if (!event.target.closest('.user-menu-container')) {
        document.getElementById('userDropdown')?.classList.remove('show');
    }
    if (!event.target.closest('.metrics-popup-container')) {
        document.getElementById('metricsPanel')?.classList.remove('show');
    }
}
</script>
