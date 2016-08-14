<?php

namespace NotificationChannels\Plivo;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        $this->app->when(PlivoChannel::class)
            ->needs(Plivo::class)
            ->give(function () {
                return new Plivo(config('services.plivo'));
            });

    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
