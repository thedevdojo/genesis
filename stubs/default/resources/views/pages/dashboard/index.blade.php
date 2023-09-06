<?php

use function Laravel\Folio\{middleware, name};
//use function Livewire\Volt\{state};

name('dashboard');
middleware(['auth', 'verified']);

?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @volt('dashboard')
        <div class="h-full py-12">
            <div class="h-full mx-auto max-w-7xl sm:px-6 lg:px-8">
                
                <div class="relative min-h-[500px] w-full h-full">
                    <x-ui.placeholder />
                </div>

            </div>
        </div>
    @endvolt
</x-layouts.app>