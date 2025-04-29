<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documentoFormato/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/documentoFormato/update" method="post">
            <div class="form-group">
                <label for="">ID:</label>
                <input type="text" readonly value="<?php echo $documentoFormato->idDocumentoFormato ?>" name="txtId" id="txtId" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Código:</label>
                <input type="text" value="<?php echo $documentoFormato->codigo ?>" name="txtCodigo" id="txtCodigo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Nombre:</label>
                <input type="text" value="<?php echo $documentoFormato->nombre ?>" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Tipo:</label>
                <input type="text" value="<?php echo $documentoFormato->tipo ?>" name="txtTipo" id="txtTipo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Tipo Documento Formato:</label>
                <input type="text" value="<?php echo $documentoFormato->tipo_doc_formato ?>" name="txtTipoDocFormato" id="txtTipoDocFormato" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Proceso:</label>
                <select name="txtFkProceso" id="txtFkProceso" class="form-control" required>
                    <?php foreach($procesos as $proceso): ?>
                        <option value="<?php echo $proceso->idProceso ?>" <?php echo $proceso->idProceso == $documentoFormato->fkProceso ? 'selected' : ''; ?>>
                            <?php echo $proceso->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tipo Documental:</label>
                <select name="txtFkTipoDocumental" id="txtFkTipoDocumental" class="form-control" required>
                    <?php foreach($tiposDocumentales as $tipoDocumental): ?>
                        <option value="<?php echo $tipoDocumental->idTipoDocumental ?>" <?php echo $tipoDocumental->idTipoDocumental == $documentoFormato->fkTipoDocumental ? 'selected' : ''; ?>>
                            <?php echo $tipoDocumental->nombre ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>