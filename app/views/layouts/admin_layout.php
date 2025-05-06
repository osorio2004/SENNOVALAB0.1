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
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% 5% 5% auto;
            padding: 0;
            border-radius: 8px;
            width: 450px;
            max-width: 90%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .close-modal {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #aaa;
            z-index: 1001;
        }

        .close-modal:hover {
            color: #333;
        }

        .modal-header-img-container {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        .modal-header-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .modal-subheader-img {
            width: 100%;
            height: auto;
            max-height: 100px;
            object-fit: cover;
            margin: 10px 0;
            padding: 0;
        }

        .profile-avatar {
            text-align: center;
            margin-top: -30px;
            position: relative;
            z-index: 2;
        }

        .profile-avatar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid white;
            object-fit: cover;
            background-color: #f0f0f0;
        }

        .modal-footer-img {
            width: 100%;
            height: 2px;
            object-fit: cover;
            margin: 15px 0;
        }

        .profile-details {
            padding: 20px;
            text-align: center;
        }

        .profile-field {
            margin: 15px 0;
        }

        .profile-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .profile-field .field-value {
            font-size: 18px;
            color: #4CAF50;
        }

        .role-container {
            display: inline-block;
            padding: 5px 15px;
            border: 2px solid #4CAF50;
            border-radius: 20px;
            margin-top: 10px;
        }

        .role-value {
            color: #4CAF50;
            font-weight: bold;
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

        body.dark-mode .profile-field label {
            color: #bdc3c7;
        }

        body.dark-mode .modal-header-img,
        body.dark-mode .modal-subheader-img,
        body.dark-mode .modal-footer-img {
            filter: brightness(0.8);
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
                            <li><a href="/main"><i class="fas fa-house"></i><span class="span">Inicio</span></a></li>
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
            
            <!-- Imagen de encabezado centrada y más grande -->
            <div class="modal-header-img-container">
                <img src="/img/carnet/LOGO.png" alt="Logo" class="modal-header-img">
            </div>
            
            <!-- Segunda imagen que se adapta al ancho del modal -->
            <img src="/img/carnet/RECTANGLE.png" alt="Decoración" class="modal-subheader-img">
            
            <!-- Foto de perfil -->
            <div class="profile-avatar">
                <img src="/img/carnet/PROFILE.png" alt="Foto de perfil">
            </div>
            
            <!-- Línea delgada decorativa -->
            <img src="/img/carnet/LINE.png" alt="Línea decorativa" class="modal-footer-img">
            
            <!-- Información del usuario -->
            <div class="profile-details">
                <div class="profile-field">
                    <label>Nombre</label>
                    <div class="field-value"><?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?></div>
                </div>
                
                <div class="profile-field">
                    <label>Rol</label>
                    <div class="role-container">
                        <span class="role-value"><?php echo isset($_SESSION['rol']) ? ucfirst(str_replace('_', ' ', $_SESSION['rol'])) : ''; ?></span>
                    </div>
                </div>
                
                <div class="profile-field">
                    <label>Correo</label>
                    <div><?php echo isset($_SESSION['correo']) ? $_SESSION['correo'] : ''; ?></div>
                </div>
                
                <div class="profile-field">
                    <label>Fecha Registro</label>
                    <div><?php echo isset($_SESSION['fecha_registro']) ? $_SESSION['fecha_registro'] : ''; ?></div>
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