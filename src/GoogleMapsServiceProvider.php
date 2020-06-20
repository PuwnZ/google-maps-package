<?php

namespace Puwnz\GoogleMapsPackage;

use Illuminate\Support\ServiceProvider;

class GoogleMapsServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('GoogleMaps', function () {
            return new \Puwnz\GoogleMapsPackage\GoogleMaps;
        });
    }
}
