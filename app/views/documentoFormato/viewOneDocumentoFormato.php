<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/documentoFormato/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($formato && is_object($formato)){
                echo "
                    <div class='record-one'>
                        <span>ID: $formato->id</span>
                        <span>Nombre: $formato->nombre</span>
                    </div>
                ";      
            }
        ?>
    </div>
</div>
