<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

it('returns plausible script from cache', function () {
    Cache::put('plausible_script_js', 'console.log("Cached script");', now()->addHours(6));

    $response = $this->get('/js/script.js');

    $response->assertStatus(200)
        ->assertHeader('Content-Type', 'application/javascript')
        ->assertSee('Cached script');
});

it('fetches plausible script if not cached', function () {
    Http::fake([
        config('plausible-proxy.domain').'/js/script.js' => Http::response('console.log("Plausible script");', 200),
    ]);

    $response = $this->get('/js/script.js');

    $response->assertStatus(200)
        ->assertHeader('Content-Type', 'application/javascript')
        ->assertSee('Plausible script');

    expect(Cache::get('plausible_script_js'))->toBe('console.log("Plausible script");');
});

it('handles failed script fetch', function () {
    Http::fake([
        config('plausible-proxy.domain').'/js/script.js' => Http::response('', 500),
    ]);

    $response = $this->get('/js/script.js');

    $response->assertStatus(500)
        ->assertSee('Error fetching Plausible script');
});

it('rejects invalid event data', function () {
    $response = $this->postJson('/api/event', [
        'n' => 'pageview',
        'u' => 'invalid-url',
        'd' => 'example.com',
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure(['status', 'errors']);
});

it('accepts valid event data and forwards headers', function () {
    config()->set('plausible-proxy.domain', 'https://plausible.io');

    Http::fake([
        'https://plausible.io/api/event' => function ($request) {
            dump($request->headers());
            dump($request->data());

            return Http::response(['status' => 'queued'], 200);
        },
    ]);

    $headers = [
        'User-Agent' => 'TestAgent',
        'Accept' => 'application/json',
    ];

    $response = $this->postJson('/api/event', [
        'n' => 'pageview',
        'u' => 'https://example.com/page',
        'd' => 'example.com',
    ], $headers);

    $response->assertStatus(200)
        ->assertJson(['status' => 'queued']);

    Http::assertSentCount(1);

    Http::assertSent(function ($request) {
        dump($request->url());
        dump($request->headers());
        dump($request->data());

        return $request->url() === 'https://plausible.io/api/event'
            && isset($request['n']) && $request['n'] === 'pageview'
            && isset($request['u']) && $request['u'] === 'https://example.com/page'
            && isset($request['d']) && $request['d'] === 'example.com';
    });
});
