<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documentoFormato/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/documentoFormato/remove" method="post">
            <div class="form-group">
                <label>ID del Formato:</label>
                <input type="text" readonly value="<?php echo $formato->id ?>" name="txtId" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Eliminar</button>
            </div>
        </form>
    </div>
</div>
