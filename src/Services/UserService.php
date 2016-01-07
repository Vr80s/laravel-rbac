<?php
namespace Vr80s\LaravelRbac\Services;

use Illuminate\Contracts\Auth\Guard;

class UserService
{

    protected $user;
    protected $users;
    protected $roleService;

    public function __construct(RoleService $roleService, Guard $guard)
    {
        $this->roleService = $roleService;
        $this->user = $guard->user();
        $this->users = \App::make(\Config::get('auth.model'));
    }

    public function getUser($id = null){
        if($id){
            return $this->users->find($id);
        }
        return $this->user;
    }

    public function getRoleIds($user = null){
        if(empty($user)){
            return $this->user->roles()->getRelatedIds()->toArray();
        }
        return $user->roles()->getRelatedIds()->toArray();
    }

    public function syncRoles($user, $roleids){
//        $roleids = $this->getRoleIds($user);
        $code = 0;
        try{
//            $res = $this->user->roles()->sync($roleids);
            $res = $user->roles()->sync($roleids);
            $msg = json_encode($res);
        }catch (\Exception $e){
            $code = 9;
            $msg = "更新失败".$e->getMessage();
        }
        $rep = ['code'=>$code,'msg'=> $msg];
        return $rep;
    }

}