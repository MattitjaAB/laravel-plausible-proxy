<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::post('api/event', function (Request $request) {
    $data = json_decode($request->getContent(), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        return response()->json(['error' => 'Invalid JSON format'], 422);
    }

    $validator = Validator::make($data, [
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

    $headers = collect($request->headers->all())
        ->mapWithKeys(fn ($value, $key) => [$key => is_array($value) ? implode(', ', $value) : $value])
        ->all();

    Http::withHeaders($headers)->post(config('plausible-proxy.domain').'/api/event', $data);

    return response()->json(['status' => 'queued']);
});
