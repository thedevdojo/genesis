<?php

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('resending the verification email is rate limited', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();
    Livewire::actingAs($user);

    $page = Volt::test('auth.verify');
    foreach (range(1, 6) as $i) {
        $page->call('resend')->assertHasNoErrors();
    }

    $page->call('resend')
        ->assertHasErrors('resend')
        ->assertSee('Too many requests. Please try again in');

    Notification::assertSentToTimes($user, VerifyEmail::class, 6);
});

test('changing the email resets its verification', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('email', 'new@example.com')
        ->call('updateProfile')
        ->assertHasNoErrors();

    expect($user->fresh()->email_verified_at)->toBeNull();
});

test('changing only the name keeps the email verified', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Volt::test('profile.edit')
        ->set('name', 'New Name')
        ->call('updateProfile')
        ->assertHasNoErrors();

    expect($user->fresh()->email_verified_at)->not->toBeNull();
});
