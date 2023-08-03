<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

use function Livewire\Volt\{state, rules, mount};

state(['token', 'email', 'password', 'passwordConfirmation']);
rules(['token' => 'required', 'email' => 'required|email', 'password' => 'required|min:8|same:passwordConfirmation']);

mount(function ($token){
    $this->email = request()->query('email', '');
    $this->token = $token;
});

$resetPassword = function(){
    $this->validate();

    $response = Password::broker()->reset(
        [
            'token' => $this->token,
            'email' => $this->email,
            'password' => $this->password
        ],
        function ($user, $password) {
            $user->password = Hash::make($password);

            $user->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));

            Auth::guard()->login($user);
        }
    );

    if ($response == Password::PASSWORD_RESET) {
        session()->flash(trans($response));

        return redirect('/');
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
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow-sm sm:rounded-lg border-gray-200/60 sm:px-10">

                @volt('auth.password.token')
                    <form wire:submit="resetPassword">
                        <input wire:model.live="token" type="hidden">

                        <div>
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700"    >
                                Email address
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.blur="email" id="email" type="email" value="{{ $email }}" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
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
                                <input wire:model.blur="password" id="password" type="password" autofocus required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                                Confirm Password
                            </label>

                            <div class="mt-1 rounded-md shadow-sm">
                                <input wire:model.blur="passwordConfirmation" id="password_confirmation" type="password" required class="block w-full px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-blue focus:border-blue-300 sm:text-sm sm:leading-5" />
                            </div>
                        </div>

                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-gray-600 border border-transparent rounded-md hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:ring-indigo active:bg-gray-700">
                                    Reset password
                                </button>
                            </span>
                        </div>
                    </form>
                @endvolt
                
            </div>
        </div>
    </div>
</x-layouts.app>
