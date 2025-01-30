<?php

namespace MattitjaAB\LaravelPlausibleProxy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MattitjaAB\LaravelPlausibleProxy\LaravelPlausibleProxy
 */
class LaravelPlausibleProxy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \MattitjaAB\LaravelPlausibleProxy\LaravelPlausibleProxy::class;
    }
}
