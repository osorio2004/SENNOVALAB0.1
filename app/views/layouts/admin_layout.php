<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style_admin_layout.css">
    <link rel="shortcut icon" href="/img/logo-sena.png" type="image/x-icon"> <!-- Añadiendo Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-content">
<<<<<<< HEAD
                <div class="logo">
                    <img src="/img/LOGOTIPO SENNOVALAB 2024-03_blanco.png" alt="logoImg">
                    <span class="logo-text">Gestor Documentacion</span>
                </div>

=======
                <div class="logo"> <img id="logo" src="/img/logo_sennova_grd.png" alt="logoImg"> <span class="logo-text">Gestor Documental</span> </div>
>>>>>>> 3beac112ee427c1273375c3796b762d22259b6a1
                <!-- Sección para mostrar información del usuario -->
                <div class="user-info">
                    <div class="user-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="user-details">
                        <span class="user-nombre"><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario'; ?></span>
                        <span class="user-role"><?php echo isset($_SESSION['rol']) ? ucfirst(str_replace('_', ' ', $_SESSION['rol'])) : 'Rol no definido'; ?></span>
                    </div>
                </div>

                <nav class="menu">
                    <ul>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'super_admin'): ?>
<<<<<<< HEAD
                            <li><a href="/usuario/view"><i class="fas fa-users-cog"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/documentoFormato/view"><i class="fas fa-file-signature"></i><span class="span">Formato</span></a></li>
                            <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                            <li><a href="/tipoDocumental/view"><i class="fas fa-file-alt"></i><span class="span">Tipo documento</span></a></li>
                            <li><a href="/anexo/view"><i class="fas fa-file-alt"></i><span class="span">Anexo</span></a></li>
=======
                            <li><a href="/usuario/view"><i class="fas fa-user-tag"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/documentoFormato/view"><i class="fas fa-folder"></i><span class="span">Formatos / Documentos</span></a></li>
                            <li><a href="/proceso/view"><i class="fas fa-file-alt"></i><span class="span">Proceso</span></a></li>
>>>>>>> 3beac112ee427c1273375c3796b762d22259b6a1
                        <?php endif ?>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'coordinador'): ?>
                            <li><a href="/usuario/view"><i class="fas fa-users-cog"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                        <?php endif ?>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'trabajador'): ?>
                            <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                        <?php endif ?>
                    </ul>

                    <!-- Item de cerrar sesión separado -->
                    <ul>
                        <li class="logout-item">
                            <a href="/login/logout">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="span">Cerrar Sesión</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>
        <main class="main-content">
            <header class="header">
                <div class="header-container">
                    <button class="menu-toggle"><i class="fas fa-bars"></i></button>
                    <h1><?php echo isset($title) ? $title : 'Default Title'; ?></h1>
                    <div class="header-icons">
                        <a href="#" class="icon-link"><i class="fas fa-user-circle"></i></a>
                        <a href="#" class="icon-link"><i class="fas fa-bell"></i></a>
                        <a href="#" class="icon-link" id="theme-toggle"><i class="fas fa-moon"></i></a>
                    </div>
                </div>
            </header>
            <div class="content">
                <?php include_once $content; ?>
            </div>
        </main>
    </div>

    <!-- Script para cambiar entre tema oscuro y claro -->
    <script>
        // Comprobar la preferencia de modo oscuro al cargar la página
        window.onload = function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'enabled') {
                document.body.classList.add('dark-mode');
                const icon = document.getElementById('theme-toggle').querySelector('i');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        };

        // Cambiar el tema de la página al hacer clic en el icono de la luna o el sol
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled'); // Guardar preferencia
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                localStorage.setItem('darkMode', 'disabled'); // Guardar preferencia
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });

        // Cambiar el logo al hacer clic en el botón de menú
        // y ocultar/mostrar la barra lateral
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');
        const logo = document.getElementById('logo');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-hidden');

            if (sidebar.classList.contains('sidebar-hidden')) {
                logo.style.opacity = 0;
                setTimeout(() => {
                    logo.src = '/img/logo_sennova_peque.png';
                    logo.style.opacity = 1;
                },580);
            } else {
                logo.style.opacity = 0;
                setTimeout(() => {
                    logo.src = '/img/logo_sennova_grd.png';
                    logo.style.opacity = 1;
                });
            }
        });
    </script>
    </script>
</body>

</html>