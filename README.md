# This is my package laravel-plausible-proxy

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mattitjaab/laravel-plausible-proxy.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/laravel-plausible-proxy)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mattitjaab/laravel-plausible-proxy/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mattitjaab/laravel-plausible-proxy/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mattitjaab/laravel-plausible-proxy/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mattitjaab/laravel-plausible-proxy/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mattitjaab/laravel-plausible-proxy.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/laravel-plausible-proxy)

A Laravel package for proxying Plausible Analytics, improving performance and privacy.

## Installation

You can install the package via composer:

```bash
composer require mattitjaab/laravel-plausible-proxy
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-plausible-proxy-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-plausible-proxy-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-plausible-proxy-views"
```

## Usage

```php
$laravelPlausibleProxy = new MattitjaAB\LaravelPlausibleProxy();
echo $laravelPlausibleProxy->echoPhrase('Hello, MattitjaAB!');
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

- [Mathias Palmqvist](https://github.com/mathiaspalmqvist)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
