<?php

use function Laravel\Folio\{name};

name('genesis.about');

?>

<x-layouts.marketing>

    <div class="w-full">

        <x-ui.marketing.breadcrumbs :crumbs="[ ['text' => 'About'] ]" />

        <div class="flex items-center justify-center w-full pt-24">
            <div class="w-full max-w-xl lg:shrink-0 xl:max-w-2xl">
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-6xl">Built with the TALL stack including Folio and Volt</h1>
                <p class="relative mt-6 text-lg leading-8 text-slate-600 dark:text-slate-400 sm:max-w-md lg:max-w-none">Genesis combines the power of Laravel, the TALL Stack, Folio, and Volt. This powerful combination will help you bring your ideas to life effortlessly.</p>
            </div>
        </div>

        <div class="grid max-w-2xl grid-cols-1 gap-2 mx-auto mt-4 bg-opacity-25 lg:pt-0 md:grid-cols-2 lg:gap-4 lg:gap-y-1">
            <div>
                <a href="https://laravel.com/docs" target="_blank" class="relative flex items-center px-4 py-3 mt-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-900/80 dark:hover:bg-gray-900 dark:border-gray-500/20 group gap-x-2.5 hover:bg-white">
                    <span class="flex items-center justify-center flex-none w-8 h-8">
                        <svg class="w-7 h-7 text-[#FF2D20] fill-current" viewBox="0 0 50 52" xmlns="http://www.w3.org/2000/svg"><path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.01-.142.028-.21.006-.023.02-.044.028-.067.015-.042.029-.085.051-.124.015-.026.037-.047.055-.071.023-.032.044-.065.071-.093.023-.023.053-.04.079-.06.029-.024.055-.05.088-.069h.001l9.61-5.533a.802.802 0 0 1 .8 0l9.61 5.533h.002c.032.02.059.045.088.068.026.02.055.038.078.06.028.029.048.062.072.094.017.024.04.045.054.071.023.04.036.082.052.124.008.023.022.044.028.068a.809.809 0 0 1 .028.209v20.559l8.008-4.611v-10.51c0-.07.01-.141.028-.208.007-.024.02-.045.028-.068.016-.042.03-.085.052-.124.015-.026.037-.047.054-.071.024-.032.044-.065.072-.093.023-.023.052-.04.078-.06.03-.024.056-.05.088-.069h.001l9.611-5.533a.801.801 0 0 1 .8 0l9.61 5.533c.034.02.06.045.09.068.025.02.054.038.077.06.028.029.048.062.072.094.018.024.04.045.054.071.023.039.036.082.052.124.009.023.022.044.028.068zm-1.574 10.718v-9.124l-3.363 1.936-4.646 2.675v9.124l8.01-4.611zm-9.61 16.505v-9.13l-4.57 2.61-13.05 7.448v9.216l17.62-10.144zM1.602 7.719v31.068L19.22 48.93v-9.214l-9.204-5.209-.003-.002-.004-.002c-.031-.018-.057-.044-.086-.066-.025-.02-.054-.036-.076-.058l-.002-.003c-.026-.025-.044-.056-.066-.084-.02-.027-.044-.05-.06-.078l-.001-.003c-.018-.03-.029-.066-.042-.1-.013-.03-.03-.058-.038-.09v-.001c-.01-.038-.012-.078-.016-.117-.004-.03-.012-.06-.012-.09V12.33L4.965 9.654 1.602 7.72zm8.81-5.994L2.405 6.334l8.005 4.609 8.006-4.61-8.006-4.608zm4.164 28.764 4.645-2.674V7.719l-3.363 1.936-4.646 2.675v20.096l3.364-1.937zM39.243 7.164l-8.006 4.609 8.006 4.609 8.005-4.61-8.005-4.608zm-.801 10.605-4.646-2.675-3.363-1.936v9.124l4.645 2.674 3.364 1.937v-9.124zM20.02 38.33l11.743-6.704 5.87-3.35-8-4.606-9.211 5.303-8.395 4.833 7.993 4.524z" fill="currentColor" fill-rule="evenodd"/></svg>
                    </span>
                    <span class="flex flex-col justify-center h-full opacity-70 dark:opacity-80 group-hover:opacity-100 text-[0.65rem]">
                        <span class="relative flex items-center mt-0 mb-0.5 text-sm font-semibold leading-none text-gray-900 dark:text-gray-100">Laravel</span>
                        <span href="https://laravel.com/docs" class="inline-flex items-center font-normal leading-none text-gray-700 dark:text-gray-200">View the Docs</span>
                    </span>
                </a>
            </div>
            <div>
                <a href="https://livewire.laravel.com/docs" target="_blank" class="relative flex items-center px-4 py-3 mt-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-900/80 dark:hover:bg-gray-900 dark:border-gray-500/20 group gap-x-2.5 hover:bg-white">
                    <span class="flex items-center justify-center flex-none w-8 h-8">
                        <svg class="w-7 h-7" viewBox="0 0 39 44" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M36.72 29.234c-.717 1.084-1.262 2.42-2.72 2.42-2.455 0-2.588-3.784-5.044-3.784-2.456 0-2.323 3.785-4.777 3.785-2.455 0-2.588-3.785-5.043-3.785-2.456 0-2.324 3.785-4.778 3.785-2.455 0-2.587-3.785-5.043-3.785s-2.323 3.785-4.778 3.785c-.771 0-1.313-.374-1.77-.887C1.01 27.712 0 24.13 0 20.3 0 9.09 8.66 0 19.345 0c10.683 0 19.344 9.089 19.344 20.3 0 3.206-.708 6.238-1.969 8.934Z" fill="#FB70A9"/><mask id="a" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="23" width="26" height="21"><path d="M11.62 27.23v8.408a2.732 2.732 0 0 1-5.465 0v-10.15c.51-.937 1.093-1.747 2.143-1.747 1.71 0 2.307 2.148 3.321 3.489Zm10.32.438v13.296a3.036 3.036 0 0 1-6.07 0V25.915c.57-1.102 1.16-2.174 2.368-2.174 1.912 0 2.433 2.687 3.703 3.927Zm9.715-.244v9.653a2.732 2.732 0 1 1-5.465 0V25.212c.476-.814 1.043-1.471 1.988-1.471 1.795 0 2.364 2.367 3.477 3.683Z" fill="white"/></mask><g mask="url(#a-folio)"><path d="M11.62 27.23v8.408a2.732 2.732 0 0 1-5.465 0v-10.15c.51-.937 1.093-1.747 2.143-1.747 1.71 0 2.307 2.148 3.321 3.489Zm10.32.438v13.296a3.036 3.036 0 0 1-6.07 0V25.915c.57-1.102 1.16-2.174 2.368-2.174 1.912 0 2.433 2.687 3.703 3.927Zm9.715-.244v9.653a2.732 2.732 0 1 1-5.465 0V25.212c.476-.814 1.043-1.471 1.988-1.471 1.795 0 2.364 2.367 3.477 3.683Z" fill="#4E56A6"/></g><mask id="b" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="6" y="18" width="26" height="15"><path d="M11.62 29.807c-.485-.594-1.059-1.034-1.889-1.034-1.97 0-2.332 2.483-3.576 3.602v-10.71a2.732 2.732 0 1 1 5.464 0v8.142Zm10.32.191c-.516-.687-1.12-1.225-2.037-1.225-2.192 0-2.393 3.073-4.034 3.923V27.96a3.036 3.036 0 0 1 6.072 0v2.038Zm9.715-.531c-.42-.414-.92-.694-1.58-.694-2.124 0-2.38 2.884-3.884 3.837v-9.613a2.732 2.732 0 1 1 5.464 0v6.47Z" fill="white"/></mask><g mask="url(#b)"><path d="M11.62 29.807c-.485-.594-1.059-1.034-1.889-1.034-1.97 0-2.332 2.483-3.576 3.602v-10.71a2.732 2.732 0 1 1 5.464 0v8.142Zm10.32.191c-.516-.687-1.12-1.225-2.037-1.225-2.192 0-2.393 3.073-4.034 3.923V27.96a3.036 3.036 0 0 1 6.072 0v2.038Zm9.715-.531c-.42-.414-.92-.694-1.58-.694-2.124 0-2.38 2.884-3.884 3.837v-9.613a2.732 2.732 0 1 1 5.464 0v6.47Z" fill="black" fill-opacity="0.298514"/></g><path fill-rule="evenodd" clip-rule="evenodd" d="M36.72 29.234c-.717 1.084-1.262 2.42-2.72 2.42-2.455 0-2.588-3.784-5.044-3.784-2.456 0-2.323 3.785-4.777 3.785-2.455 0-2.588-3.785-5.043-3.785-2.456 0-2.324 3.785-4.778 3.785-2.455 0-2.587-3.785-5.043-3.785s-2.323 3.785-4.778 3.785c-.771 0-1.313-.374-1.77-.887C1.01 27.712 0 24.13 0 20.3 0 9.09 8.66 0 19.345 0c10.683 0 19.344 9.089 19.344 20.3 0 3.206-.708 6.238-1.969 8.934Z" fill="#FB70A9"/><path fill-rule="evenodd" clip-rule="evenodd" d="M32.534 31.25c5.07-7.541 5.2-15.906.393-25.095a20.248 20.248 0 0 1 5.762 14.188c0 3.194-.734 6.214-2.04 8.9-.744 1.08-1.31 2.412-2.821 2.412-.517 0-.935-.156-1.294-.405Z" fill="#E24CA6"/><path fill-rule="evenodd" clip-rule="evenodd" d="M18.307 25.364c6.728 0 9.56-3.902 9.56-9.445 0-5.542-4.28-10.643-9.56-10.643s-9.56 5.101-9.56 10.643c0 5.543 2.833 9.445 9.56 9.445Z" fill="white"/><path d="M15.737 16.233c1.98 0 3.585-1.771 3.585-3.957 0-2.185-1.605-3.956-3.585-3.956s-3.585 1.771-3.585 3.956c0 2.186 1.605 3.957 3.585 3.957Z" fill="#030776"/><path d="M15.14 13.19c.99 0 1.792-.818 1.792-1.827 0-1.008-.802-1.826-1.792-1.826s-1.793.818-1.793 1.826c0 1.009.803 1.827 1.793 1.827Z" fill="white"/></svg>
                    </span>
                    <span class="flex flex-col justify-center h-full opacity-70 dark:opacity-80 group-hover:opacity-100 text-[0.65rem]">
                        <span class="relative flex items-center mt-0 mb-0.5 text-sm font-semibold leading-none text-gray-900 dark:text-gray-100">Livewire</span>
                        <span href="https://laravel.com/docs" class="inline-flex items-center font-normal leading-none text-gray-700 dark:text-gray-200">View the Docs</span>
                    </span>
                </a>
            </div>
            <div>
                <a href="https://alpinejs.dev/docs" target="_blank" class="relative flex items-center px-4 py-3 mt-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-900/80 dark:hover:bg-gray-900 dark:border-gray-500/20 group gap-x-2.5 hover:bg-white">
                    <span class="flex items-center justify-center flex-none w-8 h-8">
                        <svg class="w-7 h-7" viewBox="0 0 55 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="m42.753 0 12.112 12.06-12.112 12.058L30.641 12.06 42.753 0Z" fill="#77C1D2"/><path fill-rule="evenodd" clip-rule="evenodd" d="m12.473 0 25.11 25H13.358L.36 12.06 12.473 0Z" fill="#2D3441"/></svg>
                    </span>
                    <span class="flex flex-col justify-center h-full opacity-70 dark:opacity-80 group-hover:opacity-100 text-[0.65rem]">
                        <span class="relative flex items-center mt-0 mb-0.5 text-sm font-semibold leading-none text-gray-900 dark:text-gray-100">Alpine</span>
                        <span href="https://laravel.com/docs" class="inline-flex items-center font-normal leading-none text-gray-700 dark:text-gray-200">View the Docs</span>
                    </span>
                </a>
            </div>
            <div>
                <a href="https://tailwindcss.com/docs" target="_blank" class="relative flex items-center px-4 py-3 mt-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-900/80 dark:hover:bg-gray-900 dark:border-gray-500/20 group gap-x-2.5 hover:bg-white">
                    <span class="flex items-center justify-center flex-none w-8 h-8">
                        <svg class="w-7 h-7" viewBox="0 0 50 31" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#tailwind-icon)"><path fill-rule="evenodd" clip-rule="evenodd" d="M25 0c-6.667 0-10.833 3.382-12.5 10.146 2.5-3.382 5.417-4.65 8.75-3.805 1.902.482 3.261 1.882 4.766 3.432 2.45 2.524 5.288 5.445 11.484 5.445 6.667 0 10.833-3.382 12.5-10.145-2.5 3.382-5.417 4.65-8.75 3.804-1.902-.482-3.261-1.882-4.766-3.431C34.034 2.922 31.196 0 25 0ZM12.5 15.218C5.833 15.218 1.667 18.6 0 25.364c2.5-3.382 5.417-4.65 8.75-3.805 1.902.483 3.261 1.883 4.766 3.432 2.45 2.524 5.288 5.445 11.484 5.445 6.667 0 10.833-3.381 12.5-10.145-2.5 3.382-5.417 4.65-8.75 3.805-1.902-.483-3.261-1.883-4.766-3.432-2.45-2.524-5.288-5.446-11.484-5.446Z" fill="#38BDF8"/></g><defs><clipPath id="a"><rect width="50" height="31" fill="white"/></clipPath></defs></svg>
                    </span>
                    <span class="flex flex-col justify-center h-full opacity-70 dark:opacity-80 group-hover:opacity-100 text-[0.65rem]">
                        <span class="relative flex items-center mt-0 mb-0.5 text-sm font-semibold leading-none text-gray-900 dark:text-gray-100">Tailwind</span>
                        <span href="https://laravel.com/docs" class="inline-flex items-center font-normal leading-none text-gray-700 dark:text-gray-200">View the Docs</span>
                    </span>
                </a>
            </div>
            <div>
                <a href="https://github.com/laravel/folio" target="_blank" class="relative flex items-center px-4 py-3 mt-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-900/80 dark:hover:bg-gray-900 dark:border-gray-500/20 group gap-x-2.5 hover:bg-white">
                    <span class="flex items-center justify-center flex-none w-8 h-8">
                        <svg class="w-7 h-7" viewBox="0 0 96 96" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M48 96c26.51 0 48-21.49 48-48S74.51 0 48 0 0 21.49 0 48s21.49 48 48 48Z" fill="#4F46E5"/><mask id="a-folio" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="96" height="96"><path d="M48 96c26.51 0 48-21.49 48-48S74.51 0 48 0 0 21.49 0 48s21.49 48 48 48Z" fill="white"/></mask><g mask="url(#a-folio)"><path d="M79 22H21v78h58V22Z" fill="#818CF8"/><path d="M72.5 107h-58V29h38l20 20v58Z" fill="#F7F8FF"/><path d="M72.5 49h-20V29l20 20Z" fill="#C7D2FF"/></g></svg>
                    </span>
                    <span class="flex flex-col justify-center h-full opacity-70 dark:opacity-80 group-hover:opacity-100 text-[0.65rem]">
                        <span class="relative flex items-center mt-0 mb-0.5 text-sm font-semibold leading-none text-gray-900 dark:text-gray-100">Laravel Folio</span>
                        <span href="https://laravel.com/docs" class="inline-flex items-center font-normal leading-none text-gray-700 dark:text-gray-200">View the Docs</span>
                    </span>
                </a>
            </div>
            <div>
                <a href="https://livewire.laravel.com/docs/volt" target="_blank" class="relative flex items-center px-4 py-3 mt-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-900/80 dark:hover:bg-gray-900 dark:border-gray-500/20 group gap-x-2.5 hover:bg-white">
                    <span class="flex items-center justify-center flex-none w-8 h-8">
                        <svg class="w-7 h-7" viewBox="0 0 27 56" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26.5 24H15.9l4.6-24-20 26h11.8L2.5 56l24-32Z" fill="#FFD001"/></svg>
                    </span>
                    <span class="flex flex-col justify-center h-full opacity-70 dark:opacity-80 group-hover:opacity-100 text-[0.65rem]">
                        <span class="relative flex items-center mt-0 mb-0.5 text-sm font-semibold leading-none text-gray-900 dark:text-gray-100">Laravel Volt</span>
                        <span href="https://laravel.com/docs" class="inline-flex items-center font-normal leading-none text-gray-700 dark:text-gray-200">View the Docs</span>
                    </span>
                </a>
            </div>
        </div>

    </div>
</x-layouts.marketing>