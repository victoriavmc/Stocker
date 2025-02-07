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
        <p class="description">Hemos recibido una solicitud de baja por parte del usuario <span class="bold">nombre </span>.
            A continuación, los detalles de la cuenta para proceder con la baja: <span class="bold">STOCKER</span>. </p>
        <strong><b>Detalles de los cambios:</b></strong>
        <ul class="lista">
            <li class="li">
                <strong>Nombre completo:</strong> [Nombre completo]
            </li>
            <li class="li">
                <strong>Correo electrónico: </strong> <span style="color: #1976d2;">[Correo electrónico]</span>
            </li>
            <li class="li">
                <strong>Puesto: </strong> <span style="color: #1976d2;">[Puesto]</span>
            </li>
            <li class="li">
                <strong>Fecha de solicitud: </strong> <span style="color: #1976d2;">[fecha]</span>
            </li>
        </ul>
        </p>
        <br>
        <p class="note">
            Por favor, procedan con los pasos necesarios para tramitar la baja de esta cuenta en el sistema. <br>

            Saludos cordiales,
            El equipo de <span class="bold">STOCKER</span></p>
    </div>
@endsection
