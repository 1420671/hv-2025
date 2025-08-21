<?php
require __DIR__ . '/inc_auth.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: change_password.php');
    exit;
}

if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    $_SESSION['cp_err'] = 'Token CSRF inválido.';
    header('Location: change_password.php');
    exit;
}

$current = $_POST['current_password'] ?? '';
$new = $_POST['new_password'] ?? '';
$confirm = $_POST['new_password_confirm'] ?? '';
$username = $_SESSION['user']['username'];

if ($new !== $confirm) {
    $_SESSION['cp_err'] = 'La nueva contraseña y la confirmación no coinciden.';
    header('Location: change_password.php');
    exit;
}

if (!password_strong_enough($new)) {
    $_SESSION['cp_err'] = 'La nueva contraseña no cumple las reglas mínimas de seguridad.';
    header('Location: change_password.php');
    exit;
}

$user = find_user_by_username($username);
if (!$user) {
    $_SESSION['cp_err'] = 'Usuario no encontrado.';
    header('Location: change_password.php');
    exit;
}

if (!password_verify($current, $user['password'])) {
    $_SESSION['cp_err'] = 'Contraseña actual incorrecta.';
    header('Location: change_password.php');
    exit;
}

// Actualizar contraseña
$hash = password_hash($new, PASSWORD_DEFAULT);
if (update_user($username, ['password' => $hash])) {
    // opcional: forzar nuevo inicio de sesión
    $_SESSION['cp_ok'] = 'Contraseña actualizada correctamente.';
    header('Location: change_password.php');
    exit;
}

$_SESSION['cp_err'] = 'No se pudo actualizar la contraseña.';
header('Location: change_password.php');
exit;
?>
