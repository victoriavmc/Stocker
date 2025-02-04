@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title">
                ¡ALERTA DE INVENTARIO!
                <div class="subtitle">
                    BAJO STOCK
                </div>
            </h1>
            <div class="user-name">
                [Nombre del Usuario]
            </div>
            <p class="message">
                Te informamos que el stock de uno o más productos en el inventario ha caído por debajo del nivel recomendado. Aquí te dejamos los detalles:
            </p>
            <ul class="lista">
                <li class="li"><strong>Producto:</strong> [Nombre del producto]</li>
                <li class="li"><strong>Cantidad restante:</strong> [Cantidad disponible]</li>
                <li class="li"><strong>Nivel mínimo recomendado:</strong> [Cantidad recomendada]</li>
            </ul>
            <p class="message">
                Te sugerimos tomar las medidas necesarias para reabastecer el inventario.
            </p>
        </div>
    </div>
@endsection
