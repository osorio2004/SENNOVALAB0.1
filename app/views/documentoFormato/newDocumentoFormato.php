<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documentoFormato/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/documentoFormato/create" method="post">
            <div class="form-group">
                <label for="">Código:</label>
                <input type="text" name="txtCodigo" id="txtCodigo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Tipo:</label>
                <input type="text" name="txtTipo" id="txtTipo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Tipo Documento Formato:</label>
                <input type="text" name="txtTipoDocFormato" id="txtTipoDocFormato" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Proceso:</label>
                <select name="txtFkProceso" id="txtFkProceso" class="form-control" required>
                    <option value="">-- Selecciona un proceso --</option>
                    <?php foreach($procesos as $proceso): ?>
                        <option value="<?php echo $proceso->idproceso; ?>"><?php echo $proceso->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tipo Documental:</label>
                <select name="txtFkTipoDocumental" id="txtFkTipoDocumental" class="form-control" required>
                    <option value="">-- Selecciona un tipo documental --</option>
                    <?php foreach($tiposDocumentales as $tipoDocumental): ?>
                        <option value="<?php echo $tipoDocumental->idTipoDocumental; ?>"><?php echo $tipoDocumental->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>