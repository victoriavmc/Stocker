<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

    <div class="w-full md:max-w-4xl mx-auto my-4 shadow-md overflow-hidden rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 bg-white dark:bg-gray-800">
            <div class="relative flex justify-center items-center min-h-[300px]">
                <img class="absolute inset-0 w-full h-full object-cover" src="{{ asset('storage/image/web/register-bg.jpg') }}" alt="">
                <h2 class="relative text-4xl md:text-6xl lg:text-7xl font-bold text-white text-center break-words z-10">{{ $text }}</h2>
            </div>
    
            <div class="flex justify-center py-10 lg:20 px-4 md:px-6">
                <x-mary-form class="w-full max-w-sm lg:gap-6" method="POST" action="{{ route('password.email') }}">
                    @csrf
    
                    <div class="w-full flex justify-center mb-2">
                        <a href="/"><img class="size-20 text-end" src="{{ asset('storage/image/web/stocker.ico') }}" alt=""></a>
                    </div>
                    
                    <x-mary-header title="{{ $title }}" class="mb-5" subtitle="{{ $subtitle }}" with-anchor />
                    {{ $slot }}
                </x-mary-form>
            </div>
        </div>
    </div>
</div>
