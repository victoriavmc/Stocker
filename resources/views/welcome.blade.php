@extends('layouts.home')

@section('content')
    <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
        <section class="flex justify-center">
            <img class="w-2/3 rounded" src="{{ asset('storage/image/web/welcome-image.webp') }}" alt="pantallazo">
        </section>

        <section class="flex justify-center">
            @if (Route::has('login'))
                <div class="flex flex-col justify-center gap-4">
                    <p class="text-xl">Stocker Solutions es una empresa innovadora dedicada a transformar la gestión de
                        inventarios y procesos logísticos en pequeñas y medianas empresas. Con un enfoque integral y
                        personalizado, ofrecemos herramientas tecnológicas de vanguardia que facilitan el control de stock,
                        la facturación y la administración de roles, permitiendo a nuestros clientes optimizar sus
                        operaciones y tomar decisiones informadas de manera ágil y segura.</p>
                    <div>
                        @auth
                            <x-primary-btn label="Dashboard" link="{{ url('/dashboard') }}" />
                        @else
                            <x-primary-btn label="Iniciar sesion" link="{{ route('login') }}" />
                        @endauth
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection
