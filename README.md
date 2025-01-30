# This is my package laravel-plausible-proxy

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mattitjaab/laravel-plausible-proxy.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/laravel-plausible-proxy)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mattitjaab/laravel-plausible-proxy/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mattitjaab/laravel-plausible-proxy/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mattitjaab/laravel-plausible-proxy/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mattitjaab/laravel-plausible-proxy/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mattitjaab/laravel-plausible-proxy.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/laravel-plausible-proxy)

A Laravel package for proxying Plausible Analytics, improving performance and privacy.

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
   PLAUSIBLE_SITE=example.com
   ```

4. **(Optional)** If you want to use Laravel Queues to send events in the background, ensure your queue driver is set up correctly:
   ```env
   QUEUE_CONNECTION=database
   ```
   Then run migrations to create the necessary queue tables:
   ```sh
   php artisan queue:table
   php artisan migrate
   ```

## ⚙️ Configuration

The `config/plausible-proxy.php` file allows you to customize the package settings:

```php
return [
    'domain' => env('PLAUSIBLE_DOMAIN', 'https://plausible.io'),
    'site' => env('PLAUSIBLE_SITE', 'example.com'),
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
Instead of sending events directly to `plausible.io`, you can now send them to `/api/event`, and they will be queued and processed asynchronously.

Example request:
```sh
curl -X POST "https://example.com/api/event" \
     -H "Content-Type: application/json" \
     -d '{"n":"pageview","u":"https://example.com/page","d":"example.com"}'
```

## ✅ Features

- 🚀 **Fast & Optimized**: Caches the Plausible script to reduce external calls.
- 🔒 **Privacy-Friendly**: Prevents direct calls to `plausible.io`.
- 📊 **Improved Performance**: Events are processed via Laravel Queues to avoid blocking user interactions.
- 🛠 **Fully Configurable**: Easily set your own Plausible instance and domain via `.env`.

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
