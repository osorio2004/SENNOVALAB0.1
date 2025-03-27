<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoriadocumento/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/categoriadocumento/create" method="post">
            <div class="form-group">
                <label for="">Nombre de la Categoría:</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Descripción:</label>
                <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>