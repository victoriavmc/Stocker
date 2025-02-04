
@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title">
                Permisos
                <div class="subtitle">
                    Asignados
                </div>
            </h1>
            <p class="message">
                <strong>Te informamos que <span class="user-name">$valorNombre</span> ha sido creado exitosamente en el sistema <strong>STOCKER</strong>.</strong><br><br>

                A continuación, te proporcionamos un informe detallado de los permisos actuales asignados a la cuenta.<br><br>

                <strong>Permisos actuales:</strong>
                <ul style="list-style-type: none; padding-left: 0; margin-top: 10px;">
                    <li style="padding: 8px 0;">
                        <strong>Acceso a Inventario:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Acceso a Facturación:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Gestión de Usuarios:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Visualización de Reportes:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Acceso a Configuración:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li style="padding: 8px 0;">
                        <strong>Otros permisos:</strong> <span style="color: #1976d2;">[Lista de otros permisos específicos, si los hay]</span>
                    </li>
                </ul>
                <p>
                    Si tienes alguna duda o necesitas asistencia con las tareas a cumplir, no dudes en ponerte en contacto.
¡Gracias por tu colaboración!
                </p>
            </p>

        </div>
    </div>
@endsection
