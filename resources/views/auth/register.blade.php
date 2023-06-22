<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <h1 class="text-3xl text-gray-800 font-bold mb-6">{{ __('Registro') }} </h1>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div>
                <x-label for="name" :value="__('Full Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('Email Address')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <label for="terms" class="flex items-start">
                        <x-checkbox name="terms" id="terms" class="form-checkbox mt-1" />

                        <span class="ml-2 text-sm">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="text-indigo-500 hover:text-indigo-700 underline">' . __('Terms of Service') . '</a>',
                                'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="text-indigo-500 hover:text-indigo-700 underline">' . __('Privacy Policy') . '</a>',
                            ]) !!}
                        </span>
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Registrarse') }}
                </x-button>
            </div>
        </form>

        <div class="mt-6">
            <p class="text-sm">
                {{ __('¿Tienes una cuenta?') }}
                <a class="font-medium text-indigo-500 hover:text-indigo-700" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
            </p>
        </div>
    </x-authentication-card>
</x-guest-layout>
