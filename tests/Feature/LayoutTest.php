<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the layouts pass the page title through', function (string $layout) {
    $this->be(User::factory()->create());

    $html = (string) $this->blade("<x-layouts.$layout title=\"My Page\">content</x-layouts.$layout>");

    expect($html)->toMatch('#<head>.*<title>My Page</title>.*</head>#s');
})->with(['app', 'marketing', 'main']);

test('the title defaults to the app name', function () {
    config(['app.name' => 'My App']);

    $html = (string) $this->blade('<x-layouts.marketing>content</x-layouts.marketing>');

    expect($html)->toMatch('#<head>.*<title>My App</title>.*</head>#s');
});
