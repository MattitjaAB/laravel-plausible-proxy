<?php

namespace MattitjaAB\LaravelPlausibleProxy;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPlausibleProxyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-plausible-proxy')
            ->hasConfigFile()
            ->hasRoutes(['web', 'api']);
    }
}
