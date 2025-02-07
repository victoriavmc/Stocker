<style>
    .text-content {
        display: flex;
        align-content: space-around;
        flex-wrap: wrap;
        flex-direction: column;
    }

    .main-heading {
        font-size: 32px;
        font-weight: bold;
        color: #1e3a8a;
        margin-bottom: 16px;
    }

    .greeting,
    .description,
    .note {
        font-size: 16px;
        color: #4b5563;
    }

    .bold {
        font-weight: 600;
    }

    .pin-box {
        background-color: #f9fafb;
        padding: 16px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        margin-bottom: 16px;
    }

    .pin-label {
        font-weight: 500;
        color: #4b5563;
    }

    .pin {
        font-family: monospace;
        font-size: 24px;
        font-weight: bold;
        color: #1e3a8a;
    }
</style>

@extends('layouts.email')

@section('content')
    <!-- Main Content -->
    <h1 class="title"> Solicitud de Baja</h1>
    <div class="text-content">
        <p class="greeting">Hola, <span class="bold">nombre</span>.</p>
        <p class="description">Te informamos que hemos recibido tu solicitud para dar de baja tu cuenta en <span
                class="bold">STOCKER</span>. La solicitud ha sido enviada al personal de Recursos Humanos para tramitar la
            baja correspondiente. </p>
        <p class="note">Gracias por haberte sido parte del equipo. Te deseamos lo mejor en tus futuros proyectos.<br>
            Saludos cordiales,
            El equipo de <span class="bold">STOCKER</span></p>
    </div>
@endsection
