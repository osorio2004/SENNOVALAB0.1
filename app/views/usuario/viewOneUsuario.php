<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <?php
            if($usuario && is_object($usuario)){
                echo "
                    <div class='record-one'>
                        <span>ID: $usuario->id</span>
                        <span>Nombre: $usuario->nombre</span>
                        <span>Email: $usuario->email</span>
                        <span>Rol: $usuario->rol</span>
                    </div>
                ";      
            }
        ?>
    </div>
</div>