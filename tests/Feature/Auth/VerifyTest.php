<?php

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Livewire\Livewire;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('can view verification page', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    Auth::login($user);

    $this->get('/auth/verify')
        ->assertSuccessful();
});

test('can resend verification email', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user);

    Volt::test('auth.verify')
        ->call('resend')
        ->assertDispatched('resent');
});

test('can verify', function () {
    $user = User::factory()->create([
        'email_verified_at' => null,
    ]);

    Auth::login($user);

    $url = URL::temporarySignedRoute('verification.verify', Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)), [
        'id' => $user->getKey(),
        'hash' => sha1($user->getEmailForVerification()),
    ]);

    $this->get($url)
        ->assertRedirect(route('home'));

    expect($user->hasVerifiedEmail())->toBeTrue();
});
