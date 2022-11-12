<?php

namespace App\Providers;

use App\DownloadImage\ConnectImageServer;
use App\DownloadImage\Image;
use Illuminate\Support\ServiceProvider;
use App\DownloadImage\LogConnectionServer;


class ImageDownloadProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $provider= match(env('IMAGE_DRIVER')){
            'unsplash' => ConnectImageServer::class,
            default=> LogConnectionServer::class
        };
        $this->app->bind(Image::class, $provider);
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
