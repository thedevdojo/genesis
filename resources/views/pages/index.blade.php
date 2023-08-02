<?php

use function Laravel\Folio\{middleware};
use function Livewire\Volt\{state, rules};

middleware(['redirect-to-dashboard']);

?>

<x-layouts.app>

    @volt('home')
        <div class="flex flex-col items-center min-h-screen pt-6 sm:justify-center sm:pt-0 dark:bg-gray-900">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <x-ui.link href="/">
                    <x-logo class="w-auto h-12 mx-auto text-gray-800 fill-current" />
                </x-ui.link>

                <h1 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                    Welcome to Genesis
                </h1>
                <div class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                    <x-ui.text-link href="/auth/login">
                        Login
                    </x-ui.text-link>
                    or
                    <x-ui.text-link href="/auth/register">
                        create a new account
                    </x-ui.text-link>
                </div>
            </div>

            <div class="flex flex-col max-w-sm mx-auto mt-5 space-y-3">
                <x-ui.button type="secondary" tag="a" href="https://github.com/thedevdojo/genesis" target="_blank" class="px-5 py-2.5 text-sm text-center font-medium bg-gray-600 text-white/90 duration-200 ease-out rounded hover:text-white">Visit the Documentation</x-ui.button>
                <x-ui.button type="primary" tag="a" href="https://github.com/thedevdojo/genesis" target="_blank" class="px-5 py-2.5 text-sm text-center font-medium bg-gray-800 hover:bg-gray-900 text-white rounded text-white/90 duration-200 ease-out hover:text-white">Visit the Github Repo</x-ui.button>
            </div>
        </div>
    @endvolt

</x-layouts.app>
