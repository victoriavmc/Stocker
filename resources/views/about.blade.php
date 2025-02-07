@extends('layouts.home')

@section('title')
    Nosotros
@endsection

@section('content')
    <div class="acerca-de-nosotros container mx-auto py-8">
        <h2 class="text-3xl font-bold mb-4">Acerca de Nosotros</h2>
        <p class="text-lg mb-4">
            Somos dos desarrolladores apasionados por la tecnología y la innovación. Con una visión compartida de
            transformar la forma en que las empresas gestionan sus inventarios y procesos logísticos, unimos nuestras
            habilidades y experiencia para dar vida a esta plataforma.
        </p>
        <p class="text-lg">
            Cada línea de código y cada detalle en el diseño de esta página refleja nuestro compromiso por crear soluciones
            que simplifiquen la administración de stock y potencien la toma de decisiones. Creemos firmemente que la
            tecnología es la clave para impulsar el crecimiento y la eficiencia en el mundo empresarial, y por ello
            trabajamos con dedicación para ofrecer herramientas prácticas y de alto impacto.
        </p>
    </div>

    <div class="autores container mx-auto py-8 mb-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Autores</h2>

        <!-- Primer Autor: Imagen a la izquierda, información a la derecha -->
        <div class="card max-h-60 lg:card-side bg-base-100 shadow-xl mb-8">
            <figure class="p-4">
                <img src="{{ asset('storage/image/web/santi.webp') }}" alt="Foto de Santi" class="rounded-lg">
            </figure>
            <div class="card-body lg:w-1/2">
                <h2 class="card-title">Santiago N. Aranda</h2>
                <p>
                    Soy un profesional apasionado por el diseño y la experiencia de usuario, con un perfil que fusiona
                    creatividad y rigor técnico. <br>
                    Soy fan de los RPG y de la Chocotorta.
                </p>
            </div>
        </div>

        <!-- Segundo Autor: Información a la izquierda, imagen a la derecha -->
        <div class="card max-h-60 lg:card-side bg-base-100 shadow-xl">
            <div class="card-body lg:w-1/2">
                <h2 class="card-title">VictoriaVMC</h2>
                <p>
                    Soy una profesional apasionada por la programación y la gestión de bases de datos, con un enfoque sólido
                    en la creación de funcionalidades robustas y eficientes. Fusionando creatividad y rigor técnico. <br>
                    Soy fan del Cs y de la Pepsi.
                </p>

            </div>
            <figure class="p-4">
                <img src="{{ asset('storage/image/web/victoriavmc.webp') }}" alt="Foto de VictoriaVMC" class="rounded-lg">
            </figure>
        </div>
    </div>
@endsection
