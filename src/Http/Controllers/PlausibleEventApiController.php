<?php

namespace MattitjaAB\LaravelPlausibleProxy\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use MattitjaAB\LaravelPlausibleProxy\Http\Requests\PlausibleEventRequest;

class PlausibleEventApiController
{
    public function __invoke(PlausibleEventRequest $request): JsonResponse
    {
        $headers = collect($request->headers->all())
            ->mapWithKeys(fn ($value, $key) => [$key => is_array($value) ? implode(', ', $value) : $value])
            ->all();

        Http::withHeaders($headers)
            ->post(config('plausible-proxy.domain').'/api/event', $request->validated());

        return response()->json(['status' => 'queued']);
    }
} 