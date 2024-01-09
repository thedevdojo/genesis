<header class="w-full">
    <div class="relative z-20 flex items-center justify-between w-full h-20 max-w-6xl px-6 mx-auto">
        <div x-data="{ mobileMenuOpen: false }" class="relative flex items-center md:space-x-2 text-neutral-800">
            
            <div class="relative z-50 flex items-center w-auto h-full">
                <a href="{{ route('home') }}" class="flex items-center mr-0 md:mr-5 shrink-0">
                    <x-ui.logo class="block w-auto text-gray-800 fill-current h-7 dark:text-gray-200" />
                </a>
                <div @click="mobileMenuOpen=!mobileMenuOpen" class="relative flex items-center justify-center w-8 h-8 ml-5 overflow-hidden text-gray-500 bg-gray-100 rounded cursor-pointer md:hidden hover:text-gray-700 hover:bg-gray-200">
                    <div :class="{ 'rotate-0' : mobileMenuOpen }" class="flex flex-col items-center justify-center w-4 h-4 duration-300 ease-in-out">
                        <span :class="{ '-rotate-[135deg] translate-y-[5px]' : mobileMenuOpen }" class="block ease-in-out duration-300 w-full h-0.5 bg-gray-800 rounded-full"></span>
                        <span :class="{ 'w-0' : mobileMenuOpen, 'w-full' : !mobileMenuOpen }" class="block ease-in-out duration-300 w-full h-0.5 my-[3px] bg-gray-800 rounded-full"></span>
                        <span :class="{ '-rotate-45 -translate-y-[5px]' : mobileMenuOpen }" class="block ease-in-out duration-300 w-full h-0.5 bg-gray-800 rounded-full"></span>
                    </div>
                </div>
            </div>
            <div :class="{ 'flex' : mobileMenuOpen, 'hidden md:flex' :  !mobileMenuOpen }" class="fixed top-0 left-0 z-40 flex-col items-start justify-start hidden w-full h-full min-h-screen pt-20 space-y-5 text-sm font-medium duration-150 ease-out transform md:pt-0 text-neutral-500 md:h-auto md:min-h-0 md:left-auto md:items-center md:relative">
                
                <nav class="flex flex-col w-full p-6 space-y-2 bg-white md:p-0 md:flex-row md:space-x-2 md:space-y-0 md:w-auto md:bg-transparent md:flex">
                    <x-ui.nav-link href="/">Home</x-ui.nav-link>
                    <x-ui.nav-link href="/genesis/about">About</x-ui.nav-link>
                    @if(view()->exists('pages.blog.index'))
                        <x-ui.nav-link href="/blog">Blog</x-ui.nav-link>
                    @endif
                    <x-ui.nav-link href="/genesis/power-ups">Power-ups</x-ui.nav-link>
                </nav>
            </div>
        </div>
        <div class="relative z-50 flex items-stretch space-x-3 text-neutral-800">
            <div x-data class="flex-shrink-0 hidden w-[38px] overflow-hidden rounded-full h-[38px] sm:block" x-cloak>
                <x-ui.light-dark-switch></x-ui.light-dark-switch>
            </div>
            @auth
                <div class="flex items-center w-auto">
                    <x-ui.button type="primary" submit="true" tag="a" href="{{ route('dashboard') }}">View Dashboard</x-ui.button>
                </div>
            @else
                <div class="flex items-center w-auto">
                    <x-ui.button type="secondary" submit="true" tag="a" href="{{ route('login') }}">Login</x-ui.button>
                </div>
                <div class="flex items-center w-auto">
                    <x-ui.button type="primary" submit="true" tag="a" href="{{ route('register') }}">Sign Up</x-ui.button>
                </div>
            @endauth
            
        </div>
    </div>
</header>
