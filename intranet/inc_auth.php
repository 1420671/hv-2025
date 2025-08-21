<?php
// inc_auth.php - funciones comunes de autenticación
session_start();

// Configuraciones de seguridad
define('MAX_FAILED_ATTEMPTS', 5); // intentos antes de bloquear
define('LOCKOUT_SECONDS', 300); // 5 minutos de bloqueo
define('SESSION_TIMEOUT', 1800); // 30 minutos de inactividad

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verify_csrf($token) {
    return hash_equals($_SESSION['csrf_token'] ?? '', $token ?? '');
}

function load_users() {
    $path = __DIR__ . '/users.json';
    if (!file_exists($path)) return [];
    $data = file_get_contents($path);
    $arr = json_decode($data, true);
    return is_array($arr) ? $arr : [];
}

function save_users(array $users) {
    $path = __DIR__ . '/users.json';
    file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function get_user_index($username) {
    $users = load_users();
    foreach ($users as $i => $u) {
        if (strcasecmp($u['username'], $username) === 0) return $i;
    }
    return -1;
}

function update_user($username, array $newData) {
    $users = load_users();
    $idx = get_user_index($username);
    if ($idx < 0) return false;
    $users[$idx] = array_merge($users[$idx], $newData);
    save_users($users);
    return true;
}

function find_user_by_username($username) {
    $users = load_users();
    foreach ($users as $u) {
        if (strcasecmp($u['username'], $username) === 0) return $u;
    }
    return null;
}

function is_admin() {
    if (empty($_SESSION['user'])) return false;
    $u = find_user_by_username($_SESSION['user']['username']);
    return !empty($u) && (!empty($u['role']) && $u['role'] === 'admin');
}

function require_admin() {
    if (!is_admin()) {
        header('HTTP/1.1 403 Forbidden');
        echo 'Acceso denegado.';
        exit;
    }
}

// Al cargar usuarios, asegurar que el campo role exista (por compatibilidad)
function load_users_with_roles() {
    $users = load_users();
    foreach ($users as &$u) {
        if (!isset($u['role'])) $u['role'] = 'user';
        if (!isset($u['failed_attempts'])) $u['failed_attempts'] = 0;
        if (!isset($u['lock_until'])) $u['lock_until'] = null;
    }
    return $users;
}

function is_user_locked($user) {
    if (empty($user)) return false;
    if (isset($user['lock_until']) && $user['lock_until']) {
        return strtotime($user['lock_until']) > time();
    }
    return false;
}

function record_failed_attempt($username) {
    $users = load_users();
    $idx = get_user_index($username);
    if ($idx < 0) return;
    $users[$idx]['failed_attempts'] = ($users[$idx]['failed_attempts'] ?? 0) + 1;
    if ($users[$idx]['failed_attempts'] >= MAX_FAILED_ATTEMPTS) {
        $users[$idx]['lock_until'] = date('c', time() + LOCKOUT_SECONDS);
        $users[$idx]['failed_attempts'] = 0; // reset after lock
    }
    save_users($users);
}

function reset_failed_attempts($username) {
    update_user($username, ['failed_attempts' => 0, 'lock_until' => null]);
}

function password_strong_enough($pwd) {
    // Reglas básicas: 8+ caracteres, mayúscula, minúscula y número
    if (strlen($pwd) < 8) return false;
    if (!preg_match('/[A-Z]/', $pwd)) return false;
    if (!preg_match('/[a-z]/', $pwd)) return false;
    if (!preg_match('/[0-9]/', $pwd)) return false;
    return true;
}

function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
    // Verificar expiración por inactividad
    if (!empty($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
        // destruir sesión
        $_SESSION = [];
        session_destroy();
        header('Location: login.php');
        exit;
    }
    $_SESSION['last_activity'] = time();
}

function sanitize($s) {
    return htmlspecialchars(trim($s), ENT_QUOTES, 'UTF-8');
}

?>
