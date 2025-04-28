<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/proceso/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($proceso && is_object($proceso)){
                echo "
                    <div class='record-one'>
                        <span>ID: $proceso->idproceso</span>
                        <span>Nombre: $proceso->nombre</span>
                        <span>Sigla Código: $proceso->siglaCod</span>
                    </div>
                ";      
            }
        ?>
    </div>
</div>
