<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the home route name points at the home page', function () {
    expect(route('home'))->toBe(url('/'));
});

test('old /home links still go to the home page', function () {
    $this->get('/home')->assertRedirect('/');
});

test('the logo links straight to the home page', function () {
    $this->get('/')->assertOk()->assertSee('href="'.url('/').'"', false)->assertDontSee('href="'.url('/home').'"', false);
});

test('logged in users go straight to the dashboard from guest pages', function (string $url) {
    $this->actingAs(User::factory()->create())
        ->get($url)
        ->assertRedirect(route('dashboard'));
})->with(['/auth/login', '/auth/register', '/auth/password/reset']);
