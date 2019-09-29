<?php

namespace App\Providers;

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
            'App\Repositories\DataSourceRepositoryInterface',
            'App\Repositories\CsvDataManager'
        );
        $this->app->bind(
            'App\Repositories\RetentionRepositoryInterface',
            'App\Repositories\RetentionDataManager'
        );
        $this->app->bind(
            'App\Repositories\DataFormatterRepositoryInterface',
            'App\Repositories\JsonDataFormatter'
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
