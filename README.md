# WireUse

[![Latest Version on Packagist](https://img.shields.io/packagist/v/foxws/wireuse.svg?style=flat-square)](https://packagist.org/packages/foxws/wireuse)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/foxws/wireuse/run-tests.yml?branch=3.x&label=tests&style=flat-square)](https://github.com/foxws/wireuse/actions?query=workflow%3Arun-tests+branch%3A3.x)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/foxws/wireuse/fix-php-code-style-issues.yml?branch=3.x&label=code%20style&style=flat-square)](https://github.com/foxws/wireuse/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3A3.x)
[![Total Downloads](https://img.shields.io/packagist/dt/foxws/wireuse.svg?style=flat-square)](https://packagist.org/packages/foxws/wireuse)

This packages offers a collection of useful [Livewire](https://livewire.laravel.com/) utilities and components.

## Installation

You can install the package via composer:

```bash
composer require foxws/wireuse
```

Optionally, you can publish the config file with:

```bash
php artisan vendor:publish --tag="wireuse-config"
```

## Usage

This is a selection of the available features:

- [Property Synthesizers](docs/wireuse-property-synthesizers) - Force usage of model route-keys, instead of model ids.
- [Components](docs/wireuse-extending-components) - Components like `Page` and useful traits.
- [Forms](docs/wireuse-extending-forms) - Traits and extensions for [Livewire Forms](https://livewire.laravel.com/docs/forms).
- [State Objects](docs/wireuse-state-objects) - State objects are based on states that you find, for example, in a VueJS Store.
- [Structure Scout](docs/wireuse-structure-scout) - Supported by [spatie/php-structure-discoverer](https://github.com/spatie/php-structure-discoverer) package, it provides a scout to discover and register components, which also offers benefits such as caching.
- [HTML](docs/wireuse-laravel-html-spatie) - Extends Spatie's [laravel-html](https://spatie.be/docs/laravel-html/v3/introduction) to generate HTML using a clean, simple and easy to read API.

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
