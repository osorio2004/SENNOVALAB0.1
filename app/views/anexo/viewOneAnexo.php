<link rel="stylesheet" href="/css/anexo.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.css">

<div class="data-container">
    <h1>Detalle del Anexo</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($anexo->nombre); ?></h5>
            <p class="card-text"><strong>ID:</strong> <?= $anexo->idAnexo; ?></p>
            <p class="card-text"><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($anexo->fecha)); ?></p>
            <p class="card-text"><strong>Proceso:</strong> <?= htmlspecialchars($procesoMap[$anexo->proceso_id] ?? 'N/A'); ?></p>

            <button type="button" class="btn" id="viewDocumentBtn">
                Ver Documento
            </button>

            <a href="/anexo/edit/<?= $anexo->idAnexo; ?>" class="btn">Editar</a>
            <a href="/anexo/delete/<?= $anexo->idAnexo; ?>" class="btn">Eliminar</a>
            <a href="/anexo/view" class="btn">Volver al Listado</a>
        </div>
    </div>
</div>

<!-- Modal para visualización del documento -->
<div class="modal" id="documentModal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?= htmlspecialchars($anexo->nombre); ?></h5>
            <button type="button" class="close-btn">&times;</button>
        </div>
        <div class="modal-body">
            <?php
            $rutaArchivo = $anexo->ruta_archivo;
            $extension = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));

            $esUrlSupabase = strpos($rutaArchivo, 'supabase.co') !== false;
            $urlVisualizacion = $esUrlSupabase ? $rutaArchivo : "/uploads/" . $rutaArchivo;
            ?>

            <div class="document-preview-container">
                <?php if (in_array($extension, ['pdf'])): ?>
                    <iframe src="<?= $urlVisualizacion ?>" width="100%" height="600px" style="border: none;"></iframe>

                <?php elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                    <img src="<?= $urlVisualizacion ?>" alt="Vista previa del documento" class="img-preview" id="imagePreview">

                <?php elseif (in_array($extension, ['doc', 'docx', 'xls', 'xlsx'])): ?>
                    <div class="office-document-viewer">
                        <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?= urlencode($urlVisualizacion) ?>"
                            width="100%" height="600px" style="border: none;"></iframe>
                    </div>

                <?php else: ?>
                    <div class="alert">
                        <p>No hay vista previa disponible para este tipo de archivo.</p>
                        <a href="<?= $urlVisualizacion ?>" target="_blank" class="btn">
                            Descargar Archivo
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal-footer">
            <a href="<?= $urlVisualizacion ?>" download class="btn">
                Descargar
            </a>
            <button type="button" class="btn close-modal-btn">Cerrar</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Control del modal
        const modal = document.getElementById('documentModal');
        const viewBtn = document.getElementById('viewDocumentBtn');
        const closeBtns = document.querySelectorAll('.close-btn, .close-modal-btn');

        viewBtn.addEventListener('click', () => {
            modal.style.display = 'block';
        });

        closeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                modal.style.display = 'none';

                // Reiniciar iframes al cerrar el modal
                const iframes = modal.querySelectorAll('iframe');
                iframes.forEach(iframe => {
                    iframe.src = iframe.src;
                });
            });
        });

        // Cerrar modal al hacer clic fuera del contenido
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>