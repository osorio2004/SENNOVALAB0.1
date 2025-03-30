<div class="container">
    
    <form action="/clasiDoc/create" method="POST" class="form-container" enctype="multipart/form-data">
        <input type="hidden" name="id" id="randomId">
        
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" readonly>
        </div>

        <div class="form-group">
            <label for="version">Versión:</label>
            <input type="text" id="version" name="version" value="1.0" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre del Documento:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="elaborado_por">Elaborado por:</label>
            <input type="text" id="elaborado_por" name="elaborado_por" 
                   value="<?php echo $_SESSION['usuario'] ?? ''; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="revisado_por">Revisado por:</label>
            <input type="text" id="revisado_por" name="revisado_por" required>
        </div>

        <div class="form-group">
            <label for="aprobado_por">Aprobado por:</label>
            <input type="text" id="aprobado_por" name="aprobado_por" required>
        </div>

        <div class="form-group">
            <label for="proceso">Proceso:</label>
            <input type="text" id="proceso" name="proceso" required>
        </div>

        <div class="form-group">
            <label for="subproceso">Subproceso:</label>
            <input type="text" id="subproceso" name="subproceso" required>
        </div>

        <div class="form-group">
            <label for="clasificacion">Clasificación:</label>
            <select id="clasificacion" name="clasificacion" required>
                <option value="">Seleccione una clasificación</option>
                <option value="Gestion">Gestión</option>
                <option value="Administrativo">Administrativo</option>
                <option value="Personal">Personal</option>
                <option value="Financiero">Financiero</option>
                <option value="Legal">Legal</option>
                <option value="Tecnico">Técnico</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file">Archivo:</label>
            <input type="file" id="file" name="file" 
                   accept=".doc,.docx,.jpg,.jpeg,.png,.txt" required>
        </div>
        <div class="form-group">
            <label for="file">Observaciones:</label>
            <input type="text" id="observaciones" name="observaciones">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Guardar</button>
            <a href="/clasiDoc/view" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>

<script>
// Generar ID aleatorio
function generateRandomId() {
    return Math.floor(Math.random() * 1000000) + 1;
}

// Generar código aleatorio
function generateRandomCode() {
    const prefix = 'DOC';
    const randomNum = Math.floor(Math.random() * 10000).toString().padStart(4, '0');
    const date = new Date();
    const year = date.getFullYear().toString().substr(-2);
    return `${prefix}-${randomNum}-${year}`;
}

// Asignar valores al cargar la página
window.onload = function() {
    document.getElementById('randomId').value = generateRandomId();
    document.getElementById('codigo').value = generateRandomCode();
};
</script>