<?php
// Script simple para crear usuarios en users.json (uso CLI o POST protegido localmente)
require __DIR__ . '/inc_auth.php';

if (php_sapi_name() !== 'cli' && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    echo "Acceso no permitido.";
    exit;
}

$username = $argv[1] ?? ($argv[1] ?? null);
$password = $argv[2] ?? null;
$name = $argv[3] ?? '';

if (!$username || !$password) {
    echo "Uso (CLI): php create_user.php <username> <password> [name]\n";
    exit(1);
}

$users = load_users();
foreach ($users as $u) {
    if (strcasecmp($u['username'], $username) === 0) {
        echo "Usuario ya existe.\n";
        exit(1);
    }
}

$new = [
    'id' => uniqid('', true),
    'username' => $username,
    'name' => $name,
    'password' => password_hash($password, PASSWORD_DEFAULT)
];
$users[] = $new;
$path = __DIR__ . '/users.json';
file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "Usuario creado: $username\n";
?>
