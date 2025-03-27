<div class="login-container">
    <?php 
    if(isset($errors)) {

        echo "
            <div class='errors'>
                $errors
            </div>
        ";
    }
    ?>
    
    <h2>Iniciar Sesión</h2>
    <form action="/login/init" method="post">
        <div class="input-group">
            <label for="txtUser">Email</label>
            <input type="text" name="txtUser" id="txtUser" required>
        </div>
        <div class="input-group">
            <label for="txtPassword">Contraseña</label>
            <input type="password" name="txtPassword" id="txtPassword" required>
        </div>
        <button type="submit">Ingresar</button>
    </form>
</div>