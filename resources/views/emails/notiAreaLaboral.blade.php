
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

            <p class="message">
                A partir de
                <div class="user-name">
                    $FECHA
                </div>, usted
                <div class="user-name">
                    $valorNombre
                </div>
                ocupará el puesto de
                <div class="user-name">
                    $PUESTO
                </div>
                y asumirá todas las responsabilidades asociadas a dicho puesto.<br><br>
                Estamos muy seguros de que contribuirá al éxito de <strong>STOCKER.</strong><br><br>
                Muchas gracias por su atención!
            </p>
        </div>

    </div>
@endsection
