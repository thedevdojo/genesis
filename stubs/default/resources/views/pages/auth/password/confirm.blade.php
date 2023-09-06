<?php

    use function Laravel\Folio\name;
    use function Livewire\Volt\{state, rules};

    state(['password' => '']);
    rules(['password' => 'required|current_password']);
    name('password.confirm');

    $confirm = function(){
        $this->validate();

        session()->put('auth.password_confirmed_at', time());

        return redirect()->intended('/');
    };
?>

<x-layouts.main>
    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen py-10 sm:items-center">

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="{{ route('home') }}">
                <x-ui.logo class="w-auto h-10 mx-auto text-gray-700 fill-current dark:text-gray-100" />
            </x-ui.link>

            <h2 class="mt-5 text-2xl font-extrabold leading-9 text-center text-gray-800 dark:text-gray-200">
                Confirm your password
            </h2>
            <p class="text-sm leading-5 text-center text-gray-600 dark:text-gray-400 space-x-0.5">
                Please confirm your password before continuing
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white dark:sm:bg-gray-950/50 dark:border-gray-200/10 sm:border sm:rounded-lg border-gray-200/60">
                @volt('auth.password.confirm')
                    <form wire:submit="confirm" class="space-y-6">
                        <x-ui.input label="Password" type="password" id="password" name="password" wire:model="password" />
                        <div class="flex items-center justify-end text-sm">
                            <x-ui.text-link href="{{ route('password.request') }}">Forgot your password?</x-ui.text-link>
                        </div>
                        <x-ui.button type="primary" rounded="md" submit="true">Confirm password</x-ui.button>
                    </form>
                @endvolt
            </div>
        </div>
    </div>

</x-layouts.main>