<?php

Route::group(['prefix' => strtolower(Config::get('laravel-rbac.prefix')),
        'middleware' => Config::get('laravel-rbac.middleware'),
        'namespace' => Config::get('laravel-rbac.controllerNameSpace')],function(){

    Route::get('user', 'UserController@getIndex');
    Route::get('user/{id}/grant', 'UserController@getGrant');
    Route::post('user/{id}/grant', 'UserController@postGrant');

    Route::get('role', 'RoleController@getIndex');
    Route::get('role/create', 'RoleController@getCreate');
    Route::post('role/create', 'RoleController@postCreate');
    Route::get('role/{id}', 'RoleController@getShow');
    Route::get('role/{id}/delete', 'RoleController@getDelete');
    Route::get('role/{id}/edit', 'RoleController@getEdit');
    Route::post('role/{id}/edit', 'RoleController@postEdit');
    Route::get('role/{id}/permit', 'RoleController@getPermit');
    Route::post('role/{id}/permit', 'RoleController@postPermit');

    Route::get('permission', 'PermissionController@getIndex');
    Route::get('permission/sync', 'PermissionController@getSync');
    Route::get('permission/{id}', 'PermissionController@getShow');
    Route::post('permission/{id}', 'PermissionController@postEdit');
    Route::get('permission/{id}/delete', 'PermissionController@getDelete');

});
