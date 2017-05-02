<?php

namespace CodeEduBook\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CodeEduBook\Repositories\CategoryRepository::class, \CodeEduBook\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodeEduBook\Repositories\BookRepository::class, \CodeEduBook\Repositories\BookRepositoryEloquent::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
