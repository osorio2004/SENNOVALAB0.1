<div class="container">
    <h1>Eliminar Anexo</h1>

    <div class="alert alert-danger">
        <p>¿Estás seguro que deseas eliminar el anexo <strong><?= htmlspecialchars($anexo->nombre); ?></strong>?</p>
        <p><strong>Fecha:</strong> <?= $anexo->fecha; ?></p>
        <p><strong>Archivo:</strong> <a href="uploads/<?= $anexo->ruta_archivo; ?>" target="_blank">Ver Archivo</a></p>

        <form action="anexo/remove" method="POST">
            <input type="hidden" name="txtId" value="<?= $anexo->idAnexo; ?>">
            <button type="submit" class="btn btn-danger">Sí, eliminar</button>
            <a href="anexo/view" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>