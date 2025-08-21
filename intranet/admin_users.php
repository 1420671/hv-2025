<?php
require __DIR__ . '/inc_auth.php';
require_login();
require_admin();
$users = load_users_with_roles();
$token = csrf_token();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Administrar usuarios</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;margin:20px;background:#f7fafc}table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden}th,td{padding:12px;border-bottom:1px solid #eee;text-align:left}th{background:#f1f5f9}a.btn{background:#2b6cb0;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}</style>
</head>
<body>
    <h2>Gestión de usuarios</h2>
    <p><a class="btn" href="user_form.php">Crear usuario</a> <a class="btn" href="dashboard.php">Volver</a></p>
    <table>
        <tr><th>Username</th><th>Nombre</th><th>Rol</th><th>Bloqueado</th><th>Acciones</th></tr>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?php echo htmlspecialchars($u['username']); ?></td>
                <td><?php echo htmlspecialchars($u['name'] ?? ''); ?></td>
                <td><?php echo htmlspecialchars($u['role']); ?></td>
                <td><?php echo (is_user_locked($u) ? 'Sí (hasta ' . htmlspecialchars($u['lock_until']) . ')' : 'No'); ?></td>
                <td>
                    <a class="btn" href="user_form.php?username=<?php echo urlencode($u['username']); ?>">Editar</a>
                    <form style="display:inline-block;margin:0" method="post" action="user_delete.php" onsubmit="return confirm('¿Borrar usuario?');">
                        <input type="hidden" name="username" value="<?php echo htmlspecialchars($u['username']); ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                        <button style="background:#e53e3e;color:#fff;padding:6px 10px;border-radius:6px;border:none;cursor:pointer">Borrar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
