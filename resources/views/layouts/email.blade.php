<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Stocker</title>
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
        }

        /* Contenedor principal */
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
        }

        /* Patrón de puntos */
        .dots-pattern {
            position: absolute;
            top: 0;
            right: 0;
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            padding: 20px;
        }

        .dot {
            width: 6px;
            height: 6px;
            background-color: #1a237e;
            opacity: 0.2;
            border-radius: 50%;
        }

        /* Header */
        .header {
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo {
            color: #1a237e;
            font-size: 24px;
            font-weight: bold;
        }

        /* Contenido principal */
        .main-content {
            padding: 32px;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            align-items: center;

        }

        .title {
            font-size: 48px;
            font-weight: bold;
            color: #1a237e;
            line-height: 1.1;
        }

        .subtitle {
            color: #004d40;
            margin-top: 8px;
        }

        .user-name {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 24px 0;
        }

        .message {
            font-size: 18px;
            color:black;
            line-height: 1.5;
        }

        /* Footer */
        .footer {
            background-color: #1a237e;
            color: white;
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .contact {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .contact-number {
            font-weight: 600;
            font-size: 18px;
        }

        .brand {
            font-weight: bold;
            font-size: 24px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <!-- Patrón de puntos -->
            <div class="dots-pattern">
                @for ($i = 0; $i < 15; $i++)
                    <div class="dot"></div>
                @endfor
            </div>

            <!-- Header -->
            <div class="header">
                <div class="logo">STOCKER</div>
            </div>
        </header>

        <!-- Contenido principal -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="contact">
                <span class="contact-number">+123456789</span>
            </div>
            <div class="brand">Perripepsi</div>
        </footer>
    </div>
</body>
</html>
