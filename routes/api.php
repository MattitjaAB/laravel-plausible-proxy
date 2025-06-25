<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use MattitjaAB\LaravelPlausibleProxy\Http\Controllers\PlausibleEventApiController;

Route::post('api/event', PlausibleEventApiController::class);
