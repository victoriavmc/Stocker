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
    <h1 class="title">REESTABLECER CUENTA</h1>
    <div class="text-content">
        <p class="greeting">Hola, <span class="bold">Usuario</span>.</p>
        <p class="description">Recibimos una solicitud para recuperar tu contraseña en <span class="bold">STOCKER</span>. Para restablecer, utiliza el siguiente código:</p>
        <div class="pin-box">
            <p class="pin-label">PIN de recuperación:</p>
            <p class="pin">123456</p>
        </div>
        <p class="note">Este código expirará en 10 minutos.</p>

        <p class="note">Si no solicitaste este cambio, por favor, ignora este mensaje o contacta a nuestro soporte.</p>
    </div>
@endsection
