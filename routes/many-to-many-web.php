<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Role;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/user/{id}/insert/role', function ($id) {
    $user = User::findOrFail($id);

    $role = new Role(['name' => 'Administrator']);

    $user->roles()->save($role);
});

Route::get('/user/{id}/roles', function ($id) {
    $user = User::find($id);

    return $user->roles;
});


Route::get('/update', function () {
    $user = User::FindOrFail(1);

    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name = 'Administrator') {
                $role->name = 'Admin';

                $role->save();
            }
        }
    }
});

Route::get('/delete', function () {
    $user = User::findOrFail(1);

    $user->roles()->where('role_id', 20)->delete();
});

Route::get('/role/{role_id}/attach/user/{user_id}', function ($role_id, $user_id) {
    $user = User::find($user_id);
    $user->roles()->attach($role_id);

});

Route::get('/role/{role_id}/detach/user/{user_id}', function ($role_id, $user_id) {
    $user = User::find($user_id);
    $user->roles()->detach($role_id);

});


Route::get('/user/{user_id}/sync/role/{role_id}', function ($user_id, $role_id) {
    $user = User::findOrFail($user_id);

    $user->roles()->sync([$role_id]);
});