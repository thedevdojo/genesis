<?php

use Illuminate\Support\Facades\Http;

test('the genesis pages are not reachable outside the local environment', function (string $page) {
    $this->get($page)->assertNotFound();
})->with(['/genesis/about', '/genesis/power-ups']);

test('the genesis pages are reachable locally', function (string $page) {
    $this->app['env'] = 'local';

    $this->get($page)->assertOk();
})->with(['/genesis/about', '/genesis/power-ups']);

test('the power-ups page lists the power-ups without fetching anything', function () {
    Http::preventStrayRequests();
    $this->app['env'] = 'local';

    $this->get('/genesis/power-ups')
        ->assertOk()
        ->assertSee('https://github.com/thedevdojo/blog-genesis', false)
        ->assertDontSee('Install Power-up');
});

test('the header only links to the genesis pages locally', function () {
    $this->get('/')->assertDontSee('href="/genesis/power-ups"', false);

    $this->app['env'] = 'local';

    $this->get('/')->assertSee('href="/genesis/power-ups"', false);
});
