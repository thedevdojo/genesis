<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use function Laravel\Folio\{middleware, name};
use Livewire\Volt\Component;

name('learn');
middleware(['auth', 'verified']);

new class extends Component {
    public $readme = '';

    public function mount()
    {
        // The README that ships with the app, so the docs match the installed version and nothing is fetched at runtime
        $this->readme = File::exists(base_path('README.md')) ? File::get(base_path('README.md')) : '';
    }
};

?>

<style>
    .dark img[alt="Genesis Logo"] {
        filter: invert(1);
    }
</style>

<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Learn More') }}
        </h2>
    </x-slot>

    @volt('learn')
        <div class="relative w-full mx-auto">
            <p class="hidden text-sm font-medium leading-none text-gray-500 translate-y-5 sm:block">This page shows your project's <code>README.md</code>. The latest version is on the <a href="https://github.com/thedevdojo/genesis" target="_blank" class="underline">Genesis repository</a>.</p>
            <article class="flex flex-col justify-center w-full max-w-full p-10 mx-auto prose-sm prose bg-white border rounded-md shadow-sm prose-md dark:prose-invert lg:prose-lg sm:my-10 border-gray-200/60 dark:bg-gray-900/50 dark:border-gray-200/10">
                {!! Str::markdown($readme) !!}
            </article>
        </div>
    @endvolt
</x-layouts.app>
