<section class="event-details-section">
    <div class="event-details-flex">
        <div class="event-details-media">
            <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=1200&auto=format&fit=crop" alt="Evento">
        </div>
        <div class="event-details-info">
            <div>
                <span class="event-tag">MÚSICA</span>
                <h1>Show de Rock Ao Vivo</h1>
                <p class="event-detail-item">📍 <strong>Local:</strong> Rio de Janeiro - RJ</p>
                <p class="event-detail-item">📅 <strong>Data:</strong> Sex, 31 de Maio às 20:00</p>
                <p class="event-detail-item">👤 <strong>Organizador:</strong> Nome do Usuário</p>
                <p class="event-description">Venha curtir a maior noite de rock clássico do ano com bandas locais e convidados especiais!</p>
            </div>
            <div class="presence-box">
                <form action="index.php?p=participar" method="POST" class="presence-form">
                    <input type="hidden" name="csrf_token" value="token_csrf_aqui">
                    <input type="hidden" name="evento_id" value="1">
                    <select name="status" class="presence-select">
                        <option value="Confirmado">Confirmado</option>
                        <option value="Interessado">Interessado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                    <button type="submit" class="presence-btn">Confirmar Presença</button>
                </form>
            </div>
        </div>
    </div>

    <div class="participants-box">
        <h3>Quem vai participar (Listagem do Criador)</h3>
        <ul class="participants-list">
            <li class="participant-item">🤘 João Silva (Confirmado)</li>
            <li class="participant-item">⭐ Maria Souza (Interessado)</li>
        </ul>
    </div>

    <div class="comments-container">
        <h3>Comentários da Comunidade</h3>
        <form action="index.php?p=comentar" method="POST" class="comment-form">
            <input type="hidden" name="csrf_token" value="token_csrf_aqui">
            <input type="hidden" name="evento_id" value="1">
            <div style="margin-bottom: 15px;">
                <textarea name="comentario" rows="3" placeholder="Escreva algo sobre este evento..." class="comment-textarea" required></textarea>
            </div>
            <button type="submit" class="comment-submit-btn">Enviar Comentário</button>
        </form>

        <div class="comments-list">
            <div class="comment-card">
                <div class="comment-header">
                    <strong class="comment-author">Carlos Eduardo</strong>
                    <span class="comment-date">25/05/2026 às 21:30</span>
                </div>
                <p class="comment-text">Mal posso esperar por essa noite, o line-up está incrível!</p>
                <div class="comment-actions">
                    <a href="#" class="comment-edit">Editar</a>
                    <a href="#" class="comment-delete">Excluir</a>
                </div>
            </div>
        </div>
    </div>
</section>