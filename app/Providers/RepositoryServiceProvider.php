<?php

namespace App\Providers;

use App\Interfaces\V1\CategoryRepositoryInterface;
use App\Interfaces\V1\ProductRepositoryInterface;
use App\Repositories\V1\CategoryRepository;
use App\Repositories\V1\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
