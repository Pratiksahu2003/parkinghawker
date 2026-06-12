<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\ParkingRepositoryInterface::class,
            \App\Repositories\InMemoryParkingRepository::class
        );
        $this->app->bind(
            \App\Repositories\BlogRepositoryInterface::class,
            \App\Repositories\InMemoryBlogRepository::class
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
