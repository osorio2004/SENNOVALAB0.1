<div class="login-container">
    <div class="left-section">
        <div class="logo-container">
            <img src="/img/logo_sennova_grd.png" alt="Logo SENA">
        </div>
    </div>

    <div class="form-section">  
        <h2>Bienvenido!</h2>
        <p>Con el gestor documental puedes organizar, acceder y compartir archivos de forma segura y eficiente.</p>

        <form action="/login/init" method="POST">
            <div class="input-group">
                <label for="txtUser">Email</label>
                <input type="text" name="txtUser" id="txtUser" required>
            </div>
            <div class="input-group">
                <label for="txtPassword">Contraseña</label>
                <input type="password" name="txtPassword" id="txtPassword" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
            <?php
            if (isset($errors)) {
                echo "
                    <div class='errors'>
                        $errors
                    </div>
                    ";
            }
            ?>
        </form>
    </div>

    <div class="right-section">
        <img src="/img/ejemplo.jpg" alt="Imagen Informativa">
    </div>
</div>