<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documento/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/documento/update" method="post">
            <div class="form-group">
                <label for="">ID del Documento:</label>
                <input type="text" readonly value="<?php echo $documento->idDocumento ?>" name="txtId" id="txtId" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Título del Documento:</label>
                <input type="text" value="<?php echo $documento->titulo ?>" name="txtTitulo" id="txtTitulo" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Fecha de Creación:</label>
                <input type="date" value="<?php echo $documento->fechaCreacion ?>" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Fecha de Edición:</label>
                <input type="date" value="<?php echo $documento->fechaEdicion ?>" name="txtFechaEdicion" id="txtFechaEdicion" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Estado:</label>
                <input type="text" value="<?php echo $documento->estado ?>" name="txtEstado" id="txtEstado" class="form-control">
            </div>
            <div class="form-group">
                <label for="">ID Usuario Creador:</label>
                <input type="number" value="<?php echo $documento->idUsuarioCreador ?>" name="txtIdUsuarioCreador" id="txtIdUsuarioCreador" class="form-control">
            </div>
            <div class="form-group">
                <label for="">ID Categoría:</label>
                <input type="number" value="<?php echo $documento->idCategoria ?>" name="txtIdCategoria" id="txtIdCategoria" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Código:</label>
                <input type="text" value="<?php echo $documento->codigo ?>" name="txtCodigo" id="txtCodigo" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Versión:</label>
                <input type="number" value="<?php echo $documento->version ?>" name="txtVersion" id="txtVersion" class="form-control">
            </div>
            <div class="form-group">
                <label for="">ID Usuario Aprobó:</label>
                <input type="number" value="<?php echo $documento->idUsuarioAprobo ?>" name="txtIdUsuarioAprobo" id="txtIdUsuarioAprobo" class="form-control">
            </div>
            <div class="form-group">
                <label for="">ID Usuario Elaboró:</label>
                <input type="number" value="<?php echo $documento->idUsuarioElaboro ?>" name="txtIdUsuarioElaboro" id="txtIdUsuarioElaboro" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Actualizar</button>
            </div>
        </form>
    </div>
</div>