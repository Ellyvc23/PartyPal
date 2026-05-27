<?php session_start(); ?>
<?php include 'menu.php'; ?>

<div class="container mt-4">
    <h2>📋 Minhas Participações</h2>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['sucesso']) ?></div>
    <?php elseif (isset($_GET['erro'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['erro']) ?></div>
    <?php endif; ?>

    <?php if (empty($participacoes)): ?>
        <p>Você ainda não está inscrito em nenhum evento.
           <a href="eventos.php">Ver eventos disponíveis</a>
        </p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($participacoes as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if (!empty($p['imagem'])): ?>
                        <img src="../public/<?= htmlspecialchars($p['imagem']) ?>"
                             class="card-img-top" alt="Imagem do evento">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($p['titulo']) ?></h5>
                        <p class="card-text">
                            📅 <?= date('d/m/Y', strtotime($p['data_evento'])) ?><br>
                            📍 <?= htmlspecialchars($p['local']) ?>
                        </p>

                        <?php
                        $badges = [
                            'confirmado' => 'success',
                            'pendente'   => 'warning',
                            'cancelado'  => 'danger',
                        ];
                        $cor = $badges[$p['status']] ?? 'secondary';
                        ?>
                        <span class="badge badge-<?= $cor ?>">
                            <?= ucfirst($p['status']) ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="detalhes_evento.php?id=<?= $p['evento_id'] ?>"
                           class="btn btn-sm btn-info">Ver Evento</a>

                        <form action="../controller/ParticipacaoController.php?action=cancelar"
                              method="POST" class="d-inline">
                            <input type="hidden" name="csrf_token"
                                   value="<?= $_SESSION['csrf_token'] ?>">
                            <input type="hidden" name="evento_id"
                                   value="<?= $p['evento_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Cancelar inscrição?')">
                                Cancelar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
