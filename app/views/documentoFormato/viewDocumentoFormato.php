<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/main"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/documentoFormato/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
    <?php
    if (empty($formatos)) {
        echo '<br>No se encuentran formatos en la base de datos';
    } else {
        foreach ($formatos as $formato) {
            echo
            "<div class='record'>
                <span>Nombre: $formato->nombre</span>
                <div class='buttons'>
                    <a href='/documentoFormato/view/$formato->id'> <button>Consultar</button> </a> 
                    <a href='/documentoFormato/edit/$formato->id'> <button>Editar</button> </a> 
                    <a href='/documentoFormato/delete/$formato->id'> <button>Eliminar</button> </a> 
                </div>
            </div>";
        }
    }
    ?>
    </div>
</div>
