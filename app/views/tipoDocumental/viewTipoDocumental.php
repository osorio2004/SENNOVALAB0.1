<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/main"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/tipoDocumental/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
        <?php
        if (empty($tiposDocumentales)) {
            echo '<br>No se encuentran tipos documentales en la base de datos';
        } else {
            foreach ($tiposDocumentales as $tipo) {
                echo
                "<div class='record'>
                    <span>Nombre: $tipo->nombre</span>
                    <div class='buttons'>
                        <a href='/tipoDocumental/view/$tipo->idTipoDocumental'><button>Consultar</button></a> 
                        <a href='/tipoDocumental/edit/$tipo->idTipoDocumental'><button>Editar</button></a> 
                        <a href='/tipoDocumental/delete/$tipo->idTipoDocumental'><button>Eliminar</button></a> 
                    </div>
                </div>";
            }
        }
        ?>
    </div>
</div>
