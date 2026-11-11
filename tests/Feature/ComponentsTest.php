<?php

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    // pages get this from the web middleware, Blade::render() doesn't
    view()->share('errors', new ViewErrorBag);
});

test('the learn page starts with the doctype', function () {
    $response = $this->actingAs(User::factory()->create())->get('/learn')->assertOk();

    expect(ltrim($response->getContent()))->toStartWith('<!DOCTYPE html>');
});

test('the typography plugin is loaded for the prose pages', function () {
    expect(File::get(resource_path('css/app.css')))->toContain('@plugin "@tailwindcss/typography";');
});

test('backdrops use opacity modifiers that exist in tailwind 4', function () {
    $views = collect(File::allFiles(resource_path('views')))->map(fn ($file) => $file->getContents())->implode("\n");

    expect($views)->not->toMatch('/\bbg-opacity-\d+/');
});

test('the input forwards attributes and only autofocuses when asked', function () {
    $html = Blade::render('<x-ui.input id="email" name="email" wire:model="email" autocomplete="email" placeholder="you@example.com" />');

    expect($html)
        ->toContain('autocomplete="email"')
        ->toContain('placeholder="you@example.com"')
        ->toContain('wire:model="email"')
        ->toContain('required')
        ->not->toContain('autofocus');

    expect(Blade::render('<x-ui.input id="email" name="email" wire:model="email" autofocus />'))->toContain('autofocus');
    expect(Blade::render('<x-ui.input id="nickname" name="nickname" wire:model="nickname" :required="false" />'))->not->toContain('required');
});

test('the input shows errors for any wire:model modifier', function () {
    $errors = (new ViewErrorBag)->put('default', new MessageBag(['email' => ['The email is invalid.']]));
    view()->share('errors', $errors);

    $html = Blade::render('<x-ui.input id="email" name="email" wire:model.live="email" />');

    expect($html)
        ->toContain('The email is invalid.')
        ->toContain('aria-invalid="true"')
        ->toContain('aria-describedby="email-error"')
        ->toContain('id="email-error"');
});

test('the login page autofocuses only the email field', function () {
    $html = $this->get('/auth/login')->assertOk()->getContent();

    expect(substr_count($html, 'autofocus'))->toBe(1)
        ->and($html)->toContain('autocomplete="current-password"');
});

test('the profile page does not autofocus any field', function () {
    $html = $this->actingAs(User::factory()->create())->get('/profile/edit')->assertOk()->getContent();

    expect($html)->not->toContain('autofocus')
        ->and(substr_count($html, 'autocomplete="new-password"'))->toBe(2);
});

test('the remember me checkbox can be reached by keyboard', function () {
    $html = Blade::render('<x-ui.checkbox label="Remember me" id="remember" name="remember" wire:model="remember" />');

    expect($html)->toContain('class="sr-only peer"')
        ->not->toContain('class="hidden peer"');
});

test('the resend verification link is a button', function () {
    Volt::actingAs(User::factory()->unverified()->create())
        ->test('auth.verify')
        ->assertSeeHtml('<button type="button" wire:click="resend"');
});

test('icon only controls have an accessible name', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('aria-label="Menu"', false)
        ->assertSee('aria-label="Toggle dark mode"', false)
        ->assertSee('aria-live="polite"', false);
});

test('the mail header shows the app name instead of the svg logo', function () {
    config(['app.name' => 'My App']);

    $html = (string) (new MailMessage)->line('Hello')->render();

    expect($html)->toContain('My App')->not->toContain('<svg');
});
