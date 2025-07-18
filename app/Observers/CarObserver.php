<?php

namespace App\Observers;

use App\Domain\Cars\Services\CarCacheServer;
use App\Models\Car;
use Illuminate\Support\Facades\Cache;

class CarObserver
{
    /**
     * @param Car $car
     * @return void
     */
    public function created(Car $car): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Car $car
     * @return void
     */
    public function updated(Car $car): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Car $car
     * @return void
     */
    public function deleted(Car $car): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Car $car
     * @return void
     */
    public function deleting(Car $car): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Car $car
     * @return void
     */
    public function restored(Car $car): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @return void
     */
    protected function clearCarSearchCache(): void
    {
        CarCacheServer::clearCarSearchCache();
    }
}
