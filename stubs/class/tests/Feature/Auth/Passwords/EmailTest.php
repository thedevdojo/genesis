<?php

use App\Models\User;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('can view password request page', function () {
    $this->get('/auth/password/reset')
        ->assertSuccessful();
});

test('a user must enter an email address', function () {
    Volt::test('auth.password.reset')
        ->call('sendResetPasswordLink')
        ->assertHasErrors(['email' => 'required']);
});

test('a user must enter a valid email address', function () {
    Volt::test('auth.password.reset')
        ->set('email', 'email')
        ->call('sendResetPasswordLink')
        ->assertHasErrors(['email' => 'email']);
});

test('a user who enters a valid email address will get sent an email', function () {
    $user = User::factory()->create();

    Volt::test('auth.password.reset')
        ->set('email', $user->email)
        ->call('sendResetPasswordLink')
        ->assertNotSet('emailSentMessage', false);

    $this->assertDatabaseHas('password_reset_tokens', [
        'email' => $user->email,
    ]);
});
