@extends('layouts.base')

@section('body')

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('partials.nav')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @yield('content')

        @isset($slot)
            {{ $slot }}
        @endisset
        </main>
    </div>
    
@endsection
