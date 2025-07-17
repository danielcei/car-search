<?php

namespace App\Application\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    public function remember(string $key, $ttl, callable $callback)
    {
        return Cache::remember($key, $ttl, $callback);
    }

    public function forget(string $key): void
    {
        Cache::forget($key);
    }
}
