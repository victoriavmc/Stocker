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
    <h1 class="title"> BAJA DE LA CUENTA</h1>
    <div class="text-content">
        <p class="description">
            Lamentamos que este sea el final de tu etapa en <span class="bold" style="font-weight: bold; color: #1976d2;">STOCKER</span>, [Nombre del Usuario]. Agradecemos que hayas formado parte de nuestra empresa.
            La cuenta ha sido desactivada y se ha procesado la baja correspondiente.
        </p>
        <p class="note">
        Saludos cordiales,
        El equipo de <span class="bold">STOCKER</span></p>
    </div>
@endsection
