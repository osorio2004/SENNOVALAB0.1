<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/main"><img src="/img/back.svg"></a>
        </div>
        <div class="create">
            <a href="/categoriadocumento/new"><button>+</button></a>
        </div>
    </div>
    <div class="info">
    <?php
    if (empty($categorias)) {
        echo '<br>No se encuentran categorías en la base de datos';
    } else {
        foreach ($categorias as $categoria) {
            echo
            "<div class='record'>
                <span>ID: $categoria->idCategoria - Nombre: $categoria->nombre</span>
                <div class='buttons'>
                    <a href='/categoriadocumento/edit/$categoria->idCategoria'> <button>Editar</button> </a> 
                    <a href='/categoriadocumento/delete/$categoria->idCategoria'> <button>Eliminar</button> </a> 
                </div>
            </div>";
        }
    }
    ?>
    </div>
</div>