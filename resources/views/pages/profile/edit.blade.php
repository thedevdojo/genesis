<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function Laravel\Folio\{middleware, name};
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;

name('profile.edit');
middleware(['auth', 'verified']);

new class extends Component {
    #[Locked]
    public $user;

    public $name = '';
    public $email = '';
    public $current_password = '';

    #[Validate('required|confirmed|min:6')]
    public $new_password = '';
    public $new_password_confirmation = '';
    public $delete_confirm_password = '';

    public $two_factor_enabled = false;
    public $api_tokens = [];

    public function mount()
    {
        $this->user = auth()->user();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        $validated = $this->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|min:3|email|max:255|unique:users,email,' . $this->user->id . ',id',
        ]);

        // if the user hasn't changed their name or email and we also want to make, don't update and show error
        if ($this->user->name == $this->name && $this->user->email == $this->email) {
            $this->dispatch('toast', message: 'Nothing to update.', data: ['position' => 'top-right', 'type' => 'info']);
            return;
        }

        $this->user->fill(['email' => $this->email, 'name' => $this->name])->save();

        $this->dispatch('toast', message: 'Successfully updated profile.', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function updatePassword()
    {
        $validated = $this->validate();

        if (!Hash::check($this->current_password, $this->user->password)) {
            $this->dispatch('toast', message: 'Current Password Incorrect', data: ['position' => 'top-right', 'type' => 'danger']);
            return;
        }

        $this->dispatch('toast', message: 'Successfully updated password.', data: ['position' => 'top-right', 'type' => 'success']);
        $this->user->fill(['password' => Hash::make($this->new_password), 'remember_token' => Str::random(60)])->save();

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function toggleTwoFactor()
    {
        $this->two_factor_enabled = !$this->two_factor_enabled;
        $status = $this->two_factor_enabled ? 'enabled' : 'disabled';
        $this->dispatch('toast', message: "Two-Factor Authentication {$status}.", data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function createApiToken()
    {
        // Mock token creation
        $token = 'gtk_' . Str::random(32);
        $this->api_tokens[] = [
            'name' => 'New Token',
            'token' => $token,
            'last_used' => 'Never',
        ];
        $this->dispatch('toast', message: 'API Token created.', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function deleteApiToken($index)
    {
        unset($this->api_tokens[$index]);
        $this->api_tokens = array_values($this->api_tokens);
        $this->dispatch('toast', message: 'API Token deleted.', data: ['position' => 'top-right', 'type' => 'success']);
    }

    public function destroy()
    {
        if (!Hash::check($this->delete_confirm_password, $this->user->password)) {
            $this->dispatch('toast', message: 'The Password you entered is incorrect', data: ['position' => 'top-right', 'type' => 'danger']);
            $this->reset(['delete_confirm_password']);
            return;
        }

        $user = auth()->user();

        Auth::logout();

        $user->delete();

        request()
            ->session()
            ->invalidate();
        request()
            ->session()
            ->regenerateToken();

        return Redirect::to('/');
    }
};

?>


<x-layouts.app>

    <x-slot name="header">
        <h2 class="text-lg font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @volt('profile.edit')
        <div class="pb-5">
            <div class="mx-auto space-y-6">

                {{-- Update Profile Section --}}
                <section
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Profile Information') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update your account's profile information and email address.") }}</p>
                        </header>
                        <form wire:submit="updateProfile" class="mt-6 space-y-6">
                            <x-ui.input label="Name" type="text" id="name" name="name" wire:model="name" />
                            <x-ui.input label="Email address" type="email" id="email" name="email"
                                wire:model="email" />
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
                <section
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Update Password') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        </header>
                        <form wire:submit="updatePassword" class="mt-6 space-y-6">

                            <x-ui.input label="Current Password" type="password" id="current_password"
                                name="current_password" wire:model="current_password" />
                            <x-ui.input label="New Password" type="password" id="new_password" name="new_password"
                                wire:model="new_password" />
                            <x-ui.input label="Confirm New Password" type="password" id="new_password_confirmation"
                                name="new_password_confirmation" wire:model="new_password_confirmation" />

                            <div class="flex items-start">
                                <div>
                                    <x-ui.button type="primary" submit="true">{{ __('Update') }}</x-ui.button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                {{-- End Update Password Section --}}

                {{-- Two Factor Authentication Section --}}
                <section class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Two-Factor Authentication') }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Add additional security to your account using two-factor authentication.') }}
                            </p>
                        </header>

                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                @if($two_factor_enabled)
                                    {{ __('You have enabled two-factor authentication.') }}
                                @else
                                    {{ __('You have not enabled two-factor authentication.') }}
                                @endif
                            </h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.") }}
                            </p>
                        </div>

                        <div class="mt-6">
                            @if($two_factor_enabled)
                                <x-ui.button type="danger" wire:click="toggleTwoFactor">{{ __('Disable') }}</x-ui.button>
                            @else
                                <x-ui.button type="primary" wire:click="toggleTwoFactor">{{ __('Enable') }}</x-ui.button>
                            @endif
                        </div>
                    </div>
                </section>
                {{-- End Two Factor Authentication Section --}}

                {{-- API Tokens Section --}}
                <section class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('API Tokens') }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Manage API tokens that allow third-party services to access this application on your behalf.') }}
                            </p>
                        </header>

                        <div class="mt-6 space-y-6">
                            @foreach($api_tokens as $index => $token)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $token['name'] }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">Token: {{ substr($token['token'], 0, 10) }}...</div>
                                    </div>
                                    <button wire:click="deleteApiToken({{ $index }})" class="text-sm text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            @endforeach

                            <div class="flex items-center">
                                <x-ui.button type="primary" wire:click="createApiToken">{{ __('Create New Token') }}</x-ui.button>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- End API Tokens Section --}}

                <div
                    class="p-4 bg-white shadow sm:p-8 dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">
                    <div class="max-w-xl">

                        {{-- Delete User Form --}}
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Delete Account') }}
                                </h2>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                    {{ __('After deleting your account, all data and resources are permanently removed. Enter your password to confirm deletion.') }}
                                </p>
                            </header>

                            <div class="flex items-start justify-start w-auto text-left">
                                <div>
                                    <x-ui.button type="danger" x-data
                                        @click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                                        {{ __('Delete Account') }}
                                    </x-ui.button>
                                </div>
                            </div>

                            <x-ui.modal name="confirm-user-deletion" maxWidth="lg" :show="$errors->userDeletion->isNotEmpty()" focusable>
                                <form wire:submit="destroy" class="p-6">

                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete your account?') }}</h2>
                                    <p class="mt-1 mb-6 text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('After deleting your account, all data and resources are permanently removed. Enter your password to confirm deletion.') }}
                                    </p>

                                    <x-ui.input label="Password" type="password" id="delete_confirm_password"
                                        name="delete_confirm_password" wire:model="delete_confirm_password" />

                                    <div class="flex justify-end mt-6">
                                        <div>
                                            <x-ui.button type="secondary" x-on:click="$dispatch('close')">
                                                {{ __('Cancel') }}
                                            </x-ui.button>
                                        </div>

                                        <div class="ml-3">
                                            <x-ui.button type="danger" submit="true">
                                                {{ __('Delete Account') }}
                                            </x-ui.button>
                                        </div>
                                    </div>
                                </form>
                            </x-ui.modal>
                        </section>
                        {{-- End Delete User Form --}}

                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-layouts.app>
