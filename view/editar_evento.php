<section class="form-container-section">
    <div class="form-box">
        <h2>Editar Evento</h2>
        <form action="index.php?p=atualizar_evento" method="POST">
            <input type="hidden" name="csrf_token" value="token_csrf_aqui">
            <input type="hidden" name="id" value="1">
            <div class="form-group">
                <label class="form-label">Título do Evento</label>
                <input type="text" name="titulo" value="Show de Rock Ao Vivo" class="form-input" required>
            </div>
            <div class="form-row">
                <div class="form-col">
                    <label class="form-label">Categoria</label>
                    <select name="categoria_id" class="form-input" style="height: 50px;" required>
                        <option value="1">Tecnologia</option>
                        <option value="2">Games</option>
                        <option value="3" selected>Música</option>
                        <option value="4">Esportes</option>
                    </select>
                </div>
                <div class="form-col">
                    <label class="form-label">Localização</label>
                    <input type="text" name="localizacao" value="Rio de Janeiro - RJ" class="form-input" required>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Descrição Completa</label>
                <textarea name="descricao" rows="5" class="form-textarea" required>Venha curtir a maior noite de rock clássico do ano com bandas locais e convidados especiais!</textarea>
            </div>
            <button type="submit" class="form-submit-btn edit-mode">Salvar Alterações</button>
        </form>
    </div>
</section>