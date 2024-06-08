# WireUse

[![Latest Version on Packagist](https://img.shields.io/packagist/v/foxws/wireuse.svg?style=flat-square)](https://packagist.org/packages/foxws/wireuse)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/foxws/wireuse/run-tests.yml?branch=3.x&label=tests&style=flat-square)](https://github.com/foxws/wireuse/actions?query=workflow%3Arun-tests+branch%3A3.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/foxws/wireuse/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/foxws/wireuse/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3A3.x)
[![Total Downloads](https://img.shields.io/packagist/dt/foxws/wireuse.svg?style=flat-square)](https://packagist.org/packages/foxws/wireuse)

This packages offers a collection of useful [Livewire](https://livewire.laravel.com/) utilities and components. :)

It is made to assemble your Livewire and Blade components yourself, rather than extending from an existing framework or baseset.

It shares the same idea as [VueUse](https://vueuse.org/), but for Laravel Livewire.

If you have a suggestion, idea or feedback, please feel free to send a PR or create a discussion. :)

## Documentation

You will find full documentation on the dedicated [documentation](https://foxws.nl/projects/wireuse) site.

> NOTE: The documentation is far from complete, see [discussion](https://github.com/foxws/wireuse/discussions/3) for progress and ideas.

## Installation

You can install the package via composer:

```bash
composer require foxws/wireuse
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="wireuse-config"
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="wireuse-views"
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Foxws](https://github.com/foxws)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
