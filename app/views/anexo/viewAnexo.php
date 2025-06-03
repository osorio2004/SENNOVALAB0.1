<link rel="stylesheet" href="/css/anexo.css">
<div class="data-container">
    <h1 class="title">Listado de Anexos</h1>
    <div class="actions">
        <div class="back-anex">
            <a href="/tipoDoc/view"><img src="/img/back.svg"></a>
        </div>
        <div class="create-anex">
            <a href="/anexo/new" class="btn btn-primary mb-3">+</a>
        </div>
    </div>
    <?php if (!empty($anexos)) : ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Sigla Proceso</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anexos as $anexo) : ?>
                    <tr>
                        <td><?= $anexo->idAnexo; ?></td>
                        <td><?= htmlspecialchars($anexo->nombre); ?></td>
                        <td><?= $anexo->fecha; ?></td>
                        <td><?= htmlspecialchars($procesoMap[$anexo->proceso_id] ?? 'N/A'); ?></td>
                        <td>
                            <a href="/anexo/view/<?= $anexo->idAnexo; ?>" class="btn btn-sm btn-info">Ver Detalle</a>
                        </td>
                        <td>
                            <a href="/anexo/edit/<?= $anexo->idAnexo; ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="/anexo/delete/<?= $anexo->idAnexo; ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay anexos registrados.</p>
    <?php endif; ?>
</div>