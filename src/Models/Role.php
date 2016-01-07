<?php

namespace Vr80s\LaravelRbac\Models;

class Role extends Entity
{
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at'];

    protected $validationRules = [
//        'name' => 'required|unique:roles',
        'name' => 'required|max:12',
        'description' => 'required|max:12',
    ];

    public function users(){
//        return $this->belongsToMany('App\User', 'user_role', 'role_id', 'user_id');
        return $this->belongsToMany(\Config::get('auth.model'), 'user_role', 'role_id', 'user_id');
    }

    public function permissions(){
        return $this->belongsToMany('Vr80s\LaravelRbac\Models\Permission', 'role_permission', 'role_id', 'permission_id');
    }

}