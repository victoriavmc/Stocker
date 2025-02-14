@extends('layouts.home')

@section('title')
    Historia
@endsection

@section('content')
    <div class='bg-base-300'>
        <div class="empresa-info container mx-auto py-8">
            <!-- Card de Bienvenida -->
            <div class="card mb-8">
                <div class="card-body gap-5">
                    <h2 class="card-title">Bienvenidos a Stocker Solutions</h2>
                    <p class="text-lg">
                        Stocker Solutions es una empresa innovadora dedicada a transformar la gestión de inventarios y
                        procesos logísticos en pequeñas y medianas empresas. Ofrecemos herramientas tecnológicas de
                        vanguardia para optimizar la administración de stock, facturación y asignación de roles, impulsando
                        una toma de decisiones eficiente y segura.
                    </p>
                    <div class="card-actions w-full flex justify-center">
                        <div class="border border-base-content bg-base-content w-content rounded-md">
                            <p class="text-base-300 p-3 text-lg ">
                                "Organiza, controla y
                                crece con
                                nosotros."</p>
                        </div>

                    </div>
                    <h2 class="card-title">Nuestra Historia</h2>
                    <p class="text-lg">
                        Con el tiempo, y gracias a la constante retroalimentación de nuestros clientes, Stocker Solutions
                        evolucionó para incorporar métodos de inventario avanzados como PEPS, UEPS y promedio ponderado,
                        además de robustos sistemas de seguridad y notificaciones automáticas. Hoy en día, nuestra
                        trayectoria y compromiso con la innovación nos han posicionado como referentes en la transformación
                        digital del sector logístico, siempre con la meta de acompañar el crecimiento sostenible y la
                        competitividad de nuestros clientes.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
