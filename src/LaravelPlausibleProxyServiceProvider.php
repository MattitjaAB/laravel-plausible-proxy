<?php

namespace MattitjaAB\LaravelPlausibleProxy;

use MattitjaAB\LaravelPlausibleProxy\Commands\LaravelPlausibleProxyCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPlausibleProxyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-plausible-proxy')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_plausible_proxy_table')
            ->hasCommand(LaravelPlausibleProxyCommand::class);
    }
}
