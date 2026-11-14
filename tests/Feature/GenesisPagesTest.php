<?php

use Illuminate\Support\Facades\Http;

beforeEach(function () {
    Http::fake([
        'raw.githubusercontent.com/*' => Http::response([
            'name' => 'Blog',
            'description' => 'A simple blog',
            'cover' => 'https://example.com/cover.png',
            'includes' => ['pages'],
            'pages' => [],
            'models' => [],
            'tables' => [],
        ]),
    ]);
});

test('the genesis pages are not reachable outside the local environment', function (string $page) {
    $this->get($page)->assertNotFound();
})->with(['/genesis/about', '/genesis/power-ups']);

test('the genesis pages are reachable locally', function (string $page) {
    $this->app['env'] = 'local';

    $this->get($page)->assertOk();
})->with(['/genesis/about', '/genesis/power-ups']);

test('the header only links to the genesis pages locally', function () {
    $this->get('/')->assertDontSee('href="/genesis/power-ups"', false);

    $this->app['env'] = 'local';

    $this->get('/')->assertSee('href="/genesis/power-ups"', false);
});
