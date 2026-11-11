<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
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
    Notification::fake();
    Event::fake([Verified::class]);

    $user = User::factory()->unverified()->create();

    Livewire::actingAs($user);

    Volt::test('auth.verify')
        ->call('resend')
        ->assertDispatched('resent');

    Notification::assertSentTo($user, VerifyEmail::class);
    Event::assertNotDispatched(Verified::class);
});

test('a verified user is redirected instead of being sent another email', function () {
    Notification::fake();

    $user = User::factory()->create();

    Livewire::actingAs($user);

    Volt::test('auth.verify')
        ->call('resend')
        ->assertRedirect('/')
        ->assertNotDispatched('resent');

    Notification::assertNothingSent();
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

test('a verification link for a different email is rejected', function () {
    $user = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute('verification.verify', Carbon::now()->addMinutes(60), [
        'id' => $user->getKey(),
        'hash' => sha1('someone-else@example.com'),
    ]);

    $this->actingAs($user)->get($url)->assertForbidden();

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('a verification link for another user is rejected', function () {
    $user = User::factory()->unverified()->create();
    $other = User::factory()->unverified()->create();

    $url = URL::temporarySignedRoute('verification.verify', Carbon::now()->addMinutes(60), [
        'id' => $other->getKey(),
        'hash' => sha1($other->getEmailForVerification()),
    ]);

    $this->actingAs($user)->get($url)->assertForbidden();

    expect($other->fresh()->hasVerifiedEmail())->toBeFalse();
});
