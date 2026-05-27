<section class="home-section">
    <div class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h2>
                    Encontre os melhores
                    <span class="pink">eventos</span>
                    e
                    <span class="yellow">experiências!</span>
                </h2>

                <p>
                    Participe, descubra e compartilhe momentos inesquecíveis.
                    Shows, festas, workshops e muito mais.
                </p>

                <div class="hero-buttons">
                    <a href="index.php?p=eventos" class="primary-btn" style="text-decoration: none; display: inline-block; text-align: center;">Ver eventos</a>
                    <a href="index.php?p=<?php echo isset($_SESSION['usuario_id']) ? 'criar' : 'login'; ?>" class="secondary-btn" style="text-decoration: none; display: inline-block; text-align: center;">Criar evento</a>
                </div>

                <div class="hero-info">
                    <div class="info-box">
                        <h3>🎉 Conecte-se</h3>
                        <p>com novas pessoas</p>
                    </div>

                    <div class="info-box">
                        <h3>📅 Descubra</h3>
                        <p>eventos incríveis</p>
                    </div>

                    <div class="info-box">
                        <h3>🔥 Participe</h3>
                        <p>e viva momentos únicos</p>
                    </div>
                </div>
            </div>

            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=1600&auto=format&fit=crop" alt="Evento">
            </div>
        </div>
    </div>

    <div class="featured-events">
        <div class="section-title">
            <h2>Eventos em destaque</h2>
            <a href="index.php?p=eventos">Ver todos</a>
        </div>

        <div class="events-grid">
            <?php if (empty($eventos)): ?>
                <p>Nenhum evento em destaque no momento.</p>
            <?php else: ?>
                <?php foreach ($eventos as $evento): ?>
                    <div class="event-card">
                        <img src="<?php echo htmlspecialchars($evento['imagem_url']); ?>" alt="Evento">
                        <div class="event-content">
                            <span class="event-date">
                                <?php echo date('d M', strtotime($evento['data_evento'])); ?>
                            </span>
                            <h3><?php echo htmlspecialchars($evento['titulo']); ?></h3>
                            <p>📍 <?php echo htmlspecialchars($evento['localizacao']); ?></p>
                            <p>🕒 <?php echo date('D, d \d\e F \à\s H:i', strtotime($evento['data_evento'])); ?></p>
                            <button><?php echo htmlspecialchars($evento['categoria_nome']); ?></button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>