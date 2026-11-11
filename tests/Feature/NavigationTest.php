<?php

use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('the breadcrumb list only contains list items', function () {
    $dom = new DOMDocument;
    @$dom->loadHTML($this->get('/genesis/about')->assertOk()->getContent());
    $ol = (new DOMXPath($dom))->query('//nav[@aria-label="Breadcrumb"]/ol')->item(0);

    $children = collect(iterator_to_array($ol->childNodes))
        ->filter(fn ($node) => $node instanceof DOMElement)
        ->map(fn (DOMElement $node) => $node->tagName)
        ->unique()
        ->values()
        ->all();

    expect($children)->toBe(['li']);
});

test('the breadcrumbs name the home link and mark the current page', function () {
    $this->get('/genesis/about')
        ->assertOk()
        ->assertSee('<a href="/" aria-label="Home"', false)
        ->assertSee('<span class="active-breadcrumb" aria-current="page">About</span>', false);
});

test('the active nav link is marked as the current page', function () {
    $html = $this->actingAs(User::factory()->create())->get('/dashboard')->assertOk()->getContent();

    expect($html)->toMatch('#href="/dashboard"\s*aria-current="page"#')
        ->not->toMatch('#href="/learn"\s*aria-current="page"#');
});

test('the user menu button reports whether it is open', function () {
    $this->actingAs(User::factory()->create())
        ->get('/dashboard')
        ->assertOk()
        ->assertSee(':aria-expanded="dropdownOpen"', false)
        ->assertSee('@keydown.escape.window="dropdownOpen=false"', false);
});
