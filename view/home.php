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
            <div class="event-card">
                <img src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=1200&auto=format&fit=crop" alt="Evento">
                <div class="event-content">
                    <span class="event-date">24 MAI</span>
                    <h3>Festa Eletrônica Sunset</h3>
                    <p>📍 São Paulo - SP</p>
                    <p>🕒 Sáb, 24 de Maio às 22:00</p>
                    <button>Festa</button>
                </div>
            </div>

            <div class="event-card">
                <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1200&auto=format&fit=crop" alt="Evento">
                <div class="event-content">
                    <span class="event-date">31 MAI</span>
                    <h3>Show de Rock Ao Vivo</h3>
                    <p>📍 Rio de Janeiro - RJ</p>
                    <p>🕒 Sex, 31 de Maio às 20:00</p>
                    <button>Show</button>
                </div>
            </div>

            <div class="event-card">
                <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?q=80&w=1200&auto=format&fit=crop" alt="Evento">
                <div class="event-content">
                    <span class="event-date">07 JUN</span>
                    <h3>Workshop de Fotografia</h3>
                    <p>📍 Belo Horizonte - MG</p>
                    <p>🕒 Sex, 07 de Junho às 18:00</p>
                    <button>Workshop</button>
                </div>
            </div>
        </div>
    </div>
</section>