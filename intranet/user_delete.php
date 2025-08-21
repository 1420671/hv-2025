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
$users = load_users();
$idx = get_user_index($username);
if ($idx < 0) {
    header('Location: admin_users.php');
    exit;
}
array_splice($users, $idx, 1);
save_users($users);
header('Location: admin_users.php');
exit;
?>
