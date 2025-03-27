<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documento/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/documento/create" method="post">
            <div class="form-group">
                <label for="">Título del Documento:</label>
                <input type="text" name="txtTitulo" id="txtTitulo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Fecha de Creación:</label>
                <input type="date" name="txtFechaCreacion" id="txtFechaCreacion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Fecha de Edición:</label>
                <input type="date" name="txtFechaEdicion" id="txtFechaEdicion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Estado:</label>
                <input type="text" name="txtEstado" id="txtEstado" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">ID Usuario Creador:</label>
                <input type="number" name="txtIdUsuarioCreador" id="txtIdUsuarioCreador" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">ID Categoría:</label>
                <input type="number" name="txtIdCategoria" id="txtIdCategoria" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Código:</label>
                <input type="text" name="txtCodigo" id="txtCodigo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Versión:</label>
                <input type="number" name="txtVersion" id="txtVersion" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">ID Usuario Aprobó:</label>
                <input type="number" name="txtIdUsuarioAprobo" id="txtIdUsuarioAprobo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">ID Usuario Elaboró:</label>
                <input type="number" name="txtIdUsuarioElaboro" id="txtIdUsuarioElaboro" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>