<div class="container">
    <h2>Nuevo Tipo de Documento</h2>
    
    <form action="/tipoDoc/create" method="post">
        <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" id="txtNombre" name="txtNombre" required>
        </div>
        
        <div class="form-group">
            <label for="txtDescripcion">Descripción:</label>
            <textarea id="txtDescripcion" name="txtDescripcion" rows="4"></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn-save">Guardar</button>
            <a href="/tipoDoc/view" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>