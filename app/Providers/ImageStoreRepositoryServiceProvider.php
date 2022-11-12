<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImageStoreRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Http\Contracts\ImageStoreIntreface',
            'App\Http\Repository\ImageStoreRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
}
