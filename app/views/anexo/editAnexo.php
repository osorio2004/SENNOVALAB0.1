<link rel="stylesheet" href="/css/anexo.css">

<div class="data-container">
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
            <?php
            $rutaArchivo = $anexo->ruta_archivo;

            // Quitar prefijo duplicado si existe
            if (str_starts_with($rutaArchivo, 'uploads/')) {
                $rutaArchivo = substr($rutaArchivo, strlen('uploads/'));
            }

            $urlArchivo = (str_starts_with($rutaArchivo, 'http'))
                ? $rutaArchivo
                : "/uploads/" . $rutaArchivo;

            $extension = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
            ?>

            <?php if ($extension === 'pdf'): ?>
                <iframe src="<?= $urlArchivo ?>" width="400px" height="400px" style="border: 1px solid #ccc;"></iframe>

            <?php elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                <img src="<?= $urlArchivo ?>" alt="Vista previa del archivo" style="max-width: 400px; height: 400px; border: 1px solid #ccc;">

            <?php elseif (in_array($extension, ['doc', 'docx', 'xls', 'xlsx'])): ?>
                <p>
                    <strong>Tipo de archivo:</strong> <?= strtoupper($extension) ?><br>
                    <a href="<?= $urlArchivo ?>" target="_blank" class="btn btn-sm btn-info mt-2">Abrir o Descargar</a>
                </p>

            <?php else: ?>
                <a href="<?= $urlArchivo ?>" target="_blank">Ver Archivo</a>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="fileAnexo">Cambiar Archivo (opcional):</label>
            <input type="file" name="archivo" id="fileAnexo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
        <a href="/anexo/view" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
