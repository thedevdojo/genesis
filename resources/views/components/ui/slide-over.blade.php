@props([
    'name',
    'title' => 'Slide-over Title',
    'open' => false,
    'maxWidth' => 'md'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div x-data="{ 
        slideOverOpen: @js($open), 
    }"
    wire:key="{{ $name }}"
    class="relative z-50 w-auto h-auto">
    <div @click="slideOverOpen=true">
        {{ $trigger }}
    </div>
    <template x-teleport="body">
        <div 
            x-show="slideOverOpen"
            @keydown.window.escape="slideOverOpen=false"
            class="relative z-[99]">
            <div x-show="slideOverOpen" x-transition.opacity.duration.600ms @click="slideOverOpen = false" class="fixed inset-0 bg-black bg-opacity-40 dark:bg-opacity-70"></div>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <div 
                            x-on:open-slide-over.window="$event.detail == '{{ $name }}' ? slideOverOpen = true : null"
                            x-on:close.stop="slideOverOpen = false"
                            x-on:keydown.escape.window="slideOverOpen = false"
                            x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
                            x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
                            x-show="slideOverOpen" 
                            @click.away="slideOverOpen = false"
                            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700" 
                            x-transition:enter-start="translate-x-full" 
                            x-transition:enter-end="translate-x-0" 
                            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700" 
                            x-transition:leave-start="translate-x-0" 
                            x-transition:leave-end="translate-x-full" 
                            class="w-screen {{ $maxWidth }}">
                            <div class="flex flex-col h-full py-5 overflow-y-scroll bg-white border-l shadow-lg dark:bg-gray-900 dark:border-gray-700/70 border-neutral-100/70">
                                <div class="px-4 sm:px-5">
                                    <div class="flex items-start justify-between pb-1">
                                        <h2 class="text-base font-semibold leading-6 text-gray-900 dark:text-gray-200">{{ $title }}</h2>
                                        <div class="flex items-center h-auto ml-3">
                                            <button @click="slideOverOpen=false" class="absolute top-0 right-0 z-30 flex items-center justify-center px-3 py-2 mt-4 mr-5 space-x-1 text-xs font-medium uppercase border rounded-md border-neutral-200 dark:border-gray-700/70 text-neutral-600 dark:text-neutral-400 hover:bg-neutral-100 dark:hover:bg-gray-700/70">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                <span>Close</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative flex-1 px-4 mt-5 sm:px-5">
                                    <div class="absolute inset-0 px-4 sm:px-5">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

