<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio en Construcción</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        /* --- Estilos Generales --- */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            /* Fondo con gradiente dinámico */
            background: linear-gradient(-45deg, #667eea, #764ba2, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: white;
            overflow: hidden;
        }

        /* Animación para el fondo */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* --- Contenedor Principal --- */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 1.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Caja de Texto --- */
        .text-box {
            max-width: 650px;
            padding: 30px 40px;
            background: rgba(0, 0, 0, 0.25); /* Un poco más oscuro para mejor contraste */
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
            margin-bottom: 40px;
        }

        h1 {
            font-size: 2.8rem;
            font-weight: 600;
            margin: 0 0 15px 0;
            letter-spacing: 1px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        p {
            font-size: 1.2rem;
            font-weight: 300;
            line-height: 1.6;
            margin: 0;
        }
        
        /* --- Logo Interactivo --- */
        .logo-container {
            position: relative;
            width: 200px; /* Ajusta el tamaño si es necesario */
            cursor: pointer;
            overflow: hidden; /* Esencial para el efecto de escaneo */
            border-radius: 8px; /* Opcional: para redondear el efecto */
        }

        .logo-container img {
            display: block;
            width: 100%;
            height: auto;
        }
        
        /* Efecto de escaneo al pasar el ratón */
        .logo-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%; /* Inicia fuera de la vista a la izquierda */
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);
            transition: left 0.6s ease-in-out; /* Velocidad de la animación */
        }

        .logo-container:hover::before {
            left: 100%; /* Mueve el efecto a través de la imagen */
        }

        /* --- Footer --- */
        .footer {
            position: absolute;
            bottom: 20px;
            font-size: 0.9rem;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>

    <div class="main-container">
        
        <div class="text-box">
            <h1>🛠️ Estamos en Construcción 🛠️</h1>
            <p>Trabajamos para traerte una nueva y espectacular interfaz. ¡La espera valdrá la pena!</p>
        </div>

        <div class="logo-container" title="Construyendo el futuro">
            <img src="image/logo-hv.png" alt="Logo de la Asociación HV Educativa">
        </div>

    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> Asociación HV Educativa. Todos los derechos reservados.
    </div>

</body>
</html>