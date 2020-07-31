<?php

namespace App\Providers;

use App\Repository\BaseRepositoryInterface; 
use App\Repository\ProductRepositoryInterface; 
use App\Repository\WishlistRepositoryInterface; 

use App\Repository\Eloquent\BaseRepository; 
use App\Repository\Eloquent\ProductRepository; 
use App\Repository\Eloquent\WishlistRepository; 

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            BaseRepositoryInterface::class, 
            BaseRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class, 
            ProductRepository::class
        );

        $this->app->bind(
            WishlistRepositoryInterface::class, 
            WishlistRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
