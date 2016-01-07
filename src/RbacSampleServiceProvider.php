<?php
namespace Vr80s\LaravelRbac;

use Illuminate\Support\ServiceProvider;

class RbacSampleServiceProvider extends ServiceProvider {

    public function boot(){
        $basePath = __DIR__ . '/';

        /**
         * Define route
         */
        if(! $this->app->routesAreCached()){
            require $basePath.'Http/routes.php';
        }

//        $this->loadViewsFrom('');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.vr80s.laravel.create-sample', function($app){
            return $app->make('Vr80s\LaravelRbac\Console\Commands\CreateSampleCommand');
        });

        $this->commands('command.vr80s.laravel.create-sample');


//        $this->app['laravel.hello'] = $this->app->share(function($app){
//            return new Hello($app);
//        });

    }

}