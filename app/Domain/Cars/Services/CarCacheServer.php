<?php

namespace App\Domain\Cars\Services;

use Illuminate\Support\Facades\Redis;

class CarCacheServer
{
    /**
     * @return void
     */
    public static function clearCarSearchCache(): void
    {
        Redis::connection()->client()->flushAll();
    }
}
