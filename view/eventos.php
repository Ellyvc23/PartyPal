<section class="events-section">
    <div class="search-container">
        <h2>Explorar Eventos</h2>
        <form action="index.php" method="GET" class="search-form">
            <input type="hidden" name="p" value="eventos">
            <div class="search-input-wrapper">
                <input type="text" name="busca" placeholder="O que você está procurando?" class="search-input">
            </div>
            <div class="search-select-wrapper">
                <select name="categoria" class="search-select">
                    <option value="">Todas as Categorias</option>
                    <option value="1">Tecnologia</option>
                    <option value="2">Games</option>
                    <option value="3">Música</option>
                    <option value="4">Esportes</option>
                </select>
            </div>
            <button type="submit" class="search-btn">Filtrar</button>
        </form>
    </div>

    <div class="events-grid">
        <div class="event-card">
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1200&auto=format&fit=crop" alt="Evento">
            <div class="event-content">
                <h3>Show de Rock Ao Vivo</h3>
                <p>📍 Rio de Janeiro - RJ</p>
                <p>🕒 Sex, 31 de Maio às 20:00</p>
                <a href="index.php?p=detalhes_evento&id=1" class="view-details-btn">Ver Detalhes</a>
            </div>
        </div>
    </div>
</section>