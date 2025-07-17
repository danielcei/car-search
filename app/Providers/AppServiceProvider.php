<?php

namespace App\Providers;

use App\Domain\Cars\Repositories\BrandRepositoryInterface;
use App\Domain\Cars\Repositories\CarRepositoryInterface;
use App\Domain\Cars\Repositories\CategoryRepositoryInterface;
use App\Infrastructure\Eloquent\Repositories\BrandRepository;
use App\Infrastructure\Eloquent\Repositories\CarRepository;
use App\Infrastructure\Eloquent\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CarRepositoryInterface::class,
            CarRepository::class
        );
        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
