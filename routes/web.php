<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/js/script.js', function () {
    $plausibleDomain = config('plausible-proxy.domain');

    if (Cache::has('plausible_script_js')) {
        return response(Cache::get('plausible_script_js'))
            ->header('Content-Type', 'application/javascript')
            ->header('Cache-Control', 'public, max-age=86400');
    }

    $response = Http::timeout(5)->get("{$plausibleDomain}/js/script.js");

    if ($response->successful()) {
        $script = $response->body();
        Cache::put('plausible_script_js', $script, now()->addHours(6));

        return response($script)
            ->header('Content-Type', 'application/javascript')
            ->header('Cache-Control', 'public, max-age=86400');
    }

    return response('Error fetching Plausible script', 500);
});

Route::get('/api/routes', function () {
    return response()->json(
        collect(Route::getRoutes())->map(fn ($route) => $route->uri())
    );
});
