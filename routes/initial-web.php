<?php

use App\Models\Country;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* |----------------------------- | ELOQUENT Relationships |----------------------------- | */

// One-to-one relationship
Route::get('/user/{id}/post', function ($id) {
    return User::find($id)->post;
});

// Inverse relationship
Route::get('post/{id}/user', function ($id) {
    return Post::find($id)->user;
});

// One-to-many relationship
Route::get('/user/{id}/posts', function ($id) {
    foreach (User::find($id)->posts as $post) {
        echo $post . "<br>";
    }
});

// Many-to-many relationship
Route::get('user/{id}/roles', function ($id) {
    foreach (User::find($id)->roles as $role) {
        echo $role . "<br>";
    }

    return User::find($id)->roles()->orderBy('id', 'desc')->get();
});

Route::get('role/{id}/users', function ($id) {
    return Role::find($id)->users()->orderBy('id', 'desc')->get();
});

// Accessing the intermediate table / pivot
Route::get('/user/pivot/{id}', function ($id) {
    foreach (User::find($id)->roles as $role) {
        echo $role->pivot->created_at;
    }
});

// Has many through relationship
Route::get('/country/{id}/posts', function ($id) {
    $country = Country::find($id);

    foreach ($country->posts as $post) {
        echo $post;
    }
});

// Polymorphic relation
Route::get('/user/{id}/photo', function ($id) {
    $user = User::find($id);
    foreach ($user->photos as $photo) {
        return $photo;
    }
});

Route::get('/post/{id}/photo', function ($id) {
    $post = Post::find($id);
    foreach ($post->photos as $photo) {
        echo $photo->path . '<br>';
    }
});

// Inverse polymorphic relation
Route::get('/photo/{id}/user', function ($id) {
    $photo = Photo::findOrFail($id);

    return $photo->imageable;
});

// Polymorphic relation many-to-many
Route::get('post/tag/{id}', function ($id) {
    $post = Post::find($id);

    foreach ($post->tags as $tag) {
        echo $tag->name;
    }
});

// Polymorphic relation many-to-many retrieving owner
Route::get('/tag/post/{id}', function ($id) {
    $tag = Tag::find($id);

    foreach ($tag->posts as $post) {
        echo $post;
    }
});
