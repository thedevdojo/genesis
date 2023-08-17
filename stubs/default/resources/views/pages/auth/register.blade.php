<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use function Laravel\Folio\{middleware, name};
use function Livewire\Volt\{state, rules};

middleware(['guest']);
state(['name' => '', 'email' => '', 'password' => '', 'passwordConfirmation' => '']);
rules(['name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:8|same:passwordConfirmation']);
name('register');

$register = function(){
    $this->validate();

    $user = User::create([
        'email' => $this->email,
        'name' => $this->name,
        'password' => Hash::make($this->password),
    ]);

    // need to wait for folio paged based routes to add the following event 👇
    // https://github.com/laravel/folio/pull/54
    event(new Registered($user));

    Auth::login($user, true);

    return redirect()->intended('/');
}

?>

<x-layouts.app>

    <div class="flex flex-col items-stretch justify-center w-screen min-h-screen sm:py-6 sm:items-center">
        
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="{{ route('index') }}">
                <x-ui.logo class="w-auto h-12 mx-auto text-gray-800 fill-current" />
            </x-ui.link>
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-800">Create a new account</h2>
            <div class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                <span>Or</span>
                <x-ui.text-link href="{{ route('login') }}">sign in to your account</x-ui.text-link>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-10 py-0 sm:py-8 sm:shadow-sm sm:bg-white sm:border sm:rounded-lg border-gray-200/60">
                @volt('auth.register')
                    <form wire:submit="register" class="space-y-6">
                        <x-ui.input label="Name" type="name" id="name" name="name" wire:model="name" />
                        <x-ui.input label="Email address" type="email" id="email" name="email" wire:model="email" />
                        <x-ui.input label="Password" type="password" id="password" name="password" wire:model="password" />
                        <x-ui.input label="Confirm Password" type="password" id="password_confirmation" name="password_confirmation" wire:model="passwordConfirmation" />
                        <x-ui.button type="primary" submit="true">Register</x-ui.button>
                    </form>
                @endvolt
            </div>
        </div>
        
    </div>

</x-layouts.app>