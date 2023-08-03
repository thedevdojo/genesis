<?php

use Illuminate\Support\Facades\Password;
use function Livewire\Volt\{state, rules};

state(['email' => null, 'emailSentMessage' => false]);
rules(['email' => 'required|email']);



$sendResetPasswordLink = function(){
    $this->validate();

    $response = Password::broker()->sendResetLink(['email' => $this->email]);

    if ($response == Password::RESET_LINK_SENT) {
        $this->emailSentMessage = trans($response);

        return;
    }

    $this->addError('email', trans($response));
}

?>

<x-layouts.app>

    <div class="flex flex-col items-center justify-center w-screen h-screen">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="/">
                <x-logo class="w-auto h-12 mx-auto text-gray-800 fill-current" />
            </x-ui.link>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-800">
                Reset password
            </h2>
            <div class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                <span>Or</span>
                <x-ui.text-link href="/auth/login">return to login</x-ui.text-link>
            </div>
        </div>

        @volt('auth.password.reset')
            <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
                <div class="px-4 py-8 bg-white border shadow-sm sm:rounded-lg border-gray-200/60 sm:px-10">
                    @if ($emailSentMessage)
                        <div class="p-4 rounded-md bg-green-50">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>

                                <div class="ml-3">
                                    <p class="text-sm font-medium leading-5 text-green-800">
                                        {{ $emailSentMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <form wire:submit="sendResetPasswordLink" class="space-y-6">
                            <x-ui.input label="Email address" type="email" id="email" name="email" wire:model="email" />
                            <x-ui.button type="primary" submit="true">Send password reset link</x-ui.button>
                        </form>
                    @endif
                </div>
            </div>
        @endvolt
        
    </div>

</x-layouts.app>