<section class="form-container-section">
    <div class="form-box">
        <h2>Editar Evento</h2>
        <?php if (!$evento): ?>
            <p style="color: #bdbdbd;">Evento não encontrado.</p>
        <?php else: ?>
        <form action="index.php?p=atualizar_evento" method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
            <div class="form-group">
                <label class="form-label">Título do Evento</label>
                <input type="text" name="titulo" value="<?php echo htmlspecialchars($evento['titulo']); ?>" class="form-input" required>
            </div>
            <div class="form-row">
                <div class="form-col">
                    <label class="form-label">Categoria</label>
                    <select name="categoria_id" class="form-input" style="height: 50px;" required>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>" <?php echo $evento['categoria_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-col">
                    <label class="form-label">Localização</label>
                    <input type="text" name="localizacao" value="<?php echo htmlspecialchars($evento['localizacao']); ?>" class="form-input" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-col">
                    <label class="form-label">Data e Horário</label>
                    <input type="datetime-local" name="data_evento" value="<?php echo date('Y-m-d\TH:i', strtotime($evento['data_evento'])); ?>" class="form-input" style="height: 50px;" required>
                </div>
                <div class="form-col">
                    <label class="form-label">Banner / Imagem (URL)</label>
                    <input type="text" name="imagem_url" value="<?php echo htmlspecialchars($evento['imagem_url']); ?>" class="form-input">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Descrição Completa</label>
                <textarea name="descricao" rows="5" class="form-textarea" required><?php echo htmlspecialchars($evento['descricao']); ?></textarea>
            </div>
            <button type="submit" class="form-submit-btn edit-mode">Salvar Alterações</button>
        </form>
        <?php endif; ?>
    </div>
</section>