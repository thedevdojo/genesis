<x-ui.link
    {{ $attributes->except('wire:navigate') }}
    class="text-gray-500 underline hover:text-gray-800">
{{ $slot }}
</x-ui.link>