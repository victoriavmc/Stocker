<div>
    {{-- Do your work, then step back. --}}
    <div class="flex flex-col items-center gap-4">
        <label class="text-lg font-semibold">Selecciona un tema:</label>
        <select wire:model="theme" class="w-full max-w-xs select select-bordered">
            @foreach ([
                "light", "dark", "cupcake", "bumblebee", "emerald", "corporate",
                "synthwave", "retro", "cyberpunk", "valentine", "halloween", "garden",
                "forest", "aqua", "lofi", "pastel", "fantasy", "wireframe", "black",
                "luxury", "dracula", "cmyk", "autumn", "business", "acid", "lemonade",
                "night", "coffee", "winter", "dim", "nord", "sunset"
            ] as $t)
                <option value="{{ $t }}">{{ ucfirst($t) }}</option>
            @endforeach
        </select>

        <script>
            document.addEventListener('theme-updated', event => {
                document.documentElement.setAttribute('data-theme', event.detail.theme);
                localStorage.setItem('theme', event.detail.theme);
            });

            document.addEventListener('DOMContentLoaded', function () {
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-theme', savedTheme);
                @this.set('theme', savedTheme);
            });
        </script>
    </div>

</div>
