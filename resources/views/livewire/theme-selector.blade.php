<div>
    <details class="dropdown">
        <summary class="m-1 btn">
            Temas
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-2">
                <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
        </summary>
        <div title="Change Theme" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-full p-2 shadow gap-2">
            @foreach ($themes as $theme => $colors)
                <ul>
                    <li class="flex flex-row">
                        <div class="flex justify-between p-4 w-52" data-theme='{{ $theme }}' wire:click="updateSelectedTheme('{{ $theme }}')" onclick="applyTheme('{{ $theme }}')">
                            <div>
                                <p>{{ ucfirst($theme) }}</p>
                            </div>
                            <div class="flex items-center">
                                <span class="w-5 h-5 mx-1 rounded-full" style="background-color: {{ $colors[1]}};"></span>
                                <span class="w-5 h-5 mx-1 rounded-full" style="background-color: {{ $colors[2]}};"></span>
                                <span class="w-5 h-5 mx-1 rounded-full" style="background-color: {{ $colors[3]}};"></span>
                                <span class="w-5 h-5 mx-1 rounded-full" style="background-color: {{ $colors[4]}};"></span>
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>
    </details>
</div>

<script>
    function applyTheme(theme) {
        // Aplicar el tema en el frontend
        document.documentElement.setAttribute('data-theme', theme);
    }
</script>

