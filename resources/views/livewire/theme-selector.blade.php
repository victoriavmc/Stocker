<div>
    <details id="theme-dropdown" class="dropdown">
        <summary class="m-1 btn bg-base-content/10 hover:bg-base-content/20 border-none">
            Temas
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </summary>
        <div title="Change Theme"
            class="dropdown-content menu bg-base-content/10 rounded-box z-[1] p-2 shadow gap-2 w-56 max-h-[calc(100vh-10rem)] overflow-y-auto overflow-x-hidden">
            <ul>
                <li class="">
                    @foreach ($themes as $theme => $colors)
                        <div class="flex flex-row justify-between hover:bg-green-100 p-3 w-30 mb-2"
                            data-theme='{{ $theme }}' wire:click="updateSelectedTheme('{{ $theme }}')"
                            onclick="applyTheme('{{ $theme }}'); closeDropdown(event)">
                            <div>
                                <p>{{ ucfirst($theme) }}</p>
                            </div>
                            <div class="flex items-center">
                                <span class="w-4 h-4 mx-1 rounded-full"
                                    style="background-color: {{ $colors[1] }};"></span>
                                <span class="w-4 h-4 mx-1 rounded-full"
                                    style="background-color: {{ $colors[2] }};"></span>
                                <span class="w-4 h-4 mx-1 rounded-full"
                                    style="background-color: {{ $colors[3] }};"></span>
                                <span class="w-4 h-4 mx-1 rounded-full"
                                    style="background-color: {{ $colors[4] }};"></span>
                            </div>
                        </div>
                    @endforeach
                </li>
            </ul>
        </div>
    </details>
</div>

<script>
    function applyTheme(theme) {
        // Aplicar el tema en el frontend
        document.documentElement.setAttribute('data-theme', theme);

        // Forzar una actualización del DOM (opcional)
        document.documentElement.style.display = 'none';
        document.documentElement.offsetHeight; // Trigger reflow
        document.documentElement.style.display = '';
    }

    function closeDropdown(event) {
        // Detener la propagación del evento
        event.stopPropagation();

        // Cerrar el menú inmediatamente
        document.getElementById('theme-dropdown').removeAttribute('open');
    }
</script>
