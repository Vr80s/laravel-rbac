<?php
namespace Vr80s\LaravelRbac\Services;

use DB;
use Vr80s\LaravelRbac\Models\Role;

class RoleService {

    protected $model;

    public function __construct(Role $model){
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->all();
    }

    public function getById($id){
        return $this->model->find($id);
    }

    public function getRoleNames($roleid){
        return $this->model->whereIn('id',$roleid)->lists('name');
    }

    public function getPermissions($roleid){
        return DB::table('role_permission')->whereIn('role_id',$roleid)->lists('permission_id');
    }

    public function create(RoleListener $listener, $data, $validator = null)
    {
        // check the passed in validator
        if ($validator && ! $validator->isValid()) {
            return $listener->roleValidationError($validator->getErrors());
        }

        $role = $this->newRole($data);

        if ( ! $role->save()) {
            return $listener->roleValidationError($role->getErrors());
        }

        return $listener->roleCreated($role);
    }

    public function delete(RoleListener $listener, $id)
    {
        $role = $this->getById($id);
        $role->delete();

        return $listener->roleDeleted($role);
    }

    public function update(RoleListener $listener, $id, $data)
    {
        $role = $this->getById($id);

        if ( ! $role->update($data)) {
            return $listener->roleValidationError($role->getErrors());
        }

        return $listener->roleUpdated($role);
    }

    protected function newRole($data)
    {
        return $this->model->newInstance($data);
    }

}