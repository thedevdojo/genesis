<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use function Laravel\Folio\{middleware};
use function Livewire\Volt\{with, state, rules, mount};
use Illuminate\Validation\Rule;

middleware(['auth', 'verified']);

state([
    'user' => auth()->user(),
    'name' => '',
    'email' => '',
    'current_password' => '',
    'new_password' => '',
    'new_password_confirmation' => ''
]);

mount(function(){
    $this->name = $this->user->name;
    $this->email = $this->user->email;
});

$updateProfile = function()
{
    $validated = $this->validate([ 
        'name' => 'required|string|min:3',
        'email' => 'required|min:3|email|max:255|unique:users,email,' . $this->user->id . ',id'
    ]);

    if($this->user->name == $this->name && $this->user->email == $this->email){
        $this->dispatch('toast', message: 'Nothing to update.', data: [ 'position' => 'top-right', 'type' => 'info' ]);
        return;
    }

    $this->user->fill(['email' => $this->email, 'name' => $this->name])->save();
    
    $this->dispatch('toast', message: 'Successfully updated profile.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
};

$updatePassword = function(){

    $validated = $this->validate([ 
        'new_password' => 'required|confirmed|min:6',
    ]);

    if (!Hash::check($this->current_password, $this->user->password)) {
        $this->dispatch('toast', message: 'Current Password Incorrect', data: [ 'position' => 'top-right', 'type' => 'danger' ]);
        return;
    }

    $this->dispatch('toast', message: 'Successfully updated password.', data: [ 'position' => 'top-right', 'type' => 'success' ]);
    // The passwords match...
    $this->user->fill(['password' => Hash::make($this->new_password), 'remember_token' => Str::random(60) ])->save();

    $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    

    // Here we will attempt to reset the user's password. If it is successful we
    // will update the password on an actual user model and persist it to the
    // database. Otherwise we will parse the error and return the response.
    /*$status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user) use ($request) {
            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
    );*/

    // If the password was successfully reset, we will redirect the user back to
    // the application's home authenticated view. If there is an error we can
    // redirect them back to where they came from with their error message.
    /*return $status == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withInput($request->only('email'))
                        ->withErrors(['email' => __($status)]);*/
};

/**
    * Delete the user's account.
    */
$destroy = function(Request $request)
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}
?>


<x-layouts.dashboard>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @volt('profile.edit')
        <div class="py-12">
            <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
                
                {{-- Update Profile Section --}}
                <section class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Profile Information') }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __("Update your account's profile information and email address.") }}</p>
                        </header>
                        <form wire:submit="updateProfile" class="mt-6 space-y-6">
                            <x-ui.input label="Name" type="text" id="name" name="name" wire:model="name" />
                            <x-ui.input label="Email address" type="email" id="email" name="email" wire:model="email" />
                            <div class="flex items-start">
                                <div>
                                    <x-ui.button type="primary" submit="true">{{ __('Update') }}</x-ui.button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                {{-- End Update Profile Information --}}

                {{-- Update Password Section --}}
                <section class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Update Password') }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        </header>
                        <form wire:submit="updatePassword" class="mt-6 space-y-6">

                            <x-ui.input label="Current Password" type="password" id="current_password" name="current_password" wire:model="current_password" />
                            <x-ui.input label="New Password" type="password" id="new_password" name="new_password" wire:model="new_password" />
                            <x-ui.input label="Confirm New Password" type="password" id="new_password_confirmation" name="new_password_confirmation" wire:model="new_password_confirmation" />

                            <div class="flex items-start">
                                <div>
                                    <x-ui.button type="primary" submit="true">{{ __('Update') }}</x-ui.button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                {{-- End Update Password Section --}}

                <div class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg">
                    <div class="max-w-xl">

                        {{-- Delete User Form --}}
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Delete Account') }}
                                </h2>

                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                                </p>
                            </header>

                            <x-danger-button
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                            >{{ __('Delete Account') }}</x-danger-button>

                            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form method="post" action="/profile/delete" class="p-6">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your account?') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                                    </p>

                                    <div class="mt-6">
                                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                                        <x-text-input
                                            id="password"
                                            name="password"
                                            type="password"
                                            class="block w-3/4 mt-1"
                                            placeholder="{{ __('Password') }}"
                                        />

                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="flex justify-end mt-6">
                                        <x-secondary-button x-on:click="$dispatch('close')">
                                            {{ __('Cancel') }}
                                        </x-secondary-button>

                                        <x-danger-button class="ml-3">
                                            {{ __('Delete Account') }}
                                        </x-danger-button>
                                    </div>
                                </form>
                            </x-modal>
                        </section>
                        {{-- End Delete User Form --}}

                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-layouts.dashboard>