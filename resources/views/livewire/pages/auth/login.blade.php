<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        
        $this->redirect(
            session('url.intended', '/admin/dashboard'),
        );
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
 
    <form action="#" wire:submit.prevent="login">
        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
            Login
        </h1>
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Email</span>
            <input wire:model="form.email"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="example@example.com">
            @error('form.email')
                <div class="text-red-800">
                    {{ $message }}
                </div>
            @enderror
        </label>
        <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">Password</span>
            <input wire:model="form.password"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="***************" type="password">
            @error('form.password')
                <div class="text-red-800">
                    {{ $message }}
                </div>
            @enderror
        </label>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600 ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- You should use a button here, as the anchor is only used for the example  -->
        <button type="submit"
            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <div class="text" wire:loading.remove wire:target="login">
                Log in
            </div>
            <div class="loading" wire:loading wire:target="login">
                <i class="text-xl leading-none las la-circle-notch la-spin"></i>
            </div>
        </button>
    </form>
</div>
