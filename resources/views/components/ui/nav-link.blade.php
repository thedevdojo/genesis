@props([
    'href' => '/'
])

@php
    $active = Request::is(($href == '/') ? '/' : trim($href, '/'));
@endphp

<a 
    {{ $attributes }} class="@if($active){{ 'bg-slate-200/60 text-slate-900 dark:bg-slate-900 dark:text-white' }}@endif inline-block sm:w-auto w-full px-4 py-2 text-sm rounded-full text-slate-700 dark:text-slate-200 dark:hover:bg-slate-900 dark:hover:text-white hover:bg-slate-200/60 hover:text-slate-900" 
    href="{{ $href }}"
    @if($active) aria-current="page" @endif
>
    {{ $slot }}
</a>
