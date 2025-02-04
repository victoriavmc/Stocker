
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
            <p class="text-content message">
                <strong>Te informamos que <span class="user-name">$valorNombre</span> ha sido creado exitosamente en el sistema <strong>STOCKER</strong>.</strong><br><br>

                A continuación, te proporcionamos un informe detallado de los permisos actuales asignados a la cuenta.<br><br>

                <strong>Permisos actuales:</strong>
                <ul class="lista">
                    <li class="li">
                        <strong>Acceso a Inventario:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li class="li">
                        <strong>Acceso a Facturación:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li class="li">
                        <strong>Gestión de Usuarios:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li class="li">
                        <strong>Visualización de Reportes:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li class="li">
                        <strong>Acceso a Configuración:</strong> <span style="color: #1976d2;">[Sí/No]</span>
                    </li>
                    <li class="li">
                        <strong>Otros permisos:</strong> <span style="color: #1976d2;">[Lista de otros permisos específicos, si los hay]</span>
                    </li>
                </ul>
                <p style="margin-top: 5px;">
                    Si tienes alguna duda o necesitas asistencia con las tareas a cumplir, no dudes en ponerte en contacto.
¡Gracias por tu colaboración!
                </p>
            </p>

        </div>
    </div>
@endsection
