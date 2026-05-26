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
                <tr>
                    <td style="font-weight: 600;">Show de Rock Ao Vivo</td>
                    <td>31/05/2026</td>
                    <td>Rio de Janeiro - RJ</td>
                    <td class="table-actions">
                        <a href="index.php?p=editar&id=1" class="action-edit">Editar</a>
                        <a href="index.php?p=deletar_evento&id=1" onclick="return confirm('Deseja excluir este evento?')" class="action-delete">Excluir</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>