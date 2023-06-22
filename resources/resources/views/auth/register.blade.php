<x-authentication-layout>
    <h1 class="text-3xl text-slate-800 font-bold mb-6">{{ __('Crea tu cuenta') }} ✨</h1>
    <!-- Form -->
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4 mb-4">
            <div>
                <x-label for="name">{{ __('Full Name') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="name" type="text" name="name" :value="old('name')" required autofocus
                    autocomplete="name" />
            </div>

            <div>
                <x-label for="email">{{ __('Email Address') }} <span class="text-rose-500">*</span></x-label>
                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
            </div>

            <x-auth.modal-foto />



        </div>

        {{-- <div class="flex items-center justify-between mt-6">
            <div class="mr-1">
                <label class="flex items-center" name="newsletter" id="newsletter">
                    <input type="checkbox" class="form-checkbox" />
                    <span class="text-sm ml-2">Email me about product news.</span>
                </label>
                                      
            </div>
        </div> --}}


        <x-button type="submit">
            {{ __('Registrarse') }}
        </x-button>

        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-6">
                <label class="flex items-start">
                    <input type="checkbox" class="form-checkbox mt-1" name="terms" id="terms" />
                    <span class="text-sm ml-2">
                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                            'terms_of_service' =>
                                '<a target="_blank" href="' .
                                route('terms.show') .
                                '" class="text-sm underline hover:no-underline">' .
                                __('Terms of Service') .
                                '</a>',
                            'privacy_policy' =>
                                '<a target="_blank" href="' .
                                route('policy.show') .
                                '" class="text-sm underline hover:no-underline">' .
                                __('Privacy Policy') .
                                '</a>',
                        ]) !!}
                    </span>
                </label>
            </div>
        @endif
    </form>
    <x-validation-errors class="mt-4" />
    <!-- Footer -->
    <div class="pt-5 mt-6 border-t border-slate-200">
        <div class="text-sm">
            {{ __('¿Tienes una cuenta?') }} <a class="font-medium text-indigo-500 hover:text-indigo-600"
                href="{{ route('login') }}">{{ __('Iniciar sesion') }}</a>
        </div>
    </div>
</x-authentication-layout>
