<?php

namespace Devdojo\Genesis;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Laravel\Ui\Presets\Preset;

class GenesisPreset extends Preset
{
    const NPM_PACKAGES_TO_ADD = [
        '@tailwindcss/forms' => '^0.5.4',
        '@tailwindcss/typography' => '^0.5.9',
        'alpinejs' => '^3.12.3',
        'autoprefixer' => '^10.4.14',
        'tailwindcss' => '^3.3.3',
    ];

    const NPM_PACKAGES_TO_REMOVE = [
        'lodash',
        'axios',
    ];

    public static function install($stubDirectoryType = 'functional')
    {
        static::updatePackages();

        $filesystem = new Filesystem();

        // If the user specified the 'class' option, use the class stubs, otherwise use the functional (default) stubs
        $stubDirectory = ($stubDirectoryType == 'class') ? 'class' : 'default';
    
        $filesystem->copyDirectory(__DIR__ . "/../stubs/{$stubDirectory}", base_path());

        static::updateFile(base_path('app/Http/Kernel.php'), function ($file) {
            return str_replace(
                "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,",
                "'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,\n\t\t'redirect-to-dashboard' => \App\Http\Middleware\RedirectToDashboard::class,",
                $file
            );
        });

        // Run the Folio and volt install commands
        Artisan::call('folio:install');
        Artisan::call('volt:install');
    }


    protected static function updatePackageArray(array $packages)
    {
        return array_merge(
            static::NPM_PACKAGES_TO_ADD,
            Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
        );
    }

    /**
     * Update the contents of a file with the logic of a given callback.
     */
    protected static function updateFile(string $path, callable $callback)
    {
        $originalFileContents = file_get_contents($path);
        $newFileContents = $callback($originalFileContents);
        file_put_contents($path, $newFileContents);
    }
}
