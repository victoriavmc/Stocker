<x-guest-layout>
    <x-authentication-card text="Reestablece tu cuenta!" title="Reestablecer cuenta" subtitle="Ingresa tu correo actual y nueva contraseña para poder ayudarte!">
        <x-validation-errors class="mb-3" />

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="block">
            <x-mary-input label="{{ __('Email') }}" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" icon="o-envelope" autofocus autocomplete="username" />
        </div>

        <div class="mt-3">
            <x-mary-password label="{{ __('Password') }}" id="password" class="block mt-1 w-full" type="password" name="password" password-icon="o-lock-closed" password-visible-icon="o-lock-open" autocomplete="new-password" />
        </div>

        <div class="mt-3">
            <x-mary-password label="{{ __('Confirm Password') }}" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" password-icon="o-lock-closed" password-visible-icon="o-lock-open" autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-3">
            <x-primary-btn type="submit" label="{{ __('Reset Password') }}" />
        </div>
    </x-authentication-card>
</x-guest-layout>
