<?php

namespace App\Providers;

use App\Blog\Repositories\Category\CacheDecorator;
use App\Blog\Repositories\Category\EloquentCategory;
use App\Blog\Service\Cache\LaravelCache;
use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Blog\Repositories\Category\CategoryInterface', function ($app) {
            // Assign the category repo to a variable
            $category = new EloquentCategory(new Category);

            // Wrap the category repo in the
            // CacheDecorator and return it
            return new CacheDecorator(
                $category,
            // Our new Cache service class:
                new LaravelCache(new Cache, 600)
            );
        });
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
