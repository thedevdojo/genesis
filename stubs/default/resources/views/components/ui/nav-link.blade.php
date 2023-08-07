@props(['active'])

@php
$classes = ($active ?? false)
            ? 'rounded-md py-0.5 text-sm font-semibold text-gray-600 group relative text-gray-800'
            : 'rounded-md py-0.5 text-sm font-semibold text-gray-600 group relative hover:text-gray-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span>{{ $slot }}</span>
    
    <span class="absolute bottom-0 ease-out duration-300 h-0.5 bg-gray-800 group-hover:w-full @if($active ?? false){{ 'w-full left-0' }}@else{{ 'w-0 group-hover:w-full left-1/2 group-hover:left-0' }}@endif"></span>
</a>