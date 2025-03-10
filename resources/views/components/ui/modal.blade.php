@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
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

<div wire:key="{{ $name }}" wire:ignore class="relative">
    @teleport('body')
        <div
                x-data="{
                showModal: @js($show),
                focusables() {
                    // All focusable element types...
                    let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
                    return [...$el.querySelectorAll(selector)]
                        // All non-disabled elements...
                        .filter(el => ! el.hasAttribute('disabled'))
                },
                firstFocusable() { return this.focusables()[0] },
                lastFocusable() { return this.focusables().slice(-1)[0] },
                nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
                prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
                nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
                prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
            }"
            x-init="$watch('showModal', value => {
                if (value) {
                    document.body.classList.add('overflow-y-hidden');
                    {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
                } else {
                    document.body.classList.remove('overflow-y-hidden');
                }
            })"
            x-on:open-modal.window="$event.detail == '{{ $name }}' ? showModal = true : null"
            x-on:close.stop="showModal = false"
            x-on:keydown.escape.window="showModal = false"
            x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
            x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
            x-show="showModal" 
            class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>

            <div x-show="showModal" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                @click="showModal=false" class="absolute inset-0 w-full h-full bg-black bg-opacity-40"></div>
            <div x-show="showModal"
                x-trap.inert.noscroll="showModal"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full bg-white dark:bg-gray-900 dark:border dark:border-white/10 {{ $maxWidth }} sm:rounded-lg">
                {{ $slot }}
                <button @click="showModal=false" class="absolute top-0 right-0 flex items-center justify-center w-8 h-8 mt-5 mr-5 text-gray-600 rounded-full dark:text-gray-500 hover:text-gray-800 dark:hover:text-gray-100 dark:hover:bg-gray-800 hover:bg-gray-50">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>  
                </button>

            </div>
        </div>
    @endteleport
</div>
