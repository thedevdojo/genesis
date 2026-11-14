<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

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

test('the power-ups page lists the power-ups without fetching anything', function () {
    Http::preventStrayRequests();

    $this->get('/genesis/power-ups')
        ->assertOk()
        ->assertSee('https://github.com/thedevdojo/blog-genesis', false)
        ->assertDontSee('Install Power-up');
});

test('the power-ups page is linked from the menu', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('/genesis/power-ups', false);
});
