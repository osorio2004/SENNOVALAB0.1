<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/main"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/proceso/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
    <?php
    if (empty($procesos)) {
        echo '<br>No se encuentran procesos en la base de datos';
    } else {
        foreach ($procesos as $proceso) {
            echo
            "<div class='record'>
                <span>Nombre: $proceso->nombre</span>
                <span>Sigla: $proceso->siglaCod</span>
                <div class='buttons'>
                    <a href='/proceso/view/$proceso->idproceso'><button>Consultar</button></a>
                    <a href='/proceso/edit/$proceso->idproceso'><button>Editar</button></a>
                    <a href='/proceso/delete/$proceso->idproceso'><button>Eliminar</button></a>
                </div>
            </div>";
        }
    }
    ?>  
    </div>
</div>
