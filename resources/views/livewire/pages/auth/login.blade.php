<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
//		$this->redirectIntended(default: route('index', absolute: false), navigate: true);
        $this->redirect(URL::to('/'), navigate: true);
    }
}; ?>

<div class="
{{--max-h-[250px]--}}
">

    <div class="
{{--    h-[200px]--}}
    ">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <form wire:submit="login">
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                              required autofocus autocomplete="username"/>
                <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('auth.Password')"/>

                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required autocomplete="current-password"/>

                <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                           name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('auth.Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                       href="{{ route('password.request') }}" wire:navigate>
                        {{ __('auth.Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('auth.Log in') }}
                </x-primary-button>
            </div>
        </form>

{{--         href="https://oauth.telegram.org/auth?bot_id={{ env('TELEGRAM_BOT_TOKEN') }}&origin={{ env('APP_URL') }}&return_to={{ env('TELEGRAM_REDIRECT_URL' )}}"--}}
        <a href="https://oauth.telegram.org/auth?bot_id={{ env('TELEGRAM_BOT_TOKEN') }}&origin={{ env('APP_URL') }}&return_to={{ env('TELEGRAM_REDIRECT_URL' )}}" >Войти через Telegram</a>
{{--        https://oauth.telegram.org/auth?bot_id=1234567890&origin=https://mywebsite.com&return_to=https://mywebsite.com/auth/telegram/callback--}}

        {{--        <a href="{{ url('/auth/telegram') }}" class="btn btn-primary">--}}
{{--            Войти через Telegram--}}
{{--        </a>--}}

    </div>
</div>
