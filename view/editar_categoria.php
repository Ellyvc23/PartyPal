<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?p=login");
    exit;
}
if (!isset($categoria_editar) || !$categoria_editar) {
    echo "<h2 style='color: white; text-align: center; margin-top: 50px;'>Categoria não encontrada.</h2>";
    exit;
}
?>

<section class="categorias-section">
    <div class="category-add-box" style="max-width: 600px; margin: 0 auto;">
        <h3>Editar Categoria</h3>
        <form action="index.php?p=atualizar_categoria" method="POST" class="category-form" style="flex-direction: column;">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="id" value="<?php echo $categoria_editar['id']; ?>">
            
            <input type="text" name="nome_categoria" value="<?php echo htmlspecialchars($categoria_editar['nome']); ?>" class="category-input" required style="margin-bottom: 20px;">
            
            <div style="display: flex; gap: 15px;">
                <button type="submit" class="category-submit-btn" style="flex: 1; padding: 14px;">Salvar Alterações</button>
                <a href="index.php?p=gerenciar" style="flex: 1; text-align: center; padding: 14px; background: #242424; color: white; text-decoration: none; border-radius: 12px; border: 1px solid #3a3a3a; font-family: 'Poppins', sans-serif; font-weight: 600;">Cancelar</a>
            </div>
        </form>
    </div>
</section>