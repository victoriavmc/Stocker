
@extends('layouts.email')

@section('content')
    <!-- Contenido principal -->
    <div class="main-content">
        <div class="welcome-text">
            <h1 class="title">
                BIENVENIDO
                <div class="subtitle">
                    AL EQUIPO!
                </div>
            </h1>
            <div class="user-name">
                $valorNombre
            </div>
            <p class="message">
                Nos alegra que formes parte de nuestro equipo. Estamos seguros que lograremos grandes cosas juntos. Si surge algún problema no dudes en consultarnos. ¡Saludos y éxitos!
            </p>
        </div>
    </div>
@endsection
