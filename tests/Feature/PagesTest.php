<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('the home page sends logged in users to the dashboard', function () {
    $this->actingAs(User::factory()->create())
        ->get('/')
        ->assertRedirect(route('dashboard'));
});

test('the about page renders', function () {
    $this->get('/genesis/about')->assertOk();
});

test('the dashboard renders for a verified user', function () {
    $this->actingAs(User::factory()->create())
        ->get('/dashboard')
        ->assertOk();
});

test('guests are sent to the login page from the dashboard and profile', function (string $url) {
    $this->get($url)->assertRedirect(route('login'));
})->with(['/dashboard', '/profile/edit', '/auth/verify']);

test('the power-ups page is gone from the site and the menu', function () {
    $this->get('/genesis/power-ups')->assertNotFound();

    $this->get('/')
        ->assertOk()
        ->assertDontSee('/genesis/power-ups', false);
});
