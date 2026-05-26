<section class="categorias-section">
    <div class="category-add-box">
        <h3>Adicionar Nova Categoria</h3>
        <form action="index.php?p=salvar_categoria" method="POST" class="category-form">
            <input type="hidden" name="csrf_token" value="token_csrf_aqui">
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
                <tr>
                    <td>1</td>
                    <td>Tecnologia</td>
                    <td style="text-align: center;">
                        <a href="index.php?p=deletar_categoria&id=1" onclick="return confirm('Deseja excluir esta categoria?')" class="action-delete">Excluir</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>