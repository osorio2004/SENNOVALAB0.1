<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/categoriadocumento/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/categoriadocumento/update" method="post">
            <div class="form-group">
                <label for="">ID de la Categoría:</label>
                <input type="text" readonly value="<?php echo $categoria->idCategoria ?>" name="txtId" id="txtId" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nombre de la Categoría:</label>
                <input type="text" value="<?php echo $categoria->nombre ?>" name="txtNombre" id="txtNombre" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Descripción:</label>
                <input type="text" value="<?php echo $categoria->descripcion ?>" name="txtDescripcion" id="txtDescripcion" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Actualizar</button>
            </div>
        </form>
    </div>
</div>