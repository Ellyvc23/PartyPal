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
        <div class="evento-card pink-glow">
            <div class="evento-card-image" style="background-image: url('https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=600&auto=format&fit=crop');">
                <span class="category-badge badge-pink">Festas & Shows</span>
            </div>
            <div class="evento-card-content">
                <h3>Neon Night Party 2026</h3>
                <p class="evento-description">A maior festa neon da região está de volta com open bar premium e line-up de DJs internacionais.</p>
                
                <div class="evento-meta-info">
                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <span>12 de Junho, 22:00</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">📍</span>
                        <span>Espaço VIP, Curitiba</span>
                    </div>
                </div>
                
                <div class="evento-card-footer">
                    <a href="index.php?p=detalhes" class="btn-view-details">Ver Detalhes</a>
                </div>
            </div>
        </div>

        <div class="evento-card cyan-glow">
            <div class="evento-card-image" style="background-image: url('https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=600&auto=format&fit=crop');">
                <span class="category-badge badge-cyan">Geek & Pop</span>
            </div>
            <div class="evento-card-content">
                <h3>PartyPal Games Championship</h3>
                <p class="evento-description">Traga seu setup ou console e participe do torneio regional de eSports com premiações em dinheiro.</p>
                
                <div class="evento-meta-info">
                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <span>20 de Junho, 14:00</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">📍</span>
                        <span>Arena Digital Hub</span>
                    </div>
                </div>
                
                <div class="evento-card-footer">
                    <a href="index.php?p=detalhes" class="btn-view-details">Ver Detalhes</a>
                </div>
            </div>
        </div>

        <div class="evento-card yellow-glow">
            <div class="evento-card-image" style="background-image: url('https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?q=80&w=600&auto=format&fit=crop');">
                <span class="category-badge badge-yellow">Cultura & Arte</span>
            </div>
            <div class="evento-card-content">
                <h3>Festival de Arte Urbana</h3>
                <p class="evento-description">Exposições de grafite ao vivo, batalhas de rima, dança de rua e workshops interativos de pintura.</p>
                
                <div class="evento-meta-info">
                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <span>28 de Junho, 10:00</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">📍</span>
                        <span>Praça Central</span>
                    </div>
                </div>
                
                <div class="evento-card-footer">
                    <a href="index.php?p=detalhes" class="btn-view-details">Ver Detalhes</a>
                </div>
            </div>
        </div>
    </div>
</section>