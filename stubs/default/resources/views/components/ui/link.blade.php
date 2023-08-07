<a
    {{ $attributes->except('wire:navigate') }}
    wire:navigate
>
{{ $slot }}
</a>