<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('api/event', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'n' => 'required|string',
        'u' => 'required|url',
        'd' => 'required|string',
        'r' => 'nullable|url',
        'm' => 'nullable|string',
        'p' => 'nullable|array',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
    }

    Concurrency::defer(fn () => Http::post(config('plausible-proxy.domain').'/api/event', $request->all()));

    return response()->json(['status' => 'queued']);
});
