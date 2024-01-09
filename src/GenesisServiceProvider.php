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
            $useClassFolder = false;

            // Retrieve all options as an array and check if 'class' is in the array
            $options = $command->option('option');
            if (is_array($options)) {
                $useClassFolder = in_array('class', $options);
            } else if ($options === 'class') {
                // If it's not an array, check if it's a string 'class'
                $useClassFolder = true;
            }

            // Determine the stubs directory based on the presence of the 'class' option
            $stubDirectoryType = $useClassFolder ? 'class' : 'functional';
            GenesisPreset::install($stubDirectoryType);

            $message = $useClassFolder ? 'Genesis starter kit with Volt Class API installed successfully.' : 'Genesis starter kit installed successfully.';
            $command->info($message);
        });

        // Registering package commands.
        $this->commands([
            // \Foundationapp\PowerUps\Console\Commands\PowerUpList::class,
            // \Foundationapp\PowerUps\Console\Commands\PowerUpEnable::class,
            // \Foundationapp\PowerUps\Console\Commands\PowerUpDisable::class,
            \Devdojo\Genesis\Console\Commands\PowerupInstall::class,
        ]);
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
