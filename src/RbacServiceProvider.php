<?php
namespace Vr80s\LaravelRbac;

use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(){

        $this->app->singleton('facade.vr80s.laravel.rbac', function ($app) {
            return $app->make('Vr80s\LaravelRbac\Services\RbacService');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'facade.vr80s.laravel.rbac',
        ];
    }
}