<?php
require __DIR__ . '/inc_auth.php';
require_login();
$token = csrf_token();
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Cambiar contraseña - Intranet</title>
    <style>body{font-family:Arial,Helvetica,sans-serif;background:#f4f6f8;margin:0;display:flex;align-items:center;justify-content:center;height:100vh}.card{background:#fff;padding:24px;border-radius:10px;box-shadow:0 6px 22px rgba(0,0,0,0.08);width:420px}input{width:100%;padding:10px;margin-top:6px;border:1px solid #dfe6ee;border-radius:6px}.btn{margin-top:12px;background:#2b6cb0;color:#fff;padding:10px 12px;border-radius:6px;border:none;cursor:pointer}.small{font-size:0.9rem;color:#666;margin-top:8px}</style>

</head>
<body>
    <div class="card">
        <h3>Cambiar contraseña</h3>
        <?php if (!empty($_SESSION['cp_err'])): ?>
            <div style="background:#ffe6e6;color:#900;padding:8px;border-radius:6px;margin-bottom:10px"><?php echo htmlspecialchars($_SESSION['cp_err']); unset($_SESSION['cp_err']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['cp_ok'])): ?>
            <div style="background:#e6ffea;color:#060;padding:8px;border-radius:6px;margin-bottom:10px"><?php echo htmlspecialchars($_SESSION['cp_ok']); unset($_SESSION['cp_ok']); ?></div>
        <?php endif; ?>
        <form method="post" action="change_password_action.php">
            <label>Contraseña actual</label>
            <input type="password" name="current_password" required>
            <label>Nueva contraseña</label>
            <input type="password" name="new_password" required>
            <label>Repetir nueva contraseña</label>
            <input type="password" name="new_password_confirm" required>
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <button class="btn" type="submit">Actualizar contraseña</button>
        </form>
        <div class="small">Reglas mínimas: 8+ caracteres, mayúscula, minúscula y número.</div>
    </div>
</body>
</html>
