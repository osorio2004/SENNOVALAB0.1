<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestor Documental</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #CCC;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            display: flex;
            height: 600px;
            width: 900px;
            background-color: white;
            overflow: hidden;
            position: relative; /* Añadido para posicionar el logo */
            box-shadow: 0 0 20px rgba(0,0,0,0.1); /* Sombra para mejor contraste */
        }

        .left-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            background-color: white;
            z-index: 2; /* Asegura que esté sobre el logo si es necesario */
        }

        .logo-container {
            position: absolute; /* Sacamos el logo del flujo normal */
            top: 20px;
            left: 20px;
            z-index: 3; /* Asegura que esté sobre todo */
        }

        .logo-container img {
            max-width: 200px;
            height: auto;
            display: block;
            filter: drop-shadow(0 0 5px rgba(0,0,0,0.2)); /* Sombra para mejor visibilidad */
        }

        .form-section {
            margin-top: 80px; /* Espacio para el logo */
        }

        .form-section h2 {
            color: #2e7d32;
            margin-bottom: 20px;
            font-size: 28px;
            text-align: left;
        }

        .form-section p {
            color: #666;
            margin-bottom: 25px;
            text-align: left;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
            text-align: left;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #1b5e20;
        }

        .forgot-password {
            text-align: right;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #2e7d32;
            text-decoration: none;
            font-size: 14px;
        }

        .errors {
            color: #d32f2f;
            margin-top: 15px;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 5px;
            font-size: 14px;
        }

        .right-section {
            flex: 1;
            position: relative;
            overflow: hidden;
        }

        .slide {
            width: 100%;
            height: 100%;
            position: absolute;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            object-fit: cover;
        }

        .slide.active {
            opacity: 1;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="/img/LOGOTIPO SENNOVALAB 2024-03_blanco.png" alt="Logo SENA">
        </div>
        
        <div class="left-section">
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
                    <div class="forgot-password">
                        <a href="#">Forgot Password</a>
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
        </div>

        <div class="right-section">
            <!-- Carrusel de imágenes -->
            <img class="slide active" src="/img/SENA1.png" alt="Imagen 1">
            <img class="slide" src="/img/SENA2.png" alt="Imagen 2">
            <img class="slide" src="/img/SENA3.png" alt="Imagen 3">
        </div>
    </div>

    <script>
        // Script para el carrusel de imágenes
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slide');
            let currentSlide = 0;
            
            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }
            
            // Cambia de imagen cada 3 segundos (3000ms)
            setInterval(nextSlide, 3000);
        });
    </script>
</body>
</html>