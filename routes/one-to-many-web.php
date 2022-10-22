<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;

Route::get('', function () {
    return view('welcome');
});


Route::get('insert', function () {
    $user = User::findOrFail(1);

    $post = new Post(['title' => '4th title', 'body' => 'Sexy Body']);

    $user->posts()->save($post);

    return 'done';
});

Route::get('read', function () {
    $user = User::findOrFail(2);

    return $user->posts;
    
});

Route::get('update', function () {
    $user = User::findOrFail(1);

    $user->posts()->whereId(4)->update(['body' => 'Normalized body']);
});

Route::get('delete', function () {
    $user = User::findOrFail(1);

    $user->posts()->whereId(29)->delete();
});