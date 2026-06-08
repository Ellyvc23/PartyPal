<section class="contato-section">
    <div class="contact-box">
        <h2>Fale Conosco</h2>
        <p class="contact-sub">Dúvidas, críticas ou sugestões? Envie uma mensagem para a nossa equipe.</p>
        
        <form onsubmit="alert('Mensagem enviada com sucesso! A nossa equipa entrará em contacto em breve.'); return false;">
            <div class="form-group">
                <label class="form-label">Seu Nome</label>
                <input type="text" name="nome" placeholder="Nome Completo" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">E-mail para Contato</label>
                <input type="email" name="email" placeholder="seu@email.com" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Mensagem</label>
                <textarea name="mensagem" rows="5" placeholder="Escreva sua mensagem aqui..." class="form-textarea" required></textarea>
            </div>

            <button type="submit" class="form-submit-btn">Enviar Mensagem</button>
        </form>
    </div>
</section>