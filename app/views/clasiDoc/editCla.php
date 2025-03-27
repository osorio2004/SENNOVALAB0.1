<div class="form-container">
    <form action="/clasiDoc/update" method="POST" class="form">
        <input type="hidden" name="txtId" value="<?php echo $clasiDoc->id; ?>">
        
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" value="<?php echo $clasiDoc->codigo; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="version">Versión:</label>
            <input type="text" id="version" name="version" value="<?php echo $clasiDoc->version; ?>" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $clasiDoc->nombre; ?>" required>
        </div>

        <div class="form-group">
            <label for="proceso">Proceso:</label>
            <input type="text" id="proceso" name="proceso" value="<?php echo $clasiDoc->proceso; ?>" required>
        </div>

        <div class="form-group">
            <label for="subproceso">Subproceso:</label>
            <input type="text" id="subproceso" name="subproceso" value="<?php echo $clasiDoc->subproceso; ?>" required>
        </div>

        <div class="form-group">
            <label for="clasificacion">Clasificación:</label>
            <select id="clasificacion" name="clasificacion" required>
                <option value="">Seleccione una clasificación</option>
                <option value="Gestión" <?php echo ($clasiDoc->clasificacion == 'Gestión') ? 'selected' : ''; ?>>Gestión</option>
                <option value="Administrativo" <?php echo ($clasiDoc->clasificacion == 'Administrativo') ? 'selected' : ''; ?>>Administrativo</option>
                <option value="Personal" <?php echo ($clasiDoc->clasificacion == 'Personal') ? 'selected' : ''; ?>>Personal</option>
                <option value="Financiero" <?php echo ($clasiDoc->clasificacion == 'Financiero') ? 'selected' : ''; ?>>Financiero</option>
                <option value="Legal" <?php echo ($clasiDoc->clasificacion == 'Legal') ? 'selected' : ''; ?>>Legal</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Actualizar</button>
            <a href="/clasiDoc/view" class="btn-cancel">Cancelar</a>
        </div>
    </form>
</div>