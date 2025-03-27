<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/main"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/documento/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
    <?php
    if (empty($documentos)) {
        echo '<br>No se encuentran documentos en la base de datos';
    } else {
        foreach ($documentos as $documento) {
            echo
            "<div class='record'>
                <span>ID: $documento->idDocumento - Título: $documento->titulo</span>
                <div class='buttons'>
                    <a href='/documento/view/$documento->idDocumento'> <button>Consultar</button> </a> 
                    <a href='/documento/edit/$documento->idDocumento'> <button>Editar</button> </a> 
                    <a href='/documento/delete/$documento->idDocumento'> <button>Eliminar</button> </a> 
                </div>
            </div>";
        }
    }
    ?>
    </div>
</div>