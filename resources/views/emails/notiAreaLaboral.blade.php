@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title">
                ÁREA
                <div class="subtitle">
                    LABORAL
                </div>
            </h1>

            <p class="text-content">
                A partir de $FECHA, usted $valorNombre ocupará el puesto de $PUESTO
                y asumirá todas las responsabilidades asociadas a dicho puesto.
                <br>
                Estamos muy seguros de que contribuirá al éxito de <strong>STOCKER.</strong>
                <br>
                Muchas gracias por su atención!
            </p>
        </div>

    </div>
@endsection
