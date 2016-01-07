<?php
namespace Vr80s\LaravelRbac\Services;

interface RoleListener {
    public function roleCreated($role);
    public function roleDeleted($role);
    public function roleUpdated($role);
    public function roleValidationError($errors);
}