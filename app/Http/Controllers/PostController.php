<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

//Eloquent ORM: CRUD operations
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // => select all from posts
        // GET /api/posts

        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // => insert into posts
        // POST /api/posts

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post  = Post::create($fields);

        return ['post' => $post];
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // => select all from posts where id = post_id
        // GET /api/posts/id

        return ['post' => $post];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // => update into posts where id = post_id
        // PUT /api/posts/id

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $post->update($fields);

        return ['post' => $post];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // => delete posts where id = post_id
        // DELETE /api/posts/id

        $postId = $post->getKey();
        $post->delete();
        $message = "Post with ID: $postId, is deleted!";

        return ['message' => $message];
    }
}
