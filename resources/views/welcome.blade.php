<x-layouts.app>

    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">
        
        <div class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
            @auth
                <a href="{{ route('home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Home</a>
            @else
                <a href="/auth/login" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log in</a>
                <a href="/auth/register" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
            @endauth
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="{{ route('home') }}">
                <x-logo class="w-auto h-12 mx-auto text-indigo-600 fill-current" />
            </a>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                Welcome to Genesis
            </h2>
            <p class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                <a href="/auth/login" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                    Login
                </a>
                or
                <a href="/auth/register" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                    create a new account
                </a>
            </p>
        </div>

        <div class="flex flex-col max-w-sm mx-auto mt-5 space-y-3">
            <a href="/docs" class="px-5 py-2.5 text-sm text-center font-medium bg-indigo-600 text-white/90 duration-200 ease-out rounded hover:text-white">Visit the Documentation</a>
            <a href="" class="px-5 py-2.5 text-sm text-center font-medium bg-gray-800 hover:bg-gray-900 text-white rounded text-white/90 duration-200 ease-out hover:text-white">Visit the Github Repo</a>
        </div>

        
    </div>

</x-layouts.app>
