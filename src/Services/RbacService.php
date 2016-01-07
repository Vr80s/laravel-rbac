<?php
namespace Vr80s\LaravelRbac\Services;

use Session;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;

class RbacService {

    protected $user;
    protected $roleService;
    protected $routerService;

    public function __construct(RoleService $roleService, RouterService $routerService, Guard $guard){
        $this->roleService = $roleService;
        $this->routerService = $routerService;
        $this->user = $guard->user();
    }

    public function check(Request $request){
        if(! \Config::get('laravel-rbac.EnableCheck')){
            return true;
        }

        $roleids = $this->getRoleIds();
        $isSuper = $this->isSuper($roleids);
        if($isSuper){
            return true;
        }

        $permissionId = $this->routerService->getRouteHashId($request->route());
        $permissionIds = $this->roleService->getPermissions($roleids);
        if(in_array($permissionId,$permissionIds)){
            return true;
        }

        return false;
    }

    public function getRoleIds(){

        if(Session::has('roleids')){
            return Session::get('roleids');
        }

        $roleids = $this->user->roles()->getRelatedIds();
        Session::set('roleids', $roleids);

        return Session::get('roleids');
    }

    public function isSuper($roleids){
        if(Session::has('Super')){
            return true;
        }
        $roles = $this->roleService->getRoleNames($roleids);
        if($roles->contains('Super')){
            Session::set('Super', true);
            return true;
        }
        return false;
    }

}