<?php

use function Laravel\Folio\name;

name('genesis.power-ups');

?>

<x-layouts.marketing>

    @php
    $powerups = [
        [
            'name' => 'Blog',
            'icon' => '📝',
            'description' => 'Adds a simple blog to your application: a paginated post list, single post pages, a Post model, a migration and a factory.',
            'repo' => 'thedevdojo/blog-genesis',
            'pages' => ['pages/blog/index.blade.php', 'pages/blog/[Post:slug].blade.php'],
            'models' => ['App\Models\Post'],
            'tables' => ['posts'],
        ],
    ];
    @endphp

    <div class="w-full">
        <x-ui.marketing.breadcrumbs :crumbs="[['text' => 'Power-ups']]" />
        <x-ui.marketing.page-header title="Power-Ups" description="Power-ups offer additional features to help you supercharge the beginning of your application journey." />

        <div class="w-full max-w-6xl px-8 mx-auto">

            <div class="relative w-full p-6 pl-12 text-yellow-700 border border-yellow-200 rounded-lg dark:border-transparent dark:bg-yellow-500 dark:text-white bg-yellow-50">
                <svg class="absolute w-5 h-5 -translate-x-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                <div class="text-sm opacity-80 dark:opacity-100">Power-ups are meant to be added to a new local app. Before deploying to production you will want to remove the <code>pages/genesis</code> folder.</div>
            </div>

            <div class="grid w-full grid-cols-1 gap-8 mt-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($powerups as $powerup)
                    <div class="flex flex-col p-5 bg-white border shadow-sm dark:bg-gray-900 rounded-xl border-slate-100 dark:border-white/10">
                        <span class="flex items-center text-lg font-semibold dark:text-white space-x-1.5">
                            <span class="flex items-center justify-center text-lg">{{ $powerup['icon'] }}</span>
                            <span>{{ $powerup['name'] }}</span>
                        </span>
                        <p class="pt-1.5 pb-3 text-sm text-slate-800/60 dark:text-white/50">{{ $powerup['description'] }}</p>

                        <dl class="pb-4 space-y-2 text-xs text-slate-700 dark:text-slate-300">
                            @foreach (['pages' => 'Pages', 'models' => 'Models', 'tables' => 'Tables'] as $key => $label)
                                <div>
                                    <dt class="font-semibold">{{ $label }}</dt>
                                    @foreach ($powerup[$key] as $item)
                                        <dd class="font-mono">{{ $item }}</dd>
                                    @endforeach
                                </div>
                            @endforeach
                        </dl>

                        <a href="https://github.com/{{ $powerup['repo'] }}" target="_blank" rel="noopener" class="inline-flex items-center self-start px-3 py-1.5 mt-auto space-x-1 text-xs font-normal rounded-full bg-slate-100 dark:text-slate-100 dark:bg-gray-800 text-slate-700">
                            <svg class="flex w-5 h-5 -ml-1 fill-current" aria-hidden="true" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="underline">github.com/{{ $powerup['repo'] }}</span>
                        </a>
                    </div>
                @endforeach

                <div class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-dashed rounded-md border-gray-200/70 dark:border-slate-700 dark:bg-gray-800/50 dark:text-gray-400">
                    More Power-ups coming soon.
                </div>
            </div>

            <div class="pt-8 mt-10 prose-sm prose border-t dark:prose-invert border-slate-200 dark:border-gray-800">
                <h3>Adding a power-up</h3>
                <p>A power-up is a set of files laid out like a Genesis app, so you add one by hand:</p>
                <ol>
                    <li>Copy the files from the power-up's repo into the same paths in your app. Skip the <code>_ignore</code> folder, the <code>README.md</code> and <code>powerup.json</code>.</li>
                    <li>Run <code>php artisan migrate</code> to create its tables.</li>
                    <li>Optionally seed some data with its factory, e.g. <code>App\Models\Post::factory(10)->create()</code> in <code>php artisan tinker</code>.</li>
                    <li>Restart <code>npm run dev</code> so Tailwind picks up the classes in the new views.</li>
                </ol>
            </div>
        </div>
    </div>

</x-layouts.marketing>
