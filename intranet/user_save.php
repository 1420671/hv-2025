<?php
require __DIR__ . '/inc_auth.php';
require_login();
require_admin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin_users.php');
    exit;
}

if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    echo 'Token CSRF inválido.';
    exit;
}

$username = sanitize($_POST['username'] ?? '');
$name = sanitize($_POST['name'] ?? '');
$role = $_POST['role'] ?? 'user';
$password = $_POST['password'] ?? '';

$users = load_users();
$idx = get_user_index($username);
if ($idx >= 0) {
    // editar
    if ($password !== '') {
        if (!password_strong_enough($password)) {
            echo 'Contraseña no cumple las reglas.';
            exit;
        }
        $users[$idx]['password'] = password_hash($password, PASSWORD_DEFAULT);
    }
    $users[$idx]['name'] = $name;
    $users[$idx]['role'] = $role;
    save_users($users);
    header('Location: admin_users.php');
    exit;
}

// crear nuevo
if ($password === '') {
    echo 'La contraseña es requerida para crear un usuario.';
    exit;
}
if (!password_strong_enough($password)) {
    echo 'Contraseña no cumple las reglas.';
    exit;
}
$new = [
    'id' => uniqid('', true),
    'username' => $username,
    'name' => $name,
    'role' => $role,
    'password' => password_hash($password, PASSWORD_DEFAULT),
    'failed_attempts' => 0,
    'lock_until' => null
];
$users[] = $new;
save_users($users);
header('Location: admin_users.php');
exit;
?>
