
@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title">
                NUEVO
                <div class="subtitle">
                TRABAJADOR
                </div>
            </h1>
            <p class="message">
                <strong>Te informamos que el usuario para el nuevo trabajador <span class="user-name">$valorNombre</span> ha sido creado exitosamente en el sistema <strong>STOCKER</strong>.</strong><br><br>

                Es necesario que se le asigne un rol para completar el proceso de incorporación.<br><br>

                <strong>Detalles del trabajador:</strong>
                <ul style="list-style-type: none; padding-left: 0; margin-top: 10px;">
                    <li style="padding: 8px 0;">
                        <strong>Nombre completo:</strong> <span style="color: #1976d2;">[Nombre completo]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Correo electrónico:</strong> <span style="color: #1976d2;">[Correo electrónico]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Fecha de creación:</strong> <span style="color: #1976d2;">[Fecha]</span>
                    </li>
                </ul>
                <br>

                <p>
                    Por favor, procedan con la asignación del rol correspondiente desde el panel de administración.<br>
                    Si tienen alguna consulta, no duden en ponerse en contacto.<br>
                    ¡Gracias por su colaboración!
                </p>
            </p>

        </div>
    </div>
@endsection
