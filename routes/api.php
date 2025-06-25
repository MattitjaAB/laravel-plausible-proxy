<?php

use Illuminate\Support\Facades\Route;
use MattitjaAB\LaravelPlausibleProxy\Http\Controllers\PlausibleEventApiController;

Route::post('api/event', PlausibleEventApiController::class);
