<div class="container">
    <h2>Detalles del Tipo de Documento</h2>
    
    <div class="detail-card">
        <div class="detail-item">
            <span class="label">ID:</span>
            <span class="value"><?php echo $tipoDoc->id_tipo_doc; ?></span>
        </div>
        
        <div class="detail-item">
            <span class="label">Nombre:</span>
            <span class="value"><?php echo $tipoDoc->nombre; ?></span>
        </div>
        
        <div class="detail-item">
            <span class="label">Descripción:</span>
            <span class="value"><?php echo $tipoDoc->descripcion; ?></span>
        </div>
    </div>
    
    <div class="detail-actions">
        <a href="/tipoDoc/edit/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-edit">Editar</a>
        <a href="/tipoDoc/view" class="btn-back">Volver a la lista</a>
    </div>
</div>