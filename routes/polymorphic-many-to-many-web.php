<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Video;
use App\Models\Tag;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $post = Post::create(['name' => 'first post']);

    $tag1 = Tag::find(1);

    $post->tags()->save($tag1);

    $video = Video::create(['name' => 'video.mov']);

    $tag2 = Tag::find(2);

    $video->tags()->save($tag2);
});

Route::get('/read', function () {
    $post = Post::findOrFail(1);

    foreach ($post->tags as $tag) {
        echo $tag . "<br/>";
    }
    
});

Route::get('/update', function () {
    // $post = Post::findOrFail(1);
    // 
    // foreach ($post->tags as $tag) {
    //     return $tag->whereName('Tag 1')->update(['name' => 'Updated Tag']);
    // }

    $post = Post::findOrFail(2);
    $tag = Tag::find(3);

    // $post->tags()->save($tag);

    // $post->tags()->attach($tag);
    // $post->tags()->sync([1]);


});

Route::get('/delete', function () {
    $post = Post::find(1);

    foreach ($post->tags as $tag) {
        $tag->whereId(2)->delete();
    }
});