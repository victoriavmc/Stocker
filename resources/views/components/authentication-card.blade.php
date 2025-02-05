<div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">

    <div class="w-full mx-auto my-4 overflow-hidden rounded-lg shadow-md md:max-w-4xl">
        <div class="grid grid-cols-1 bg-white md:grid-cols-2 dark:bg-gray-800">
            <div class="relative flex justify-center items-center min-h-[300px]">
                <img class="absolute inset-0 object-cover w-full h-full" src="{{ asset('storage/image/web/register-bg.webp') }}" alt="ImagenBg">
                <h2 class="relative z-10 text-4xl font-bold text-center text-white break-words md:text-6xl lg:text-7xl">{{ $text }}</h2>
            </div>

            <div class="flex justify-center px-4 py-10 lg:20 md:px-6">
                <x-mary-form class="w-full max-w-sm lg:gap-6" method="POST" action="{{ route($action) }}">
                    @csrf

                    <div class="flex justify-center w-full mb-2">
                        <a href="/"><img class="size-20 text-end" src="{{ asset('storage/image/web/stocker.ico') }}" alt="Logo"></a>
                    </div>

                    <x-mary-header title="{{ $title }}" class="mb-5" subtitle="{{ $subtitle }}" with-anchor />
                    {{ $slot }}
                </x-mary-form>
            </div>
        </div>
    </div>
</div>
