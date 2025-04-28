<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/proceso/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/proceso/create" method="post">
            <div class="form-group">
                <label for="">Nombre del Proceso:</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Sigla Código:</label>
                <input type="text" name="txtSiglaCod" id="txtSiglaCod" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>
