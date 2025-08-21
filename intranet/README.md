# Intranet mínima

Archivos:
- `inc_auth.php` - helpers: CSRF, carga de usuarios desde `users.json`, funciones de sesión.
- `login.php` - formulario de login.
- `auth.php` - procesa login y crea la sesión.
- `dashboard.php` - página protegida.
- `logout.php` - cierra sesión.
- `create_user.php` - script para crear usuarios (uso CLI preferido).
- `users.json` - almacenamiento simple de usuarios (JSON).

Uso rápido:
1. Crear usuario desde consola (en Windows PowerShell):

```powershell
php c:\xampp\htdocs\hv-2025\intranet\create_user.php usuario contraseña "Nombre"
```

2. Abrir http://localhost/hv-2025/intranet/login.php y usar credenciales.

Notas de seguridad:
- `users.json` y `create_user.php` son ejemplos para desarrollo local. Para producción use una base de datos y transporte seguro (HTTPS).
- Implementa bloqueos por intentos fallidos, registro y políticas de contraseñas en una versión completa.
