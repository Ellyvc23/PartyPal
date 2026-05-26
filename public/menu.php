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
    <a href="./?p=gerenciar">Categorias</a>
    <a href="./?p=sobre">Sobre</a>
    <a href="./?p=contato">Contato</a>
</div>

<div class="buttons-header">
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <div class="user-menu-container">
            <button class="user-menu-btn" onclick="toggleUserMenu()">
                <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?> ▾
            </button>
            <div id="userDropdown" class="user-dropdown-menu">
                <a href="index.php?p=dashboard">Dashboard</a>
                <a href="index.php?p=meusEventos">Meus Eventos</a>
                <a href="index.php?p=logout" class="logout-link">Sair</a>
            </div>
        </div>
    <?php else: ?>
        <a href="index.php?p=login" class="btn-login" style="text-decoration: none; display: inline-block;">Entrar</a>
        <a href="index.php?p=login" class="btn-register" style="text-decoration: none; display: inline-block;">Cadastrar</a>
    <?php endif; ?>
</div>

<script>
function toggleUserMenu() {
    const dropdown = document.getElementById('userDropdown');
    dropdown.classList.toggle('show');
}

window.onclick = function(event) {
    if (!event.target.matches('.user-menu-btn')) {
        const dropdowns = document.getElementsByClassName("user-dropdown-menu");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>