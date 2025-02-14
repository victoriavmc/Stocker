@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title"> CAMBIOS
                <div class="subtitle"> EN LA CUENTA
                </div>
            </h1>

            <div class="user-name">
                $valorNombre
            </div>

            <p class="message">
                <strong>Te confirmamos que los cambios solicitados en tu cuenta han sido realizados
                    correctamente.</strong><br><br>
            </p>

            <strong><b>Detalles de los cambios:</b></strong>
            <ul class="lista">
                <li class="li">
                    <strong>Nombre de usuario:</strong> <span style="color: #1976d2;">[Nombre cambiado]</span>
                </li>
                <li class="li">
                    <strong>Correo electrónico:</strong> <span style="color: #1976d2;">[Correo cambiado]</span>
                </li>
                <li class="li">
                    <strong>Contraseña:</strong> <span style="color: #1976d2;">[Si fue un cambio de contraseña, se indica
                        aquí]</span>
                </li>
            </ul>
            <br>
            <p>
                Si no fuiste tú quien realizó estos cambios o si notas algo extraño, por favor, contacta inmediatamente con
                nuestro soporte.
            </p>
            </p>
        </div>
    </div>
@endsection
