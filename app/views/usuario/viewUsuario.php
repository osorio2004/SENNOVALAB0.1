<div class="data-container">
    <div class="navegate-group">
        <div class="back">
        <a href="/main"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/usuario/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
    <?php
    if (empty($usuarios)) {
        echo '<br>No se encuentran usuarios en la base de datos';
    } else {
        foreach ($usuarios as $usuario) {
            echo
            "<div class='record'>
                <span>ID: $usuario->id - Nombre: $usuario->nombre</span>
                <div class='buttons'>
                    <a href='/usuario/view/$usuario->id'> <button>Consultar</button> </a> 
                    <a href='/usuario/edit/$usuario->id'> <button>Editar</button> </a> 
                    <a href='/usuario/delete/$usuario->id'> <button>Eliminar</button> </a> 
                </div>
            </div>";
        }
    }
    ?>
    </div>
</div>