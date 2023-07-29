<?php

    use Illuminate\Support\Facades\Auth;
    use function Laravel\Folio\{middleware};

    middleware(['auth', 'throttle:6,1']);

    $resend = function(){
        if (Auth::user()->hasVerifiedEmail()) {
            redirect('/');
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->dispatch('resent');

        session()->flash('resent');
    }

?>

<x-layouts.app>

    <div class="flex flex-col items-center justify-center w-screen h-screen">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <x-ui.link href="/">
                <x-logo class="w-auto h-16 mx-auto text-indigo-600" />
            </x-ui.link>

            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                Verify your email address
            </h2>

            <div class="mt-2 text-sm leading-5 text-center text-gray-600 max-w">
                Or
                <x-link href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="font-medium text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
                    sign out
                </x-link>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">

            @volt('auth.verify')
                <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
                    @if (session('resent'))
                        <div class="flex items-center px-4 py-3 mb-6 text-sm text-white bg-green-500 rounded shadow" role="alert">
                            <svg class="w-4 h-4 mr-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>

                            <p>A fresh verification link has been sent to your email address.</p>
                        </div>
                    @endif

                    <div class="text-sm text-gray-700">
                        <p>Before proceeding, please check your email for a verification link.</p>

                        <p class="mt-3">
                            If you did not receive the email, <a wire:click="resend" class="text-indigo-700 transition duration-150 ease-in-out cursor-pointer hover:text-indigo-600 focus:outline-none focus:underline">click here to request another</a>.
                        </p>
                    </div>
                </div>
            @endvolt
            
        </div>
    </div>

</x-layouts.app>
