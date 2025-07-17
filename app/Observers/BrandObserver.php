<?php

namespace App\Observers;

use App\Domain\Cars\Services\CarCacheServer;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    /**
     * Handle the Car "created" event.
     */
    public function created(Brand $brand): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * Handle the Car "updated" event.
     */
    public function updated(Brand $brand): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * Handle the Car "deleted" event.
     */
    public function deleted(Brand $brand): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * Handle the Car "restored" event.
     */
    public function restored(Brand $brand): void
    {
        $this->clearCarSearchCache();
    }

    protected function clearCarSearchCache(): void
    {
        CarCacheServer::clearCarSearchCache();
    }
}
