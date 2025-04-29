<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/tipoDocumental/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/tipoDocumental/update" method="post">
            <div class="form-group">
                <label for="">ID del Tipo Documental:</label>
                <input type="text" readonly value="<?php echo $tipoDocumental->idTipoDocumental ?>" name="txtId" id="txtId" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nombre del Tipo Documental:</label>
                <input type="text" value="<?php echo $tipoDocumental->nombre ?>" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>
