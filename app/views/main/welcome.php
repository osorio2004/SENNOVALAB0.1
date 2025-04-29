<div class="data-container">
    <div class="navegate-group">
        <h2>Bienvenido a la Página Principal</h2>
    </div>
<<<<<<< HEAD
    <div class="info">
        <div class="container-links">
            <ul>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'super_admin'): ?>
                    <li><a href="/usuario/view"><i class="fas fa-users-cog"></i><span class="span">Usuarios</span></a></li>
                    <li><a href="/documentoFormato/view"><i class="fas fa-file-signature"></i><span class="span">Formato</span></a></li>
                    <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                    <li><a href="/tipoDocumental/view"><i class="fas fa-file-alt"></i><span class="span">Tipo documento</span></a></li>
                <?php endif ?>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'coordinador'): ?>
                    <li><a href="/usuario/view"><i class="fas fa-users-cog"></i><span class="span">Usuarios</span></a></li>
                    <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                <?php endif ?>
                <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'trabajador'): ?>
                    <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                <?php endif ?>
                <li>
                    <a href="/login/logout">
                        <i class="fas fa-sign-in-alt"></i>
                        <span class="span">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
=======
    <div class="content">
        <div class="torta-container">
            <img src="/img/media_torta.png" alt="Canvas Documental" class="torta-img">

            <a href="ruta_documentos_internos.php" class="torta-btn btn2"></a>
            <a href="ruta_documentos_externos.php" class="torta-btn btn1"></a>
            <a href="ruta_formatos.php" class="torta-btn btn3"></a>
            <a href="ruta_anexos.php" class="torta-btn btn4"></a>
            <a href="ruta_categorias.php" class="torta-btn btn5"></a>   
>>>>>>> 3beac112ee427c1273375c3796b762d22259b6a1
        </div>
    </div>
</div>