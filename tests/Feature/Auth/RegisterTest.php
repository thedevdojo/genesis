<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration page returns ok', function () {
    $this->get('auth/register')
        ->assertSuccessful();
});

test('is redirected if already logged in', function () {
    $user = User::factory()->create();

    $this->be($user);

    $this->get('auth/register')
        ->assertRedirect(route('home'));
});

test('a user can register', function () {
    Event::fake();

    Volt::test('auth.register')
        ->set('name', 'Genesis')
        ->set('email', 'genesis@example.com')
        ->set('password', 'password')
        ->set('passwordConfirmation', 'password')
        ->call('register')
        ->assertRedirect('/');

    expect(User::whereEmail('genesis@example.com')->exists())->toBeTrue();
    expect(Auth::user()->email)->toEqual('genesis@example.com');

    Event::assertDispatched(Registered::class);
});

test('name is required', function () {
    Volt::test('auth.register')
        ->set('name', '')
        ->call('register')
        ->assertHasErrors(['name' => 'required']);
});

test('email is required', function () {
    Volt::test('auth.register')
        ->set('email', '')
        ->call('register')
        ->assertHasErrors(['email' => 'required']);
});

test('email is valid email', function () {
    Volt::test('auth.register')
        ->set('email', 'tallstack')
        ->call('register')
        ->assertHasErrors(['email' => 'email']);
});

test('email hasnt been taken already', function () {
    User::factory()->create(['email' => 'tallstack@example.com']);

    Volt::test('auth.register')
        ->set('email', 'tallstack@example.com')
        ->call('register')
        ->assertHasErrors(['email' => 'unique']);
});

test('see email hasnt already been taken validation message as user types', function () {
    User::factory()->create(['email' => 'genesis@example.com']);

    Volt::test('auth.register')
        ->set('email', 'genesis@gmail.com')
        ->assertHasNoErrors()
        ->set('email', 'genesis@example.com')
        ->call('register')
        ->assertHasErrors(['email' => 'unique']);
});

test('password is required', function () {
    Volt::test('auth.register')
        ->set('password', '')
        ->set('passwordConfirmation', 'password')
        ->call('register')
        ->assertHasErrors(['password' => 'required']);
});

test('password is minimum of eight characters', function () {
    Volt::test('auth.register')
        ->set('password', 'secret')
        ->set('passwordConfirmation', 'secret')
        ->call('register')
        ->assertHasErrors(['password' => 'min']);
});

test('password matches password confirmation', function () {
    Volt::test('auth.register')
        ->set('email', 'tallstack@example.com')
        ->set('password', 'password')
        ->set('passwordConfirmation', 'not-password')
        ->call('register')
        ->assertHasErrors(['password' => 'same']);
});
