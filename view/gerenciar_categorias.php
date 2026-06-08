<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?p=login");
    exit;
}

require_once(__DIR__ . '/../controller/CategoriaController.php');

$catController = new App\Controller\CategoriaController();
$categorias    = $catController->listar();
?>

<section class="categorias-section">

    <?php if (isset($_SESSION['sucesso'])): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['sucesso']); unset($_SESSION['sucesso']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($_SESSION['erro']); unset($_SESSION['erro']); ?></div>
    <?php endif; ?>

    <div class="category-add-box">
        <h3>Adicionar Nova Categoria</h3>
        <form action="index.php?p=salvar_categoria" method="POST" class="category-form">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="text" name="nome_categoria" placeholder="Nome da Categoria (Ex: Teatro)" class="category-input" required>
            <button type="submit" class="category-submit-btn">Cadastrar</button>
        </form>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Categoria</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categorias)): ?>
                    <tr>
                        <td colspan="3" style="text-align:center; color:#888; padding: 20px;">Nenhuma categoria cadastrada.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($categorias as $cat): ?>
                        <tr>
                            <td><?php echo $cat['id']; ?></td>
                            <td><?php echo htmlspecialchars($cat['nome']); ?></td>
                            <td style="text-align: center;">
                                <a href="index.php?p=editar_categoria&id=<?php echo $cat['id']; ?>" class="action-edit" style="color: #00f0ff; text-decoration: none; font-size: 13px; font-weight: 600; margin-right: 15px; border: 1px solid #00f0ff44; padding: 6px 16px; border-radius: 8px; background: #00f0ff11;">Editar</a>
                                <a href="index.php?p=deletar_categoria&id=<?php echo $cat['id']; ?>"
                                onclick="return confirm('Deseja excluir esta categoria? Categorias com eventos não podem ser removidas.')"
                                class="action-delete">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>