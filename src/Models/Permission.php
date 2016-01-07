<?php

namespace Vr80s\LaravelRbac\Models;

class Permission extends Entity
{
    protected $table = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'uri', 'method', 'action', 'description', 'status'];

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
        'uri' => 'required',
        'action' => 'required',
    ];

}