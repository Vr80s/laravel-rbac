<?php

namespace App\Http\Controllers\Rbac;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vr80s\LaravelRbac\Services\PermissionService;
use Vr80s\LaravelRbac\Services\RouterService;

class PermissionController extends Controller {

    protected $request;
    protected $routerService;
    protected $permissionService;

    public function __construct(Request $request,
                                RouterService $routerService, PermissionService $permissionService){
        $this->request = $request;
        $this->routerService = $routerService;
        $this->permissionService = $permissionService;
    }

    public function getIndex(){
        $permissions = $this->permissionService->getAllPermissions();

        return view('permission.list', compact('permissions'));
    }

    public function getShow($id){
        $permission = $this->permissionService->getById($id);
        return view('permission.show', compact('permission'));
    }

    public function postEdit($id){
        $permission = $this->permissionService->getById($id);
        $permission->description = $this->request->get('description');
        $res = $permission->save();

        if($this->request->ajax()){
            return response($res);
        }else{
            return redirect('rbac/permission');
        }
    }

    public function getDelete($id){
        $permission = $this->permissionService->getById($id);
        $res = $permission->delete();

        if($this->request->ajax()){
            return response($res);
        }else{
            return redirect('rbac/permission');
        }
    }

    public function getSync(){
        $routeList = $this->routerService->getAllByMiddleware('auth');
        $res = $this->permissionService->syncPermissions($routeList);

        if($this->request->ajax()){
            return response($res);
        }else{
            $errors = ['type'=>'info','msg'=>'同步完成 '.json_encode($res)];
//            return redirect('rbac/permission')->with(['errors'=>$errors]);
            return \Redirect::action('Rbac\PermissionController@index')->with(['errors'=>$errors]);
        }
    }

}
