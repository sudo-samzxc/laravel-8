<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('images', $name);

            $input['path'] = $name;
        }

        Post::create($input);

        /**
         * $file = $request->file('file');
         * echo "<br/>";
         * echo $file->getClientOriginalName();
         * echo "<br/>";
         * echo $file->getSize();
         */


        /**
         * $request->validate([
         *   'title' => 'required|max:50'
         * ]);
         */

        /**
         * Post::create($request->except(['_token']));
         *
         *
         * return redirect('posts', 201);
         */

        // return redirect()->route('posts.index', [], 201);

        /**  
         * Another way of saving data
         * $post = new Post;
         * $post->title = $request->title;
         * $post->save;
         */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        Post::whereId($id)->delete();
        return redirect('posts');
    }
}