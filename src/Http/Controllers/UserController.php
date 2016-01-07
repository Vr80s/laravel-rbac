<?php

namespace App\Http\Controllers\Rbac;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Vr80s\LaravelRbac\Services\RoleService;
use Vr80s\LaravelRbac\Services\UserService;

class UserController extends Controller {

    protected $request;
    protected $users;
    protected $userService;
    protected $roleService;

    public function __construct(Request $request,
                                User $users, UserService $userService,
                                RoleService $roleService){
        $this->request = $request;
        $this->users = $users;
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    public function getIndex(){
        $users = $this->users->paginate(10);

        return view('user.list', compact('users'));
    }

    public function getGrant($id){
        $user = $this->users->find($id);
        $roles = $this->roleService->getAll();
        $userroleids = $user->roles()->getRelatedIds();

        return view('user.grant', compact('user', 'roles', 'userroleids'));
    }

    public function postGrant($id){
        $user = $this->users->find($id);
        $roleids = $this->request->get('roleids');

        $rep = $this->userService->syncRoles($user, $roleids);
        return response()->json($rep);
    }



}
