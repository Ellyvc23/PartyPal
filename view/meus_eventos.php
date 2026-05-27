<section class="meus-eventos-section">
    <div class="section-header">
        <h2>Meus Eventos Cadastrados</h2>
        <a href="index.php?p=criar" class="add-event-btn">+ Novo Evento</a>
    </div>
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Eventos</th>
                    <th>Data</th>
                    <th>Local</th>
                    <th style="text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($eventos)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: #bdbdbd;">Você ainda não criou nenhum evento.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($eventos as $evento): ?>
                        <tr>
                            <td style="font-weight: 600;"><?php echo htmlspecialchars($evento['titulo']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($evento['data_evento'])); ?></td>
                            <td><?php echo htmlspecialchars($evento['localizacao']); ?></td>
                            <td class="table-actions">
                                <a href="index.php?p=editar&id=<?php echo $evento['id']; ?>" class="action-edit">Editar</a>
                                <a href="index.php?p=deletar_evento&id=<?php echo $evento['id']; ?>" onclick="return confirm('Deseja excluir este evento?')" class="action-delete">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>