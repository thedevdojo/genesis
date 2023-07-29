<?php

use Illuminate\Support\Facades\Auth;
use function Laravel\Folio\{middleware};
use function Livewire\Volt\{state, rules};

middleware(['guest']);
state(['email' => '', 'password' => '', 'remember' => false]);
rules(['email' => 'required|email', 'password' => 'required']);

$authenticate = function(){
    $this->validate();

    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
        $this->addError('email', trans('auth.failed'));

        return;
    }

    return redirect()->intended('/');
}

?>

<x-layouts.app>

    <div class="flex flex-col items-center justify-center w-screen h-screen">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="/">
                <x-logo class="w-auto h-12 mx-auto text-indigo-600 fill-current" />
            </x-ui.link>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                Sign in to your account
            </h2>
            <div class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                Or
                <x-ui.link href="/auth/register" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                    create a new account
                </x-ui.link>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                
                @volt('auth.login')
                    <form wire:submit="authenticate">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                Email address
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model="email" id="email" name="email" type="email" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                                Password
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <div class="flex items-center">
                                <input wire:model="remember" id="remember" type="checkbox" class="w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox" />
                                <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900">
                                    Remember
                                </label>
                            </div>

                            <div class="text-sm leading-5">
                                <x-ui.link href="/auth/password/reset" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                                    Forgot your password?
                                </x-ui.link>
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700">
                                    Sign in
                                </button>
                            </span>
                        </div>
                    </form>
                @endvolt
                
            </div>
        </div>
    </div>

</x-layouts.app>