<?php

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('can view password reset page', function () {
    $user = User::factory()->create();

    $token = Str::random(16);

    DB::table('password_reset_tokens')->insert([
        'email' => $user->email,
        'token' => Hash::make($token),
        'created_at' => Carbon::now(),
    ]);

    $this->get('/auth/password/'.$token.'/?email='.$user->email)
        ->assertSuccessful()
        ->assertSee($user->email);
});

test('can reset password', function () {
    $user = User::factory()->create();

    $token = Str::random(16);

    DB::table('password_reset_tokens')->insert([
        'email' => $user->email,
        'token' => Hash::make($token),
        'created_at' => Carbon::now(),
    ]);

    Volt::test('auth.password.token', [
        'token' => $token,
    ])
        ->set('email', $user->email)
        ->set('password', 'new-password')
        ->set('passwordConfirmation', 'new-password')
        ->call('resetPassword');

    expect(Auth::attempt([
        'email' => $user->email,
        'password' => 'new-password',
    ]))->toBeTrue();
});

test('token is required', function () {
    Volt::test('auth.password.token', [
        'token' => null,
    ])
        ->call('resetPassword')
        ->assertHasErrors(['token' => 'required']);
});

test('email is required', function () {
    Volt::test('auth.password.token', [
        'token' => Str::random(16),
    ])
        ->set('email', null)
        ->call('resetPassword')
        ->assertHasErrors(['email' => 'required']);
});

test('email is valid email', function () {
    Volt::test('auth.password.token', [
        'token' => Str::random(16),
    ])
        ->set('email', 'email')
        ->call('resetPassword')
        ->assertHasErrors(['email' => 'email']);
});

test('password is required', function () {
    Volt::test('auth.password.token', [
        'token' => Str::random(16),
    ])
        ->set('password', '')
        ->call('resetPassword')
        ->assertHasErrors(['password' => 'required']);
});

test('password is minimum of eight characters', function () {
    Volt::test('auth.password.token', [
        'token' => Str::random(16),
    ])
        ->set('password', 'secret')
        ->call('resetPassword')
        ->assertHasErrors(['password' => 'min']);
});

test('password matches password confirmation', function () {
    Volt::test('auth.password.token', [
        'token' => Str::random(16),
    ])
        ->set('password', 'new-password')
        ->set('passwordConfirmation', 'not-new-password')
        ->call('resetPassword')
        ->assertHasErrors(['password' => 'same']);
});
