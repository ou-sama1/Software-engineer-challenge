<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ProductService::class, function ($app) {
            return new ProductService(
                $app->make(ProductRepository::class),
                $app->make(CategoryRepository::class)
            );
        });

        $this->app->singleton(CategoryService::class, function ($app) {
            return new CategoryService($app->make(CategoryRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
