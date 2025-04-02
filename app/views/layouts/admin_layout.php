<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style_admin_layout.css">
    <link rel="shortcut icon" href="/img/logo-sena.png" type="image/x-icon">
    <!-- Añadiendo Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-content">
                <div class="logo">
                    <img src="/img/LOGOTIPO SENNOVALAB 2024-03_blanco.png" alt="logoImg">
                    <span class="logo-text">Gestor Documentacion</span>
                </div>
                
                <!-- Sección para mostrar información del usuario -->
                <div class="user-info">
                    <div class="user-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="user-details">
                        <span class="user-email"><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'Usuario'; ?></span>
                        <span class="user-role"><?php echo isset($_SESSION['rol']) ? ucfirst(str_replace('_', ' ', $_SESSION['rol'])) : 'Rol no definido'; ?></span>
                    </div>
                </div>
                
                <nav class="menu">
                    <ul>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'super_admin'): ?>
                            <li><a href="/usuario/view"><i class="fas fa-user-tag"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/categoriadocumento/view"><i class="fas fa-folder"></i><span class="span">Categorías</span></a></li>
                            <li><a href="/tipoDoc/view"><i class="fas fa-file-alt"></i><span class="span">Procesos</span></a></li>
                        <?php endif ?>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'coordinador'): ?>
                            <li><a href="/usuario/view"><i class="fas fa-user-tag"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/tipoDoc/view"><i class="fas fa-file-alt"></i><span class="span">Documentos</span></a></li>
                        <?php endif ?>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'trabajador'): ?>
                            <li><a href="/tipoDoc/view"><i class="fas fa-file-alt"></i><span class="span">Documentos</span></a></li>
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
        </aside>
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
        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-moon')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
        const menuToggle = document.querySelector('.menu-toggle');
        const sidebar = document.querySelector('.sidebar');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-hidden');
        });
    </script>
</body>

</html>