<x-ui.link
    {{ $attributes->except('wire:navigate') }}
    class="text-gray-500 dark:text-gray-400 dark:hover:text-gray-300 cursor-pointer underline hover:text-gray-800">
{{ $slot }}
</x-ui.link>