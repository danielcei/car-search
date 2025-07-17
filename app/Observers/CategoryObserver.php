<?php

namespace App\Observers;

use App\Domain\Cars\Services\CarCacheServer;
use App\Models\Category;

class CategoryObserver
{
    /**
     * @param Category $category
     * @return void
     */
    public function created(Category $category): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Category $category
     * @return void
     */
    public function updated(Category $category): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Category $category
     * @return void
     */
    public function deleted(Category $category): void
    {
        $this->clearCarSearchCache();
    }

    /**
     * @param Category $category
     * @return void
     */
    public function restored(Category $category): void
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
