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

test('the profile page renders', function () {
    $this->actingAs(User::factory()->create())
        ->get('/profile/edit')
        ->assertOk();
});

test('a user can update their name and email', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('name', 'New Name')
        ->set('email', 'new@example.com')
        ->call('updateProfile')
        ->assertHasNoErrors()
        ->assertDispatched('toast', message: 'Successfully updated profile.');

    expect($user->fresh())
        ->name->toBe('New Name')
        ->email->toBe('new@example.com');
});

test('the profile needs a name and an email nobody else uses', function () {
    User::factory()->create(['email' => 'taken@example.com']);
    $this->actingAs(User::factory()->create());

    Volt::test('profile.edit')
        ->set('name', '')
        ->set('email', 'taken@example.com')
        ->call('updateProfile')
        ->assertHasErrors(['name' => 'required', 'email' => 'unique']);
});

test('saving an unchanged profile says there is nothing to update', function () {
    $this->actingAs(User::factory()->create());

    Volt::test('profile.edit')
        ->call('updateProfile')
        ->assertDispatched('toast', message: 'Nothing to update.');
});

test('the password is not changed when the current password is wrong', function () {
    $user = User::factory()->create(['password' => Hash::make('password')]);
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('current_password', 'wrong-password')
        ->set('new_password', 'new-password')
        ->set('new_password_confirmation', 'new-password')
        ->call('updatePassword')
        ->assertDispatched('toast', message: 'Current Password Incorrect');

    expect(Hash::check('password', $user->fresh()->password))->toBeTrue();
});

test('a user can delete their account with their password', function () {
    $user = User::factory()->create(['password' => Hash::make('password')]);
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('delete_confirm_password', 'password')
        ->call('destroy')
        ->assertRedirect('/');

    $this->assertGuest();
    expect(User::find($user->id))->toBeNull();
});

test('the account is kept when the password is wrong', function () {
    $user = User::factory()->create(['password' => Hash::make('password')]);
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('delete_confirm_password', 'wrong-password')
        ->call('destroy')
        ->assertDispatched('toast', message: 'The Password you entered is incorrect')
        ->assertNoRedirect();

    $this->assertAuthenticatedAs($user);
    expect(User::find($user->id))->not->toBeNull();
});
