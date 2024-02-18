<?php

use Illuminate\Support\Facades\Http;

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{with, state, rules, mount};

name('learn');
middleware(['auth', 'verified']);

$res = Http::get('https://raw.githubusercontent.com/thedevdojo/genesis/main/README.md');

state(['readme' => $res->body()])


?>

<style>
    .dark img[alt="Genesis Logo"]{ filter: invert(1); }
</style>

<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Learn More') }}
        </h2>
    </x-slot>

    @volt('learn')
        <div class="relative w-full mx-auto">
            <p class="hidden text-sm font-medium leading-none text-gray-500 translate-y-5 sm:block">This page is pulled from the <a href="https://github.com/thedevdojo/genesis" target="_blank" class="underline">Genesis Readme Repository</a>.</p>
            <article class="flex flex-col justify-center w-full max-w-full p-10 mx-auto prose-sm prose bg-white border rounded-md shadow-sm prose-md dark:prose-invert lg:prose-lg sm:my-10 border-gray-200/60 dark:bg-gray-900/50 dark:border-gray-200/10">
                {!! Str::markdown($readme) !!}
            </article>
        </div>
    @endvolt
</x-layouts.app>