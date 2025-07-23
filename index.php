<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En Construcción - Interfaz Moderna</title>
    <style>
        /* Importa la fuente Poppins desde Google Fonts para un estilo moderno */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        :root {
            --primary-color: #6a82fb;
            --secondary-color: #764ba2;
            --text-color: #ffffff;
            --container-bg: rgba(0, 0, 0, 0.25);
            --border-color: rgba(255, 255, 255, 0.2);
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            /* Fondo con gradiente dinámico y animado */
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            background-size: 200% 200%;
            animation: gradientAnimation 10s ease infinite;
            color: var(--text-color);
            overflow: hidden;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 1.5s ease-out forwards;
        }

        .content-box {
            max-width: 650px;
            padding: 40px;
            background: var(--container-bg);
            border-radius: 20px;
            /* Efecto de vidrio esmerilado para un look moderno */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--border-color);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            margin-bottom: 40px;
        }

        h1 {
            font-size: clamp(2rem, 5vw, 2.8rem); /* Tipografía responsiva */
            font-weight: 700;
            margin-bottom: 0.5em;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        p {
            font-size: clamp(1rem, 2.5vw, 1.2rem); /* Tipografía responsiva */
            font-weight: 300;
            line-height: 1.7;
            max-width: 500px;
            margin: 0 auto 1.5em auto;
        }
        
        .highlight {
            font-weight: 600;
            color: #f0f0f0;
        }

        /* --- Efecto Interactivo del Logo --- */
        .logo-container {
            position: relative;
            width: 200px; /* Ancho del logo */
            height: 200px; /* Alto del logo (ajustar si es necesario) */
            cursor: pointer;
            border-radius: 50%; /* Contenedor circular */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 25px rgba(0,0,0,0.4);
            transition: transform 0.4s ease;
        }

        #logo-hv {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 50%; /* Hace la imagen circular */
        }
        
        /* Máscara para el efecto de construcción */
        .logo-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--secondary-color);
            border-radius: 50%;
            transition: transform 0.6s cubic-bezier(0.77, 0, 0.175, 1);
            transform: scale(1);
        }

        /* Animación al pasar el cursor */
        .logo-container:hover::before {
            transform: scale(0); /* La máscara se encoge para revelar el logo */
        }
        
        .logo-container:hover {
            transform: scale(1.05); /* El contenedor se agranda un poco */
        }

        .footer {
            margin-top: 30px;
            font-weight: 400;
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* --- Animaciones --- */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="content-box">
            <h1>¡Estamos construyendo algo increíble! 🚀</h1>
            <p>Nuestra nueva plataforma está en fase de implementación para ofrecerte una experiencia superior. La espera valdrá la pena.</p>
            <p class="highlight">¡Regresa pronto!</p>
        </div>

        <div class="logo-container" title="Asociación HV Educativa">
            <!-- Asegúrate de que la ruta a tu imagen sea correcta -->
            <img id="logo-hv" src="image/logo-hv.png" alt="Logo HV Educativa">
        </div>

        <div class="footer">
            <p>&copy; <?php echo date("Y"); ?> Asociación HV Educativa. Todos los derechos reservados.</p>
        </div>
    </div>

</body>
</html>
