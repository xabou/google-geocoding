<?php

namespace Xabou\Geocoding;

use Illuminate\Support\ServiceProvider;

class GeocodingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/geocoding.php' => config_path('geocoding.php')], 'geocoding-config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Geocoder', function () {
            return new Geocoder();
        });
    }

}