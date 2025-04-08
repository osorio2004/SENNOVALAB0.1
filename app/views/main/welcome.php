<div class="data-container">
    <div class="navegate-group">
        <h2>Bienvenido a la Página Principal</h2>
    </div>
    <div class="info">
        <div class="container-links">
            <ul>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'super_admin'): ?>
                    <li><a href="/usuario/view"><i class="fas fa-user-tag"></i><span class="span">Usuarios</span></a></li>
                    <li><a href="/categoriadocumento/view"><i class="fas fa-folder"></i><span class="span">Procesos</span></a></li>
                    <li><a href="/tipoDoc/view"><i class="fas fa-file-alt"></i><span class="span">Documentos</span></a></li>
                <?php endif ?>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'coordinador'): ?>
                    <li><a href="/usuario/view"><i class="fas fa-user-tag"></i><span class="span">Usuarios</span></a></li>
                    <li><a href="/tipoDoc/view"><i class="fas fa-file-alt"></i><span class="span">Documentos</span></a></li>
                <?php endif ?>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'trabajador'): ?>
                    <li><a href="/tipoDoc/view"><i class="fas fa-file-alt"></i><span class="span">Documentos</span></a></li>
                <?php endif ?>
                <li>
                    <a href="/login/logout">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="span">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>