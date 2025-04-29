<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/tipoDocumental/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($tipoDocumental && is_object($tipoDocumental)){
                echo "
                    <div class='record-one'>
                        <span>ID: $tipoDocumental->idTipoDocumental</span>
                        <span>Nombre: $tipoDocumental->nombre</span>
                    </div>
                ";
            }
        ?>
    </div>
</div>
