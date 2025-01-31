# laravel-plausible-proxy

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mattitjaab/laravel-plausible-proxy.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/laravel-plausible-proxy)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mattitjaab/laravel-plausible-proxy/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mattitjaab/laravel-plausible-proxy/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mattitjaab/laravel-plausible-proxy/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mattitjaab/laravel-plausible-proxy/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mattitjaab/laravel-plausible-proxy.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/laravel-plausible-proxy)

A Laravel package for proxying Plausible Analytics, improving performance.

## Requirements
- Laravel 11
- PHP 8.3+

## 🚀 Installation

1. Install the package via Composer:
   ```sh
   composer require mattitjaab/laravel-plausible-proxy
   ```

2. Publish the configuration file:
   ```sh
   php artisan vendor:publish --tag=plausible-proxy-config
   ```

3. Add the following environment variables to your `.env` file:
   ```env
   PLAUSIBLE_DOMAIN=https://plausible.io
   ```

## ⚙️ Configuration

The `config/plausible-proxy.php` file allows you to customize the plausible domain:

```php
return [
    'domain' => env('PLAUSIBLE_DOMAIN', 'https://plausible.io'),
];
```

## 🔥 Usage

### **1. Proxying the JavaScript file**
This package proxies Plausible's `script.js` while caching it to improve performance and reduce external requests.

After installation, you can include the script like this:
```html
<script defer data-domain="example.com" src="/js/script.js"></script>
```

The route `/js/script.js` is automatically handled and caches the script for **6 hours**.

### **2. Sending Events to Plausible**
Instead of sending events directly to plausible.io, the script is loaded from /js/script.js and proxies the request to Plausible via /api/event, helping to prevent blocking by ad blockers.

## ✅ Features

- 🚀 **Fast & Optimized**: Caches the Plausible script to reduce external calls. 
- ✅ No issues with ad blockers: Proxies the request via a local API endpoint.
- 🛠 **Fully Configurable**: Easily set your own Plausible instance via `.env`.

## 🛠 Testing

You can run tests with:
```sh
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
