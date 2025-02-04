@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title">
                NOTIFICACIÓN MENSUAL
                <div class="subtitle">
                    REPORTES Y FACTURAS
                </div>
            </h1>
            <div class="user-name">
                [Nombre del Usuario]
            </div>
            <p class="message">
                Este es un recordatorio sobre los informes y documentos importantes del mes que están disponibles en tu cuenta de **STOCKER**:
            </p>
            <ul style="list-style-type: none; padding-left: 0;">
                <li><strong>Facturas del mes:</strong> [Enlace a las facturas]</li>
                <li><strong>Reportes de ventas:</strong> [Enlace a los reportes]</li>
                <li><strong>Inventario actualizado:</strong> [Enlace al inventario]</li>
                <li><strong>Precios de venta:</strong> [Enlace a la lista de precios actualizada]</li>
            </ul>
            <p class="message">
                Te recomendamos revisar estos documentos para mantener un control adecuado de las operaciones del mes.
            </p>
        </div>
    </div>
@endsection
