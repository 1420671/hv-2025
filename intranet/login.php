<?php
require __DIR__ . '/inc_auth.php';
$token = csrf_token();
$err = $_SESSION['login_err'] ?? '';
unset($_SESSION['login_err']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login - Intranet</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;background:#f4f6f8;margin:0;display:flex;align-items:center;justify-content:center;height:100vh}
        .card{background:#fff;padding:28px;border-radius:10px;box-shadow:0 6px 22px rgba(0,0,0,0.08);width:360px}
        h2{margin:0 0 12px 0}
        .field{margin-bottom:12px}
        input[type=text],input[type=password]{width:100%;padding:10px;border:1px solid #dfe6ee;border-radius:6px}
        .btn{display:inline-block;background:#2b6cb0;color:#fff;padding:10px 14px;border-radius:6px;text-decoration:none;border:none;cursor:pointer}
        .error{background:#ffe6e6;color:#900;padding:8px;border-radius:6px;margin-bottom:10px}
        .small{font-size:0.9rem;color:#666;margin-top:8px}
    </style>
</head>
<body>
    <div class="card">
        <h2>Acceso Intranet</h2>
        <?php if ($err): ?>
            <div class="error"><?php echo htmlspecialchars($err); ?></div>
        <?php endif; ?>
        <form method="post" action="auth.php">
            <div class="field">
                <label for="username">Usuario</label>
                <input id="username" name="username" type="text" required autofocus>
            </div>
            <div class="field">
                <label for="password">Contraseña</label>
                <input id="password" name="password" type="password" required>
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <button class="btn" type="submit">Entrar</button>
        </form>
        <div class="small">Credenciales: usar <code>create_user.php</code> para crear usuarios.</div>
    </div>
</body>
</html>
