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
        <div class="flex flex-col flex-1 items-stretch h-100">
            <div class="flex flex-col items-stretch flex-1 pb-5 mx-auto h-100 min-h-[500px] w-full">
                <div class="relative flex-1 w-full h-100">
                    <div class="flex justify-between items-center w-full h-100 bg-pink- overflow-hidden border border-dashed bg-gradient-to-br from-white to-zinc-50 rounded-lg border-zinc-200 dark:border-gray-700 dark:from-gray-950 dark:via-gray-900 dark:to-gray-800 max-h-[500px]">
                        <div class="flex relative flex-col p-10">
                            <div class="flex items-center pb-5 mb-5 space-x-1.5 text-lg font-bold text-gray-800 uppercase border-b border-dotted border-zinc-200 dark:border-gray-800 dark:text-gray-200">
                                <x-ui.logo class="block w-auto h-7 text-gray-800 fill-current dark:text-gray-200" />
                                <span>Genesis</span>
                            </div>
                            <p class="mb-5 text-sm text-zinc-500 dark:text-gray-400">This is the default dashboard which you can use and customize. Alternatively we also have three dashboard starter templates available.</p>
                            <p class="text-sm text-zinc-500 dark:text-gray-400">You can get all three designs, each with dark mode for only $29. Learn more below.</p>
                            <div class="flex items-center my-6 space-x-3">
                                <x-ui.button href="https://tonylea.lemonsqueezy.com/checkout/buy/7b997498-2512-4d24-8aa6-6027c5a22922?logo=0" tag="a" target="_blank" type="primary"><x-phosphor-storefront-duotone class="mr-1 w-4 h-4" /> Get It Here</x-ui.button>
                                <x-ui.button href="https://www.youtube.com/watch?v=bkdXxmeh0Aw" tag="a" target="_blank" type="secondary"><x-phosphor-popcorn-duotone class="mr-1 w-4 h-4" />Video Preview</x-ui.button>
                            </div>
                            <p class="text-sm text-zinc-600 dark:text-gray-300">Thanks for using Genesis ✌️</p>
                        </div>
                        <img src="https://cdn.devdojo.com/images/february2024/dashboards.png" alt="Dashboard" class="object-cover w-2/3 h-full rounded-lg" />
                    </div>
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>