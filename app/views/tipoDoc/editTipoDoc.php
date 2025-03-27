<div class="container">
    <h2>Editar Tipo de Documento</h2>
    
    <form action="/tipoDoc/update" method="post">
        <input type="hidden" name="txtId" value="<?php echo $tipoDoc->id_tipo_doc; ?>">
        
        <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" id="txtNombre" name="txtNombre" value="<?php echo $tipoDoc->nombre; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="txtDescripcion">Descripción:</label>
            <textarea id="txtDescripcion" name="txtDescripcion" rows="4"><?php echo $tipoDoc->descripcion; ?></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-save">Actualizar</button>
            <a href="/tipoDoc/view" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>