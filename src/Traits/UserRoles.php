<?php
namespace Vr80s\LaravelRbac\Traits;

trait UserRoles {

    public function roles(){
        return $this->belongsToMany(
            'Vr80s\LaravelRbac\Models\Role',
            'user_role', 'user_id', 'role_id');
    }
}