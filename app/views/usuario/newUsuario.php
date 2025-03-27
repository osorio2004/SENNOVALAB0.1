<div class="data-container">
    <div class="navegate-group">
        <div class="back">
            <a href="/usuario/view"><img src="/img/back.svg"></a>
        </div>
    </div>
    <div class="info">
        <form action="/usuario/create" method="post">
            <div class="form-group">
                <label for="">Nombre del Usuario:</label>
                <input type="text" name="txtNombre" id="txtNombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Email del Usuario:</label>
                <input type="email" name="txtEmail" id="txtEmail" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Contraseña:</label>
                <input type="password" name="txtPassword" id="txtPassword" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Rol:</label>
                <select name="txtRol" id="txtRol" class="form-control" required>
                <?php if(isset($_SESSION['rol']) && $_SESSION['rol']=='super_admin'): ?>
                    <option value="super_admin">Super Admin</option>
                    <option value="coordinador">Coordinador</option>
                    <option value="trabajador">trabajador</option>
                <?php endif ?>
                <?php if(isset($_SESSION['rol']) && $_SESSION['rol']=='coordinador'): ?>
                    <option value="trabajador">trabajador</option>
                <?php endif ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
</div>