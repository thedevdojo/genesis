<?php

use Illuminate\Support\Facades\Http;

use function Laravel\Folio\{middleware};
use function Livewire\Volt\{with, state, rules, mount};
middleware(['auth', 'verified']);

$res = Http::get('https://raw.githubusercontent.com/thedevdojo/genesis/main/README.md');

state(['readme' => $res->body()])


?>

<x-layouts.dashboard>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Learn More') }}
        </h2>
    </x-slot>

    @volt('learn')
        <div class="max-w-7xl w-full relative sm:px-10 mx-auto">
        <p class="leading-none sm:block hidden translate-y-5 text-sm font-medium text-gray-500">This page is pulled from the <a href="https://github.com/thedevdojo/genesis" target="_blank" class="underline">Genesis Readme Repository</a>.</p>
        <article class="prose prose-sm prose-md lg:prose-lg w-full flex max-w-7xl flex-col justify-center bg-white sm:my-10 p-10 rounded-md border border-gray-200/60 shadow-sm mx-auto">
            {!! str_replace('align="center"', 'align="left"', Str::markdown($readme)) !!}
        </article>
        </div>
    @endvolt
</x-layouts.dashboard>