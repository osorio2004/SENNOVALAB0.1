<link rel="stylesheet" href="/css/anexo.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.css">

<div class="data-container">
    <h1>Detalle del Anexo</h1>
    
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($anexo->nombre); ?></h5>
            <p class="card-text"><strong>ID:</strong> <?= $anexo->idAnexo; ?></p>
            <p class="card-text"><strong>Fecha:</strong> <?= date('d/m/Y', strtotime($anexo->fecha)); ?></p>
            <p class="card-text"><strong>Proceso:</strong> <?= htmlspecialchars($procesoMap[$anexo->proceso_id] ?? 'N/A'); ?></p>
            
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#documentModal">
                Ver Documento
            </button>
            
            <a href="/anexo/edit/<?= $anexo->idAnexo; ?>" class="btn btn-warning">Editar</a>
            <a href="/anexo/delete/<?= $anexo->idAnexo; ?>" class="btn btn-danger">Eliminar</a>
            <a href="/anexo/view" class="btn btn-secondary">Volver al Listado</a>
        </div>
    </div>
</div>

<!-- Modal para visualización del documento -->
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel"><?= htmlspecialchars($anexo->nombre); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                $rutaArchivo = $anexo->ruta_archivo;
                $extension = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
                
                // Verificar si es una URL de Supabase o un archivo local
                $esUrlSupabase = strpos($rutaArchivo, 'supabase.co') !== false;
                $urlVisualizacion = $esUrlSupabase ? $rutaArchivo : "/uploads/" . $rutaArchivo;
                ?>
                
                <div class="document-preview-container">
                    <?php if (in_array($extension, ['pdf'])): ?>
                        <iframe src="<?= $urlVisualizacion ?>" width="100%" height="600px" style="border: none;"></iframe>
                    
                    <?php elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                        <img src="<?= $urlVisualizacion ?>" alt="Vista previa del documento" class="img-fluid" id="imagePreview">
                    
                    <?php elseif (in_array($extension, ['doc', 'docx', 'xls', 'xlsx'])): ?>
                        <div class="office-document-viewer">
                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src=<?= urlencode($urlVisualizacion) ?>" 
                                    width="100%" height="600px" style="border: none;"></iframe>
                        </div>
                    
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <p>No hay vista previa disponible para este tipo de archivo.</p>
                            <a href="<?= $urlVisualizacion ?>" target="_blank" class="btn btn-primary">
                                Descargar Archivo
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="modal-footer">
                <a href="<?= $urlVisualizacion ?>" download class="btn btn-success">
                    <i class="fas fa-download"></i> Descargar
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar viewer.js para imágenes
    const imageElement = document.getElementById('imagePreview');
    if (imageElement) {
        const viewer = new Viewer(imageElement, {
            inline: false,
            toolbar: {
                zoomIn: 1,
                zoomOut: 1,
                oneToOne: 1,
                reset: 1,
                prev: 1,
                play: 0,
                next: 1,
                rotateLeft: 1,
                rotateRight: 1,
                flipHorizontal: 1,
                flipVertical: 1,
            },
        });
        
        // Abrir el viewer automáticamente cuando se muestra el modal
        const modal = document.getElementById('documentModal');
        modal.addEventListener('shown.bs.modal', function () {
            if (imageElement) {
                viewer.show();
            }
        });
    }
    
    // Reiniciar iframes al cerrar el modal
    const modal = document.getElementById('documentModal');
    modal.addEventListener('hidden.bs.modal', function () {
        const iframes = modal.querySelectorAll('iframe');
        iframes.forEach(iframe => {
            iframe.src = iframe.src;
        });
    });
});
</script>