<?php
require __DIR__ . '/inc_auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php');
    exit;
}

$csrf = $_POST['csrf_token'] ?? '';
if (!verify_csrf($csrf)) {
    $_SESSION['login_err'] = 'Token CSRF inválido.';
    header('Location: login.php');
    exit;
}

$username = sanitize($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['login_err'] = 'Usuario y contraseña requeridos.';
    header('Location: login.php');
    exit;
}

$user = find_user_by_username($username);
if (!$user || !isset($user['password'])) {
    // Registrar intento si existe registro parcial
    record_failed_attempt($username);
    $_SESSION['login_err'] = 'Usuario o contraseña incorrectos.';
    header('Location: login.php');
    exit;
}

// Verificar si está bloqueado
if (is_user_locked($user)) {
    $until = $user['lock_until'];
    $remain = strtotime($until) - time();
    $_SESSION['login_err'] = 'Cuenta bloqueada temporalmente. Intenta de nuevo en ' . gmdate('i:s', max(0, $remain)) . ' minutos.';
    header('Location: login.php');
    exit;
}

if (!password_verify($password, $user['password'])) {
    record_failed_attempt($username);
    $_SESSION['login_err'] = 'Usuario o contraseña incorrectos.';
    header('Location: login.php');
    exit;
}

// Login exitoso: resetear intentos
reset_failed_attempts($username);

// Login exitoso
session_regenerate_id(true);
$_SESSION['user'] = [
    'id' => $user['id'] ?? $user['username'],
    'username' => $user['username'],
    'name' => $user['name'] ?? ''
];

header('Location: dashboard.php');
exit;
?>
