<?php

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('dashboard');
middleware(['auth', 'verified']);

new class extends Component
{
    public $stats = [
        [
            'name' => 'Total Users',
            'value' => '1,234',
            'change' => '+12%',
            'icon' => 'phosphor-users-duotone',
        ],
        [
            'name' => 'Revenue',
            'value' => '$12,345',
            'change' => '+8%',
            'icon' => 'phosphor-currency-dollar-duotone',
        ],
        [
            'name' => 'Active Sessions',
            'value' => '456',
            'change' => '-3%',
            'icon' => 'phosphor-chart-line-up-duotone',
        ],
    ];

    public $activities = [
        [
            'user' => 'Tony Lea',
            'action' => 'created a new project',
            'time' => '2 hours ago',
            'avatar' => 'https://i.pravatar.cc/150?u=tony',
        ],
        [
            'user' => 'Jane Doe',
            'action' => 'commented on your post',
            'time' => '4 hours ago',
            'avatar' => 'https://i.pravatar.cc/150?u=jane',
        ],
        [
            'user' => 'John Smith',
            'action' => 'uploaded a new file',
            'time' => '1 day ago',
            'avatar' => 'https://i.pravatar.cc/150?u=john',
        ],
        [
            'user' => 'Sarah Connor',
            'action' => 'updated her profile',
            'time' => '2 days ago',
            'avatar' => 'https://i.pravatar.cc/150?u=sarah',
        ],
    ];
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
            <div class="w-full mx-auto mb-6">
                @include('pages.dashboard.stats')
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 w-full h-full">
                <div class="lg:col-span-2 relative w-full h-full">
                    <div class="flex justify-between items-center w-full h-full bg-pink- overflow-hidden border border-dashed bg-gradient-to-br from-white to-zinc-50 rounded-lg border-zinc-200 dark:border-gray-700 dark:from-gray-950 dark:via-gray-900 dark:to-gray-800 max-h-[500px]">
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
                <div class="lg:col-span-1">
                     @include('pages.dashboard.activity')
                </div>
            </div>
        </div>
    @endvolt
</x-layouts.app>