<?php
// Verificación de sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #777;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-photo-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 15px;
        }

        #profilePhoto {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #2e7d32;
        }

        .upload-btn {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #2e7d32;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .user-role {
            color: #666;
            font-style: italic;
        }

        .profile-details {
            margin: 20px 0;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .detail-item i {
            margin-right: 10px;
            color: #2e7d32;
            width: 20px;
            text-align: center;
        }

        .profile-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .profile-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-edit {
            background-color: #2e7d32;
            color: white;
        }

        .btn-logout {
            background-color: #f5f5f5;
            color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="modal" id="profileModal" style="display: block;">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div class="profile-header">
                <div class="profile-photo-container">
                    <img id="profilePhoto" src="<?php echo isset($profileData['foto_perfil']) ? $profileData['foto_perfil'] : '/img/default-profile.png'; ?>" alt="Foto de perfil">
                    <label for="photoUpload" class="upload-btn">
                        <i class="fas fa-camera"></i>
                        <input type="file" id="photoUpload" accept="image/*" style="display: none;">
                    </label>
                </div>
                <h2><?php echo htmlspecialchars($profileData['nombre'] ?? 'Usuario'); ?></h2>
                <p class="user-role"><?php echo htmlspecialchars($profileData['rol'] ?? 'Rol no definido'); ?></p>
            </div>
            <div class="profile-details">
                <div class="detail-item">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo htmlspecialchars($profileData['email'] ?? 'No especificado'); ?></span>
                </div>
            </div>
            <div class="profile-actions">
                <button class="btn-edit">Editar Perfil</button>
                <button class="btn-logout" onclick="window.location.href='/login/logout'">Cerrar Sesión</button>
            </div>
        </div>
    </div>

    <script>
        // Cerrar modal
        document.querySelector('.close-modal').addEventListener('click', function() {
            document.getElementById('profileModal').style.display = 'none';
            window.location.href = '/'; // Redirigir a la página principal
        });

        // Cerrar modal al hacer clic fuera del contenido
        window.addEventListener('click', function(e) {
            if (e.target === document.getElementById('profileModal')) {
                document.getElementById('profileModal').style.display = 'none';
                window.location.href = '/'; // Redirigir a la página principal
            }
        });

        // Subir foto de perfil
        document.getElementById('photoUpload').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const formData = new FormData();
                formData.append('profile_photo', this.files[0]);

                fetch('/profile/updatePhoto', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profilePhoto').src = data.photoPath;
                        alert('Foto de perfil actualizada correctamente');
                    } else {
                        alert('Error: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al subir la imagen');
                });
            }
        });
    </script>
</body>
</html>