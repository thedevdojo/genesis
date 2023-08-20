<?php

namespace Devdojo\Genesis;

use Illuminate\Support\ServiceProvider;
use Laravel\Ui\UiCommand;

class GenesisServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        UiCommand::macro('genesis', function ($command) {
            GenesisPreset::install();
            $command->info('Genesis starter kit installed successfully.');
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('genesis', function () {
            return new Genesis;
        });
    }
}
