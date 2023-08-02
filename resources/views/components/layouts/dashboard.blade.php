<x-layouts.app>
    
    <x-ui.nav />

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white border-b border-gray-200/80 dark:bg-gray-800">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif
    
    {{ $slot }}

</x-layouts.app>