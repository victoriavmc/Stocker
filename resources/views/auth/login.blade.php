<x-guest-layout>
    <x-authentication-card text="Bienvenido!" title="Login" subtitle="Bienvenido! Por favor inicia sesion para continuar"
        action="login">
        <x-validation-errors class="mb-3" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <div>
            <x-mary-input icon="o-envelope" label="Correo electronico/usuario" id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" autofocus autocomplete="username" />
        </div>

        <div class="mt-3">
            <x-mary-password label="Contraseña" id="password" class="block mt-1 w-full" type="password" name="password"
                autocomplete="current-password" password-icon="o-lock-closed" password-visible-icon="o-lock-open" />
        </div>

        <div class="block mt-3">
            <label for="remember_me" class="flex items-center">
                <x-mary-checkbox label="{{ __('Remember me') }}" id="remember_me" name="remember" />
            </label>
        </div>

        <x-primary-btn type="submit" label="{{ __('Log in') }}" class="mt-3" />

        @if (Route::has('password.request'))
            <a class="underline text-sm mt-3 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
    </x-authentication-card>
</x-guest-layout>
