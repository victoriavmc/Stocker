<header class="navbar fixed sm:static mb-2 sm:mb-0 bg-base-300 shadow-xl border-b border-base-content/30">

    <div class="navbar-start">
        @if (Route::currentRouteName() === 'profile.show')
            <x-mary-button class="btn-ghost" link="{{ route('dashboard') }}">Ir al dashboard</x-mary-button>
        @else
            <label for="my-drawer" class="drawer-button btn-ghost btn-circle">
                <div class="drawer-button btn-ghost btn-circle flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
            </label>
        @endif

        {{-- Tema --}}
        @livewire('theme-selector')
    </div>

    <div class="navbar-center">
        <p
            class="btn btn-ghost text-xl rounded-none hover:rounded-lg border-b-2 border-b-base-content hover:border-base-content hover:border-2">
            @if (Route::currentRouteName() === 'profile.show')
                {{ __('Profile') }}
            @else
                {{ ucfirst(str_replace('-', ' ', Route::currentRouteName())) }}
            @endif
        </p>
    </div>
    <div class="navbar-end">
        <button class="btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </button>
        <button class="btn btn-ghost btn-circle">
            <div class="indicator">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="badge badge-xs badge-primary indicator-item"></span>
            </div>
        </button>
        <!-- Settings Dropdown -->
        <div class="ms-2 relative">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="flex text-base-content bg-base-content/10 hover:bg-base-content/20 text-sm border-2 rounded-full focus:outline-none focus:border-base-300 transition">
                        @if (Auth::user()->profile_photo_path)
                            <img class="size-8 rounded-full object-cover"
                                src="{{ asset('storage/' . str_replace('storage/', '', Auth::user()->profile_photo_path)) }}"
                                alt="{{ Auth::user()->name }}" />
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-8">
                                <path fill-rule="evenodd"
                                    d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                    clip-rule="evenodd" />
                            </svg>
                        @endif
                    </button>

                </x-slot>

                <x-slot name="content">
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-base-content">
                        {{ __('Manage Account') }}
                    </div>

                    <x-dropdown-link href="{{ route('profile.show') }}">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                    @endif

                    <div class="border-t border-base-content"></div>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>
