<?php

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
            <Link href="/"><Logo class="w-auto h-12 mx-auto text-gray-800" /></Link>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-800">Sign in to your account</h2>
            <div class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                <span>Or</span>
                <LinkText href="/auth/register">create a new account</LinkText>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow-sm sm:rounded-lg border-gray-200/60 sm:px-10">
                @volt('auth.login')
                    <form wire:submit="authenticate" class="space-y-6">
                        
                        <x-ui.input label="Email address" type="email" id="email" name="email" wire:model="email" />
                        <x-ui.input label="Password" type="password" id="password" name="password" wire:model="password" />

                        <div class="flex items-center justify-between mt-6 text-sm leading-5">
                            <x-ui.checkbox label="Remember me" id="remember" name="remember" wire:model="remember" />
                            <x-ui.text-link href="/auth/password/reset">Forgot your password?</x-ui.text-link>
                        </div>

                        <x-ui.button type="primary" submit="true">Sign in</x-ui.button>
                    </form>
                @endvolt
            </div>
        </div>
        
    </div>

</x-layouts.app>