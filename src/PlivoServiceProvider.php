<?php

namespace Koomai\Plivo;

use Illuminate\Support\ServiceProvider;
use Koomai\Plivo\Plivo;

class PlivoServiceProvider extends ServiceProvider
{
    /**
     * Defer loading of provider
     *
     * @var bool
     */
    // protected $defer = true;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       $dist = __DIR__.'/../config/plivo.php';
       $this->publishes([
           $dist => config_path('plivo.php'),
       ]);
       $this->mergeConfigFrom($dist, 'plivo');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Plivo::class, function($app) {

            $config = $app['config']->get('plivo');
            if(! $config) {
                throw new \RuntimeException('Missing Plivo configuration.');
            }

            return new Plivo($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Plivo::class];
    }
}
