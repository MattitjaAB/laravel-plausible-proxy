<?php

use Illuminate\Support\Facades\Route;
use MattitjaAB\LaravelPlausibleProxy\Http\Controllers\PlausibleScriptProxyController;

Route::get('/js/script.js', PlausibleScriptProxyController::class);
