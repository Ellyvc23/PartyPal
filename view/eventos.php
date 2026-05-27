<section class="eventos-page-container">
    <div class="eventos-search-header">
        <h2 class="section-title">Explore os Melhores <span class="gradient-text">Rolês</span></h2>
        <p class="section-subtitle">Encontre festas, shows, workshops e muito mais acontecendo perto de você.</p>
        
        <form class="search-filter-form" method="GET" action="index.php">
            <input type="hidden" name="p" value="eventos">
            
            <div class="search-input-wrapper">
                <span class="search-icon">🔍</span>
                <input type="text" name="busca" placeholder="Buscar por nome do evento..." value="<?php echo isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : ''; ?>">
            </div>
            
            <div class="select-wrapper">
                <select name="categoria">
                    <option value="">Todas as Categorias</option>
                    <option value="1">Festas & Shows</option>
                    <option value="2">Geek & Cultura Pop</option>
                    <option value="3">Esportes</option>
                    <option value="4">Acadêmico</option>
                </select>
            </div>
            
            <button type="submit" class="btn-search-submit">Filtrar</button>
        </form>
    </div>

    <div class="eventos-grid">
    <?php if (empty($eventos)): ?>
        <p style="color: #bdbdbd;">Nenhum evento encontrado.</p>
    <?php else: ?>
        <?php foreach ($eventos as $evento): ?>
            <div class="evento-card">
                <div class="evento-card-image" style="background-image: url('<?php echo htmlspecialchars($evento['imagem_url']); ?>');">
                    <span class="category-badge"><?php echo htmlspecialchars($evento['categoria_nome']); ?></span>
                </div>
                <div class="evento-card-content">
                    <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
                    <p class="evento-description"><?php echo htmlspecialchars($evento['descricao']); ?></p>

                    <div class="evento-meta-info">
                        <div class="meta-item">
                            <span class="meta-icon">📅</span>
                            <span><?php echo date('d \d\e F, H:i', strtotime($evento['data_evento'])); ?></span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-icon">📍</span>
                            <span><?php echo htmlspecialchars($evento['localizacao']); ?></span>
                        </div>
                    </div>

                    <div class="evento-card-footer">
                        <a href="index.php?p=detalhes&id=<?php echo $evento['id']; ?>" class="btn-view-details">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</section>