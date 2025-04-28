<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/proceso/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/proceso/update" method="post">
            <div class="form-group">
                <label for="">ID del Proceso:</label>
                <input type="text" readonly value="<?php echo $proceso->idproceso ?>" name="txtId" id="txtId" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nombre del Proceso:</label>
                <input type="text" value="<?php echo $proceso->nombre ?>" name="txtNombre" id="txtNombre" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Sigla Código:</label>
                <input type="text" value="<?php echo $proceso->siglaCod ?>" name="txtSiglaCod" id="txtSiglaCod" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Editar</button>
            </div>
        </form>
    </div>
</div>
    