
<section class="form-container-section">
    <div class="form-box">
        <h2>Criar Novo Evento</h2>
        <form action="index.php?p=salvar_evento" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="form-group">
                <label class="form-label">Título do Evento</label>
                <input type="text" name="titulo" placeholder="Ex: Workshop de PHP MVC" class="form-input" required>
            </div>
            <div class="form-row">
                <div class="form-col">
                    <label class="form-label">Categoria</label>
                    <select name="categoria_id" class="form-input" style="height: 50px;" required>
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>">
                                <?php echo htmlspecialchars($cat['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-col">
                    <label class="form-label">Localização (Cidade/UF ou Online)</label>
                    <input type="text" name="localizacao" placeholder="Ex: Curitiba - PR" class="form-input" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-col">
                    <label class="form-label">Data e Horário</label>
                    <input type="datetime-local" name="data_evento" class="form-input" style="height: 50px;" required>
                </div>
                <div class="form-col">
                    <label class="form-label">Banner / Imagem (URL)</label>
                    <input type="text" name="imagem_url" placeholder="URL da imagem" class="form-input">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Descrição Completa</label>
                <textarea name="descricao" rows="5" placeholder="Detalhes sobre as atrações..." class="form-textarea" required></textarea>
            </div>
            <button type="submit" class="form-submit-btn">Publicar Evento</button>
        </form>
    </div>
</section>