<?php

namespace Devdojo\Genesis;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Laravel\Ui\Presets\Preset;

class Preset extends Preset
{
    public static function install()
    {
        echo 'install';
        // static::updatePackages();

        // $filesystem = new Filesystem();
        // $filesystem->deleteDirectory(resource_path('sass'));
        // $filesystem->copyDirectory(__DIR__ . '/../stubs/default', base_path());

        // static::updateFile(base_path('app/Providers/RouteServiceProvider.php'), function ($file) {
        //     return str_replace("public const HOME = '/home';", "public const HOME = '/';", $file);
        // });

        // static::updateFile(base_path('app/Http/Middleware/RedirectIfAuthenticated.php'), function ($file) {
        //     return str_replace("RouteServiceProvider::HOME", "route('home')", $file);
        // });
    }
}