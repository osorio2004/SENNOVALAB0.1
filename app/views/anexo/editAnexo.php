<div class="container">
    <h1>Editar Anexo</h1>

    <form action="/anexo/update" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="txtId" value="<?= $anexo->idAnexo; ?>">

        <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" name="txtNombre" id="txtNombre" class="form-control" value="<?= htmlspecialchars($anexo->nombre); ?>" required>
        </div>

        <div class="form-group">
            <label for="txtFecha">Fecha:</label>
            <input type="date" name="txtFecha" id="txtFecha" class="form-control" value="<?= $anexo->fecha; ?>" required>
        </div>

        <div class="form-group">
            <label>Archivo Actual:</label><br>
            <a href="/uploads/<?= $anexo->ruta_archivo; ?>" target="_blank">Ver Archivo</a>
        </div>

        <div class="form-group">
            <label for="fileAnexo">Cambiar Archivo (opcional):</label>
            <input type="file" name="archivo" id="fileAnexo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="/anexo/view" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>