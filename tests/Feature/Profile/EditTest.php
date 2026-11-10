<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('a new password needs at least 8 characters, like on register', function () {
    $user = User::factory()->create(['password' => Hash::make('password')]);
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('current_password', 'password')
        ->set('new_password', 'short1')
        ->set('new_password_confirmation', 'short1')
        ->call('updatePassword')
        ->assertHasErrors(['new_password' => 'min']);

    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
});

test('a user can change their password', function () {
    $user = User::factory()->create(['password' => Hash::make('password')]);
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('current_password', 'password')
        ->set('new_password', 'new-password')
        ->set('new_password_confirmation', 'new-password')
        ->call('updatePassword')
        ->assertHasNoErrors();

    expect(Hash::check('new-password', $user->fresh()->password))->toBeTrue();
});

test('a user with a short name can still update their profile', function () {
    $user = User::factory()->create(['name' => 'Al']);
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('email', 'al@example.com')
        ->call('updateProfile')
        ->assertHasNoErrors();

    expect($user->fresh()->email)->toBe('al@example.com');
});
