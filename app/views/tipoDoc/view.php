<?php if(isset($tiposDocs) && is_array($tiposDocs)): ?>

<div class="container">
    <div class="options-bar">
        <a href="/tipoDoc/new" class="btn-new">Nuevo Tipo de Documento</a>
    </div>
    
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($tiposDocs as $tipoDoc): ?>
            <tr>
                <td><?php echo $tipoDoc->id_tipo_doc; ?></td>
                <td><?php echo $tipoDoc->nombre; ?></td>
                <td><?php echo $tipoDoc->descripcion; ?></td>
                <td class="actions">
                    <a href="/tipoDoc/view/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-view" title="Ver">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="/tipoDoc/edit/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-edit" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="/tipoDoc/delete/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-delete" title="Eliminar" 
                       onclick="return confirm('¿Está seguro de eliminar este registro?')">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php else: ?>
    <div class="message">
        <p>No hay tipos de documentos disponibles. <a href="/tipoDoc/new">Crear nuevo</a></p>
    </div>
<?php endif; ?>