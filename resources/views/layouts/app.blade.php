<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Icono de la aplicacion --}}
    <link rel="icon" href="{{ asset('storage/image/web/stocker.ico') }}" type="image/x-icon" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-base-content/10">
        <x-mary-toast />
        <!-- Page Heading -->
        <x-header />

        <!-- Page Content -->
        <main class="min-h-[92vh] bg-base-300">
            <!-- Barra Lateral (Sidebar) -->
            <div id="main-content" class="relative">
                <div class="drawer">
                    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                    <div class="drawer-content w-full">
                        {{ $slot }}
                    </div>
                    <div class="drawer-side fixed top-0 right-0 z-50">
                        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

                        <ul class="menu bg-base-200 text-base-content space-y-4 min-h-full w-80 p-4 shadow-lg">

                            <div class="flex items-center justify-center mb-6">
                                <a class="text-xl btn btn-ghost">
                                    <x-application-mark class="block w-auto h-10 mr-2" />
                                    Stocker
                                </a>
                            </div>
                            <!-- Módulo: Auditoría (Solo Admin) -->
                            <details class="collapse bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <a wire:navigate href="{{ route('dashboard') }}" class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-5 h-5 mr-2">
                                            <path
                                                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                            <path
                                                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </summary>
                            </details>

                            <!-- Módulo: Auditoría (Solo Admin) -->
                            @can('Administrador')
                                <details class="collapse bg-base-content/10 hover:bg-base-content/20">
                                    <summary class="font-medium collapse-title">
                                        <a wire:navigate href="{{ route('auditoria') }}" class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-5 h-5 mr-2">
                                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                <path fill-rule="evenodd"
                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Auditoria
                                        </a>
                                    </summary>
                                </details>
                            @endcan

                            <!-- Módulo: Usuarios y Roles -->
                            <details class="collapse collapse-arrow bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-5 h-5 mr-2">
                                            <path fill-rule="evenodd"
                                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Usuarios y Roles
                                    </div>
                                </summary>
                                <ul class="collapse-content">
                                    <li><a wire:navigate href="{{ route('personal') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Personal</a>
                                    </li>
                                    <li><a wire:navigate href="{{ route('asignarPermisos') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Asignar
                                            Permisos</a></li>
                                    <li><a wire:navigate href="{{ route('historialLaboral') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Historial
                                            Laboral</a></li>
                                    <li><a wire:navigate href="{{ route('bajas') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Bajas</a></li>
                                </ul>
                            </details>

                            <!-- Módulo: Inventario -->
                            <details class="collapse collapse-arrow bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-5 h-5 mr-2">
                                            <path
                                                d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                            <path fill-rule="evenodd"
                                                d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z"
                                                clip-rule="evenodd" />
                                        </svg>

                                        Inventario
                                    </div>
                                </summary>
                                <ul class="collapse-content">
                                    <li><a wire:navigate href="{{ route('productos') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Productos</a>
                                    </li>
                                    <li><a wire:navigate href="{{ route('stockGeneral') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Stock
                                            General</a></li>
                                </ul>
                            </details>

                            <!-- Módulo: Facturación (Archivero) -->
                            <details class="collapse collapse-arrow bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-5 h-5 mr-2">
                                            <path
                                                d="M19.5 21a3 3 0 0 0 3-3v-4.5a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h15ZM1.5 10.146V6a3 3 0 0 1 3-3h5.379a2.25 2.25 0 0 1 1.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 0 1 3 3v1.146A4.483 4.483 0 0 0 19.5 9h-15a4.483 4.483 0 0 0-3 1.146Z" />
                                        </svg>
                                        Facturación
                                    </div>
                                </summary>
                                <ul class="collapse-content">
                                    <li><a wire:navigate href="{{ route('comprasDonaciones') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Registrar
                                            Compras/Donaciones</a></li>
                                    <li><a wire:navigate href="{{ route('ventas') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Registrar
                                            Ventas</a></li>
                                    <li><a wire:navigate href="{{ route('precioPorTemporada') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Precios de
                                            Producto (Temporada)</a>
                                    </li>
                                </ul>
                            </details>

                            <!-- Módulo: Reportes -->
                            <details class="collapse collapse-arrow bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-5 h-5 mr-2">
                                            <path fill-rule="evenodd"
                                                d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm4.5 7.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0v-2.25a.75.75 0 0 1 .75-.75Zm3.75-1.5a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0V12Zm2.25-3a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5a.75.75 0 0 1 .75-.75Zm3.75-1.5a.75.75 0 0 0-1.5 0v9a.75.75 0 0 0 1.5 0v-9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Reportes
                                    </div>
                                </summary>
                                <ul class="collapse-content">
                                    <li><a wire:navigate href="{{ route('historialPerdidas') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Historial
                                            Pérdidas</a></li>
                                    <li><a wire:navigate href="{{ route('registroPerdidas') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Registro
                                            Pérdidas</a></li>
                                </ul>
                            </details>

                            <!-- Módulo: Métricas -->
                            <details class="collapse collapse-arrow bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="w-5 h-5 mr-2">
                                            <path fill-rule="evenodd"
                                                d="M15.22 6.268a.75.75 0 0 1 .968-.431l5.942 2.28a.75.75 0 0 1 .431.97l-2.28 5.94a.75.75 0 1 1-1.4-.537l1.63-4.251-1.086.484a11.2 11.2 0 0 0-5.45 5.173.75.75 0 0 1-1.199.19L9 12.312l-6.22 6.22a.75.75 0 0 1-1.06-1.061l6.75-6.75a.75.75 0 0 1 1.06 0l3.606 3.606a12.695 12.695 0 0 1 5.68-4.974l1.086-.483-4.251-1.632a.75.75 0 0 1-.432-.97Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Métricas
                                    </div>
                                </summary>
                                <ul class="collapse-content">
                                    <li><a wire:navigate href="{{ route('ventasMensuales') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Ventas
                                            Mensuales</a></li>
                                    <li><a wire:navigate href="{{ route('stockMinimo') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Stock
                                            Mínimo</a></li>
                                    <li><a wire:navigate href="{{ route('productosMasVendidos') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Productos Más
                                            Vendidos</a></li>
                                </ul>
                            </details>

                            <!-- Módulo: Configuración -->
                            <details class="collapse collapse-arrow bg-base-content/10 hover:bg-base-content/20">
                                <summary class="font-medium collapse-title">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="w-5 h-5 mr-2">
                                            <path fill-rule="evenodd"
                                                d="M11.078 2.25c-.917 0-1.699.663-1.85 1.567L9.05 4.889c-.02.12-.115.26-.297.348a7.493 7.493 0 0 0-.986.57c-.166.115-.334.126-.45.083L6.3 5.508a1.875 1.875 0 0 0-2.282.819l-.922 1.597a1.875 1.875 0 0 0 .432 2.385l.84.692c.095.078.17.229.154.43a7.598 7.598 0 0 0 0 1.139c.015.2-.059.352-.153.43l-.841.692a1.875 1.875 0 0 0-.432 2.385l.922 1.597a1.875 1.875 0 0 0 2.282.818l1.019-.382c.115-.043.283-.031.45.082.312.214.641.405.985.57.182.088.277.228.297.35l.178 1.071c.151.904.933 1.567 1.85 1.567h1.844c.916 0 1.699-.663 1.85-1.567l.178-1.072c.02-.12.114-.26.297-.349.344-.165.673-.356.985-.57.167-.114.335-.125.45-.082l1.02.382a1.875 1.875 0 0 0 2.28-.819l.923-1.597a1.875 1.875 0 0 0-.432-2.385l-.84-.692c-.095-.078-.17-.229-.154-.43a7.614 7.614 0 0 0 0-1.139c-.016-.2.059-.352.153-.43l.84-.692c.708-.582.891-1.59.433-2.385l-.922-1.597a1.875 1.875 0 0 0-2.282-.818l-1.02.382c-.114.043-.282.031-.449-.083a7.49 7.49 0 0 0-.985-.57c-.183-.087-.277-.227-.297-.348l-.179-1.072a1.875 1.875 0 0 0-1.85-1.567h-1.843ZM12 15.75a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Configuración
                                    </div>
                                </summary>
                                <ul class="collapse-content">
                                    <li><a wire:navigate href="{{ route('ajustesPersonal') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Personal</a>
                                    </li>
                                    <li><a wire:navigate href="{{ route('ajustesPagina') }}"
                                            class="justify-start text-start btn btn-ghost btn-block">Página</a>
                                    </li>
                                </ul>
                            </details>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    @stack('js')
</body>

</html>
