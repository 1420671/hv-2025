<?php
require __DIR__ . '/inc_auth.php';
require_login();
require_admin();
$token = csrf_token();
$username = $_GET['username'] ?? '';
$user = null;
if ($username) $user = find_user_by_username($username);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title><?php echo $user ? 'Editar' : 'Crear'; ?> usuario</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;background:#f7fafc}.card{background:#fff;padding:20px;border-radius:8px;width:480px}label{display:block;margin-top:8px}input,select{width:100%;padding:8px;border:1px solid #e2e8f0;border-radius:6px}button{margin-top:12px;background:#2b6cb0;color:#fff;padding:8px 12px;border-radius:6px;border:none;cursor:pointer}</style>
</head>
<body>
    <div class="card">
        <h3><?php echo $user ? 'Editar' : 'Crear'; ?> usuario</h3>
        <form method="post" action="user_save.php">
            <label>Usuario (username)</label>
            <input name="username" value="<?php echo htmlspecialchars($user['username'] ?? ''); ?>" <?php echo $user ? 'readonly' : ''; ?> required>
            <label>Nombre</label>
            <input name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>">
            <label>Rol</label>
            <select name="role">
                <option value="user" <?php echo (isset($user['role']) && $user['role']==='user') ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo (isset($user['role']) && $user['role']==='admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
            <label>Contraseña (dejar vacío para no cambiar)</label>
            <input name="password" type="password">
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <button type="submit"><?php echo $user ? 'Guardar' : 'Crear'; ?></button>
        </form>
        <p><a href="admin_users.php">Volver</a></p>
    </div>
</body>
</html>
