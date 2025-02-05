<x-guest-layout>
    <x-authentication-card text="¿Olvidaste tu contraseña?" title="Reestablecer cuenta" subtitle="No te preocupes! agrega tus datos para poder ayudarte" action="password.email">
        <div class="mb-3 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <x-validation-errors class="mb-3" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <div class="block">
            <x-mary-input label="{{ __('Email') }}" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" icon="o-envelope" required autofocus autocomplete="username" />
        </div>

        <div class="flex items-center justify-end mt-3">
            <x-primary-btn type="submit" label="{{ __('Email Password Reset Link') }}" />
        </div>
    </x-authentication-card>
</x-guest-layout>
