<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('dashboard');
middleware(['auth', 'verified']);

new class extends Component
{
};
?>

<x-layouts.app>
    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @volt('dashboard')
        <div class="flex flex-col items-stretch flex-1 h-100">
            <div class="flex flex-col items-stretch flex-1 w-full pb-5 mx-auto h-100 min-h-[500px] max-w-7xl sm:px-6 lg:px-8">
                <div class="relative flex-1 w-full h-100">
                    <x-ui.placeholder />
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>