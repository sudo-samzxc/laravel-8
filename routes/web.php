<?php

use App\Models\User;
use Carbon\Traits\Rounding;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/posts', PostsController::class);
Route::get('/dates', function () {
    $date = new DateTime('+1 week');

    echo $date->format('m-d-Y');
    echo '<br/>';
    echo Carbon::now();
});

Route::get('/getname', function () {
    $user = User::find(1);

    echo $user->name;
});


Route::get('/setname', function () {
    $user = User::find(1);
    $user->name = 'samfer';
    $user->save();
});