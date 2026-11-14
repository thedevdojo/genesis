<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

uses(RefreshDatabase::class);

test('the learn page shows the local readme without calling github', function () {
    Http::fake();
    $this->withoutVite();

    $this->actingAs(User::factory()->create())
        ->get('/learn')
        ->assertOk()
        ->assertSee('Genesis Logo', false);

    Http::assertNothingSent();
});

test('guests can not view the learn page', function () {
    $this->get('/learn')->assertRedirect(route('login'));
});
