<x-layouts.main>
    
    <x-ui.app.header />

    <!-- Page Heading -->
    @if (isset($header))
        <header class="mb-5 bg-white border-b border-gray-200/80 dark:border-gray-200/10 dark:bg-gray-900/40">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    
    <div class="mx-auto mt-5 max-w-7xl">
        <div class="sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </div>

</x-layouts.main>