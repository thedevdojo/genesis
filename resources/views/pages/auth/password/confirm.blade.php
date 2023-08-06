<?php

    namespace App\Http\Livewire\Auth\Passwords;

    use function Livewire\Volt\{state, rules};

    state(['password' => '']);
    rules(['password' => 'required|current_password']);

    $confirm = function(){
        $this->validate();

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    }
?>

<x-layouts.app>
    <div class="flex flex-col items-stretch justify-center w-screen h-screen sm:items-center">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="/">
                <x-logo class="w-auto h-12 mx-auto text-gray-800 fill-current" />
            </x-ui.link>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-800">
                Confirm your password
            </h2>
            <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                Please confirm your password before continuing
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white sm:border sm:rounded-lg border-gray-200/60">
                @volt('auth.password.confirm')
                    <form wire:submit="confirm" class="space-y-6">
                        <x-ui.input label="Password" type="password" id="password" name="password" wire:model="password" />
                        <div class="flex items-center justify-end text-sm">
                            <x-ui.text-link href="/auth/password/reset">Forgot your password?</x-ui.text-link>
                        </div>
                        <x-ui.button type="primary" submit="true">Confirm password</x-ui.button>
                    </form>
                @endvolt
            </div>
        </div>
    </div>

</x-layouts.app>