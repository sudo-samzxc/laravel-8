<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Address;

Route::get('/', function () {
    return view('welcome');
});

Route::get('insert', function () {
    $user = User::findOrFail(2);

    $address = new Address(['name' => 'Tacloban, Nula-tula']);

    $user->address()->save($address);
});

Route::get('update', function () {
    $address = Address::whereUserId(1)->first();

    $address->name = "Japan, Tokyo";

    $address->save();
});

Route::get('read', function () {
    $user = User::findOrFail(1);

    return $user->address->name;
});


Route::get('delete', function () {
    $user = User::find(2);

    $user->address->delete();

    return 'done';
});