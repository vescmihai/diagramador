<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <h1 class="text-3xl text-gray-800 font-bold mb-6">{{ __('Login') }}</h1>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="text-sm text-indigo-500 hover:text-indigo-700 underline" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Ingresar') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6">
            <p class="text-sm">
                {{ __('¿No tienes una cuenta?') }}
                <a class="font-medium text-indigo-500 hover:text-indigo-700" href="{{ route('register') }}">{{ __('Registrate') }}</a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>
