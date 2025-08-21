<?php
require __DIR__ . '/inc_auth.php';
require_login();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Dashboard - Intranet</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#f7fafc;margin:0;padding:24px}
        .bar{display:flex;align-items:center;justify-content:space-between;background:#2b6cb0;color:#fff;padding:14px;border-radius:8px}
        .card{background:#fff;border-radius:8px;padding:18px;margin-top:18px;box-shadow:0 8px 20px rgba(0,0,0,0.06)}
        a.button{background:#2b6cb0;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none}
    </style>
</head>
<body>
    <div class="bar">
        <div>Intranet - Bienvenido, <?php echo htmlspecialchars($user['username']); ?></div>
        <div style="display:flex;gap:8px;align-items:center"><a class="button" href="change_password.php">Cambiar contraseña</a><a class="button" href="logout.php">Cerrar sesión</a></div>
    </div>

    <div class="card">
        <h3>Panel</h3>
    <p>Esta es una intranet mínima. Agrega aquí funcionalidades según tus necesidades.</p>
    <p class="small">Tiempo de sesión restante: <?php echo max(0, SESSION_TIMEOUT - (time() - ($_SESSION['last_activity'] ?? time()))); ?> segundos.</p>
    </div>
</body>
</html>
