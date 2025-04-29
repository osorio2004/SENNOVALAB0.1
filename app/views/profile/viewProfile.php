<?php
// views/usuario/viewProfile.php

// Verificar sesión activa
if (!isset($_SESSION['id'])) {
    header('Location: /login');
    exit();
}

// Obtener ID del perfil (puede ser el mismo usuario u otro si es admin)
$profileId = $_GET['id'] ?? $_SESSION['id'];

// Cargar modelo y obtener datos
require_once MAIN_APP_ROUTE . 'models/UsuarioModel.php';
$profileData = $usuarioModel->getProfileData($profileId);

if (!$profileData) {
    echo "<div class='error-message'>Usuario no encontrado</div>";
    exit();
}
?>

<div class="profile-view-container">
    <div class="profile-header-section">
        <h1 class="profile-title"><i class="fas fa-user-circle"></i> Perfil de Usuario</h1>
        <div class="profile-actions">
            <?php if ($_SESSION['id'] == $profileId || $_SESSION['rol'] == 'super_admin'): ?>
                <a href="/usuario/edit/<?php echo $profileData->id; ?>" class="action-button edit-button">
                    <i class="fas fa-edit"></i> Editar
                </a>
                <?php if ($_SESSION['rol'] == 'super_admin' && $_SESSION['id'] != $profileId): ?>
                    <a href="/usuario/delete/<?php echo $profileData->id; ?>" class="action-button delete-button" onclick="return confirm('¿Confirmas que deseas eliminar este usuario?');">
                        <i class="fas fa-trash-alt"></i> Eliminar
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="profile-detail-card">
        <div class="user-avatar-section">
            <div class="avatar-container">
                <i class="fas fa-user-circle"></i>
            </div>
            <h2 class="user-name"><?php echo htmlspecialchars($profileData->nombre); ?></h2>
            <span class="user-role-badge"><?php echo ucfirst(str_replace('_', ' ', $profileData->rol)); ?></span>
        </div>

        <div class="user-info-section">
            <div class="info-row">
                <span class="info-label"><i class="fas fa-id-card"></i> ID:</span>
                <span class="info-value"><?php echo $profileData->id; ?></span>
            </div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-envelope"></i> Email:</span>
                <span class="info-value"><?php echo htmlspecialchars($profileData->email); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label"><i class="fas fa-user-tag"></i> Rol:</span>
                <span class="info-value"><?php echo ucfirst(str_replace('_', ' ', $profileData->rol)); ?></span>
            </div>
        </div>
    </div>

    <?php if ($_SESSION['id'] == $profileId): ?>
    <div class="profile-security-section">
        <h3><i class="fas fa-shield-alt"></i> Seguridad</h3>
        <a href="/usuario/changePassword/<?php echo $profileData->id; ?>" class="security-button">
            <i class="fas fa-key"></i> Cambiar Contraseña
        </a>
    </div>
    <?php endif; ?>
</div>

<style>
.profile-view-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.profile-header-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 15px;
}

.profile-title {
    color: #333;
    font-size: 24px;
    margin: 0;
}

.profile-title i {
    margin-right: 10px;
    color: #4e73df;
}

.profile-actions {
    display: flex;
    gap: 10px;
}

.action-button {
    padding: 8px 15px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

.edit-button {
    background-color: #4e73df;
    color: white;
    border: 1px solid #4e73df;
}

.edit-button:hover {
    background-color: #3a5ccc;
}

.delete-button {
    background-color: #e74a3b;
    color: white;
    border: 1px solid #e74a3b;
}

.delete-button:hover {
    background-color: #d62c1a;
}

.profile-detail-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 25px;
    display: flex;
    gap: 30px;
}

.user-avatar-section {
    text-align: center;
    flex: 0 0 200px;
}

.avatar-container {
    font-size: 100px;
    color: #dddfeb;
    margin-bottom: 15px;
}

.user-name {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 20px;
}

.user-role-badge {
    display: inline-block;
    background-color: #f8f9fa;
    color: #4e73df;
    padding: 3px 10px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    border: 1px solid #dddfeb;
}

.user-info-section {
    flex: 1;
}

.info-row {
    display: flex;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px solid #f8f9fa;
}

.info-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.info-label {
    width: 150px;
    font-weight: 600;
    color: #5a5c69;
    display: flex;
    align-items: center;
    gap: 8px;
}

.info-value {
    flex: 1;
    color: #333;
}

.profile-security-section {
    margin-top: 30px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.profile-security-section h3 {
    margin-top: 0;
    color: #333;
    display: flex;
    align-items: center;
    gap: 10px;
}

.security-button {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 15px;
    background-color: #f8f9fa;
    color: #4e73df;
    text-decoration: none;
    border-radius: 4px;
    border: 1px solid #dddfeb;
    transition: all 0.3s;
}

.security-button:hover {
    background-color: #e9ecef;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
    text-align: center;
    margin: 20px;
}
</style>