<?php
namespace Vr80s\LaravelRbac\Services;

use Vr80s\LaravelRbac\Models\Permission;

class PermissionService {

    protected $model;

    public function __construct(Permission $model){
        $this->model = $model;
    }

    public function getById($id){
        return $this->model->find($id);
    }

    public function getAllPermissions(){
        return $this->model->orderBy('uri')->get();
    }

    public function getValidPermissions(){
        return $this->model->where('status','=','VALID')->orderBy('uri')->get();
    }

    public function syncPermissions($routeList){
        $permissions = $this->model->all();
        $result = [
            'invalid'   => 0,
            'update'    => 0,
            'add'       => 0,
        ];

        /**
         * 更新permission失效
         */
        $permissionValid = array();
        foreach ($permissions as $p) {
            $key = $p->getKey();
            $valid = false;
            foreach ($routeList as $r) {
                if(in_array($key, $r)){
                    $valid = true;
                    array_push($permissionValid, $p);
                    break;
                }
            }
            if(!$valid){
                $result['invalid'] = $result['invalid']+1;
                $p->status = 'INVALID';
                $p->save();
            }
        }

        /**
         * 添加和更新新的permission
         */
        foreach ($routeList as $r) {
            $exist = false;
            $permissionTemp = null;
            foreach ($permissionValid as $p) {
                $key = $p->getKey();
                if(in_array($key, $r)){
                    $exist=true;
                    $permissionTemp = $p;
                }
            }
            if($exist){
                $result['update'] = $result['update']+1;
                $permissionTemp->update($r);
            }else{
                $result['add'] = $result['add']+1;
                $this->model->newInstance($r)->save();
            }
        }

        return $result;
    }

}