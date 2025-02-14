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

        .logo-imagen {
            width: 50px;
            height: 50px;
        }

        /* Contenido principal */
        .main-content {
            padding: 20px 32px;
            /* padding-top: 20px;
            padding-
            padding-left: 32px;
            padding-right: 32px; */
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
            color: black;
            line-height: 1.5;
        }

        .linea {
            height: 5px;
            background-color: #1a237e;
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

        .icono {
            width: 22.5px;
            height: 22.5px;
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

        .text-content {
            margin: 15px 0px;
        }

        .marca {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
        }

        .pelota {
            margin-bottom: 1px;
        }

        .lista {
            padding-left: 0;
            margin-top: 10px;
            margin-left: 18px;
        }

        .li {
            padding: 8px 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .lista {
                text-align: left;
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
                <img class="logo-imagen"
                    src="https://raw.githubusercontent.com/victoriavmc/Stocker/refs/heads/master/z-Readme/stocker.png?token=GHSAT0AAAAAAC6DKBD4BDREWRCKTPSWQG2MZ5BMMQA"
                    alt="">
                <div class="logo">STOCKER</div>
            </div>
        </header>
        <hr class="linea">

        <!-- Contenido principal -->
        <div class="main-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="contact">
                <svg class="icono" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-6">
                    <path fill-rule="evenodd"
                        d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="contact-number">+123456789</span>
            </div>
            <a href="/" target="blank" class="marca">
                <svg class="icono pelota" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-6">
                    <path
                        d="M21.721 12.752a9.711 9.711 0 0 0-.945-5.003 12.754 12.754 0 0 1-4.339 2.708 18.991 18.991 0 0 1-.214 4.772 17.165 17.165 0 0 0 5.498-2.477ZM14.634 15.55a17.324 17.324 0 0 0 .332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 0 0 .332 4.647 17.385 17.385 0 0 0 5.268 0ZM9.772 17.119a18.963 18.963 0 0 0 4.456 0A17.182 17.182 0 0 1 12 21.724a17.18 17.18 0 0 1-2.228-4.605ZM7.777 15.23a18.87 18.87 0 0 1-.214-4.774 12.753 12.753 0 0 1-4.34-2.708 9.711 9.711 0 0 0-.944 5.004 17.165 17.165 0 0 0 5.498 2.477ZM21.356 14.752a9.765 9.765 0 0 1-7.478 6.817 18.64 18.64 0 0 0 1.988-4.718 18.627 18.627 0 0 0 5.49-2.098ZM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 0 0 1.988 4.718 9.765 9.765 0 0 1-7.478-6.816ZM13.878 2.43a9.755 9.755 0 0 1 6.116 3.986 11.267 11.267 0 0 1-3.746 2.504 18.63 18.63 0 0 0-2.37-6.49ZM12 2.276a17.152 17.152 0 0 1 2.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0 1 12 2.276ZM10.122 2.43a18.629 18.629 0 0 0-2.37 6.49 11.266 11.266 0 0 1-3.746-2.504 9.754 9.754 0 0 1 6.116-3.985Z" />
                </svg>
                <div class="brand">Stocker</div>
            </a>
        </footer>
    </div>
</body>

</html>
