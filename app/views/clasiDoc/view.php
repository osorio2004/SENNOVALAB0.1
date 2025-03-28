<div class="container">
    <div class="header-container">
        Lista de Clasificación de Documentos
    </div>
    
    <div class="options-bar">
        <a href="/clasiDoc/new" class="btn-new">Nueva Clasificación</a>
    </div>
    
    <?php if(isset($clasiDocs) && is_array($clasiDocs)): ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Creó</th>
                <th>Código</th>
                <th>Versión</th>
                <th>Nombre</th>
                <th>Elaborado Por</th>
                <th>Revisado Por</th>
                <th>Aprobado Por</th>
                <th>Proceso</th>
                <th>Subproceso</th>
                <th>Última Fecha Revisión</th>
                <th>Clasificación</th>
                <th>Fecha Subido</th>
                <th>Aprobación</th>
                <th>Editar</th>
                <th>Retención</th>
                <th>Documento Fuente</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clasiDocs as $clasiDoc): ?>
            <tr>
                <td><?php echo htmlspecialchars($documento->id ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->creo ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->codigo ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->version ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->nombre ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->elaborado_por ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->revisado_por ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->aprobado_por ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->proceso ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->subproceso ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->ultima_fecha_revision ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->clasificacion ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->fecha_subido ?? ''); ?></td>
                <td><?php echo htmlspecialchars($documento->aprobacion ?? ''); ?></td>
                <td>
                    <a href="/clasiDoc/edit/<?php echo $clasiDoc->id; ?>" class="btn-edit">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td><?php echo htmlspecialchars($clasiDoc->retencion ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->documento_fuente ?? ''); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="message">
        <p>No hay clasificaciones disponibles. <a href="/clasiDoc/new">Crear nueva</a></p>
    </div>
    <?php endif; ?>
</div>