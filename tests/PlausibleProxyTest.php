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
        'https://plausible.io/js/script.js' => Http::response('console.log("Plausible script");', 200),
    ]);

    $response = $this->get('/js/script.js');

    $response->assertStatus(200)
        ->assertHeader('Content-Type', 'application/javascript')
        ->assertSee('Plausible script');

    expect(Cache::get('plausible_script_js'))->toBe('console.log("Plausible script");');
});

it('handles failed script fetch', function () {
    Http::fake([
        'https://plausible.io/js/script.js' => Http::response('', 500),
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

it('accepts valid event data and defers request', function () {
    Http::fake();

    $concurrencyMock = Mockery::mock('alias:Illuminate\Support\Facades\Concurrency');
    $concurrencyMock->shouldReceive('defer')->once()->andReturnUsing(function ($callback) {
        $callback();
    });

    $response = $this->postJson('/api/event', [
        'n' => 'pageview',
        'u' => 'https://example.com/page',
        'd' => 'example.com',
    ]);

    $response->assertStatus(200)
        ->assertJson(['status' => 'queued']);

    Http::assertSent(fn ($request) => $request->url() === config('plausible-proxy.domain').'/api/event' &&
        $request['n'] === 'pageview'
    );

    Mockery::close();
});
