<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'redirect-to-dashboard' => \App\Http\Middleware\RedirectToDashboard::class,
        ]);

        // Folio page names aren't visible to the guest middleware's Route::has('dashboard') check
        $middleware->redirectUsersTo('/dashboard');

        // Only answer to APP_URL's host (and its subdomains), so links in emails can't point elsewhere. Skipped in local and tests
        $middleware->trustHosts();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
