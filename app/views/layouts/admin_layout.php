<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style_admin_layout.css">
    <link rel="shortcut icon" href="/img/logo-sena.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .close-modal {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #aaa;
        }

        .close-modal:hover {
            color: #333;
        }

        .profile-info {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .profile-avatar i {
            font-size: 80px;
            color: #4a6baf;
        }

        .profile-details {
            flex: 1;
        }

        .profile-details p {
            margin-bottom: 10px;
        }

        /* Dark mode para el modal */
        body.dark-mode .modal-content {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        body.dark-mode .close-modal {
            color: #bdc3c7;
        }

        body.dark-mode .close-modal:hover {
            color: #ecf0f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="sidebar-content">
                <div class="logo"> <img id="logo" src="/img/logo_sennova_grd.png" alt="logoImg"> <span class="logo-text">Gestor Documental</span> </div>
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
                            <li><a href="/usuario/view"><i class="fas fa-users-cog"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/documentoFormato/view"><i class="fas fa-file-contract"></i><span class="span">Formato</span></a></li>
                            <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                            <li><a href="/tipoDocumental/view"><i class="fas fa-file-alt"></i><span class="span">Tipo Documento</span></a></li>
                            <li><a href="/anexo/view"><i class="fas fa-paperclip"></i><span class="span">Anexo</span></a></li>
                        <?php endif ?>

                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'coordinador'): ?>
                            <li><a href="/usuario/view"><i class="fas fa-user-cog"></i><span class="span">Usuarios</span></a></li>
                            <li><a href="/proceso/view"><i class="fas fa-project-diagram"></i><span class="span">Proceso</span></a></li>
                        <?php endif ?>

                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'trabajador'): ?>
                            <li><a href="/proceso/view"><i class="fas fa-tasks"></i><span class="span">Proceso</span></a></li>
                        <?php endif ?>
                    </ul>

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
                        <a href="#" class="icon-link" id="profile-icon" title="Ver perfil">
                            <i class="fas fa-user-circle"></i>
                        </a>
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

    <!-- Modal de perfil -->
    <div class="modal" id="profile-modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Información del Perfil</h2>
            <div class="profile-info">
                <div class="profile-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="profile-details">
                    <p><strong>Nombre:</strong> <span id="modal-nombre"><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?></span></p>
                    <p><strong>Correo:</strong> <span id="modal-correo"><?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?></span></p>
                    <p><strong>Rol:</strong> <span id="modal-rol"><?php echo isset($_SESSION['rol']) ? ucfirst(str_replace('_', ' ', $_SESSION['rol'])) : ''; ?></span></p>
                    <p><strong>Fecha Registro:</strong> <span id="modal-fecha"><?php echo isset($_SESSION['fecha_registro']) ? $_SESSION['fecha_registro'] : ''; ?></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para el dark mode
        window.onload = function() {
            const darkMode = localStorage.getItem('darkMode');
            if (darkMode === 'enabled') {
                document.body.classList.add('dark-mode');
                const icon = document.getElementById('theme-toggle').querySelector('i');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        };

        document.getElementById('theme-toggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');

            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('darkMode', 'enabled');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                localStorage.setItem('darkMode', 'disabled');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });

        // Función para el menú toggle
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
                }, 580);
            } else {
                logo.style.opacity = 0;
                setTimeout(() => {
                    logo.src = '/img/logo_sennova_grd.png';
                    logo.style.opacity = 1;
                });
            }
        });

        // Lógica para el modal de perfil
        const profileIcon = document.getElementById('profile-icon');
        const profileModal = document.getElementById('profile-modal');
        const closeModal = document.querySelector('.close-modal');

        // Abrir modal al hacer clic en el icono de perfil
        profileIcon.addEventListener('click', function(e) {
            e.preventDefault();
            profileModal.style.display = 'block';
        });

        // Cerrar modal al hacer clic en la X
        closeModal.addEventListener('click', function() {
            profileModal.style.display = 'none';
        });

        // Cerrar modal al hacer clic fuera del contenido
        window.addEventListener('click', function(event) {
            if (event.target === profileModal) {
                profileModal.style.display = 'none';
            }
        });

        // Cerrar modal con la tecla ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && profileModal.style.display === 'block') {
                profileModal.style.display = 'none';
            }
        });
    </script>
</body>

</html>