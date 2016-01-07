<?php

namespace App\Http\Controllers\Rbac;

//use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vr80s\LaravelRbac\Services\PermissionService;
use Vr80s\LaravelRbac\Services\RoleListener;
use Vr80s\LaravelRbac\Services\RoleService;

class RoleController extends Controller implements RoleListener {

    protected $request;
    protected $roleService;
    protected $permissionService;

    public function __construct(Request $request,
                                RoleService $roleService, PermissionService $permissionService){
        $this->request = $request;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function getIndex(){
        $roles = $this->roleService->getAll();
        return view('role.list', compact('roles'));
    }

    public function getShow($id){
        $role = $this->roleService->getById($id);
        $users = $role->users()->get();
//        dd($users);

        return view('role.show', compact('role','users'));
    }

    public function getCreate(){
        return view('role.create');
    }

    public function PostCreate(){
        return $this->roleService->create($this, $this->request->all());
    }

    public function getDelete($id){
        return $this->roleService->delete($this, $id);
    }

    public function getEdit($id){
        $role = $this->roleService->getById($id);
        return view('role.edit', compact('role'));
    }

    public function postEdit($id){
        return $this->roleService->update($this, $id, $this->request->all());
    }

    public function getPermit($id){
        $role = $this->roleService->getById($id);
        $rolePermissions = $role->permissions()->getRelatedIds();
        $permissions = $this->permissionService->getAllPermissions();

        return view('role.role_permit',compact('role', 'permissions', 'rolePermissions'));
    }

    public function postPermit($id){
        $role = $this->roleService->getById($id);
        $permissions = $this->request->get('permissions');
        $code = 0;

        try{
            $res = $role->permissions()->sync($permissions);
            $msg = json_encode($res);
        }catch (\Exception $e){
            $code = 9;
            $msg = "更新失败".$e->getMessage();
        }

        $rep = ['code'=>$code,'msg'=> $msg];
        return response()->json($rep);

    }

    public function roleCreated($role)
    {
        $errors = ['type'=>'info','msg'=>$role->name.' 添加成功'];
        return \Redirect::action('Rbac\RoleController@index')->with(['errors'=>$errors]);
    }

    public function roleDeleted($role)
    {
        $errors = ['type'=>'info','msg'=>$role->name.' 已删除'];
        return \Redirect::action('Rbac\RoleController@index')->with(['errors'=>$errors]);
    }

    public function roleUpdated($role)
    {
        $errors = ['type'=>'info','msg'=>$role->name.' 修改成功'];
        return \Redirect::action('Rbac\RoleController@index')->with(['errors'=>$errors]);
    }

    public function roleValidationError($errors)
    {
        return \Redirect::back()->withErrors($errors->getMessages());
    }
}
