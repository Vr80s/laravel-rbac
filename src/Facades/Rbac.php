<?php
namespace Vr80s\LaravelRbac\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vr80s\LaravelRbac\Services\RbacService
 */
class Rbac extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'facade.vr80s.laravel.rbac';
    }
}
