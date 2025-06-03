<link rel="stylesheet" href="/css/anexo.css">

<div class="data-container">
    <h1>Nuevo Anexo</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="/anexo/create" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="txtFecha">Fecha:</label>
            <input type="date" name="txtFecha" id="txtFecha" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="procesoSelect">Seleccionar Proceso:</label>
            <select name="procesoId" id="procesoSelect" class="form-control" required>
                <option value="">Seleccione un Proceso</option>
                <?php foreach ($procesos as $proceso): ?>
                    <option value="<?= $proceso->idproceso; ?>"><?= htmlspecialchars($proceso->nombre); ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="fileAnexo">Archivo:</label>
            <input type="file" name="archivo" id="fileAnexo" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="/anexo/view" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
