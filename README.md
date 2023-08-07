<p align="center"><a href="https://github.com/thedevdojo/genesis" target="_blank"><img src="https://raw.githubusercontent.com/thedevdojo/genesis/main/art/logo2.svg?logo=true" width="300" alt="Laravel Logo"></a></p>
<p align="center" class="flex mx-auto space-x-2">
<a href="https://github.com/thedevdojo/genesis/actions"><img src="https://github.com/thedevdojo/genesis/actions/workflows/main.yml/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/devdojo/genesis"><img src="https://img.shields.io/packagist/dt/devdojo/genesis" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/devdojo/genesis"><img src="https://img.shields.io/packagist/v/devdojo/genesis" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/devdojo/genesis"><img src="https://img.shields.io/packagist/l/devdojo/genesis" alt="License"></a>
</p>

## About Genesis

Genesis is a Laravel Starter Kit that utilizes the Tallstack as well as single-file Volt and Folio files. This starter kit contains Authentication, User Dashboard, User Profile, and a set of UI Components.

<p><img src="https://cdn.devdojo.com/images/august2023/genesis-cover.png" alt="genesis cover" /></p>

It will be beneficial to have a good understanding of the following technologies (which Genesis is built with):

- [TailwindCSS](https://tailwindcss.com)
- [AlpineJS](https://alpinejs.dev)
- [Laravel](https://laravel.com)
- [Livewire](https://livewire.laravel.com)
- [Folio](https://github.com/laravel/folio)
- [Volt](https://github.com/livewire/volt)

Learn how to install and configure Geneses below.

## Installation

This preset is intended to be installed into a fresh [Laravel application](https://laravel.com).

> Currently Folio, Volt, and Livewire are still in Beta, so for that reason you'll need to set your *minimum-stability* to *dev*, by finding the following line inside of your `composer.json` file `"minimum-stability": "stable",` and replace with `"minimum-stability": "dev",`

After creating a new Laravel application (and updating the minimum-stability) you can install Genesis with the following commands:

```bash
composer require devdojo/genesis dev-main
php artisan ui genesis
npm install
npm run dev
```

Finally, you'll want to connect a database inside of your application `.env` file and run the following migrations:

```
php artisan migrate
```

Visit your application homepage and you should be good to go 🤘

## Authentication

```php
// Usage description here
```

### Testing

Genesis has some basic tests to test out the authentication functionality. You can check those tests by running the following command:

```bash
./vendor/bin/pest
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tony@devdojo.com instead of using the issue tracker.

## Credits

-   [Tony Lea](https://github.com/devdojo)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
