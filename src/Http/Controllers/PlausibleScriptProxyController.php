<?php

namespace MattitjaAB\LaravelPlausibleProxy\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlausibleScriptProxyController
{
    public function __invoke(): Response
    {
        try {
            $script = Cache::remember(
                key: 'plausible_script_js',
                ttl: now()->addHours(6),
                callback: function () {
                    $plausibleDomain = config('plausible-proxy.domain');

                    return Http::timeout(5)
                        ->get("{$plausibleDomain}/js/script.js")
                        ->throw()
                        ->body();
                }
            );
        } catch (RequestException $e) {
            Log::error('Failed to fetch Plausible script: '.$e->getMessage());

            return response('Error fetching Plausible script', 500);
        }

        return response($script)
            ->header('Content-Type', 'application/javascript')
            ->header('Cache-Control', 'public, max-age=86400');
    }
} 