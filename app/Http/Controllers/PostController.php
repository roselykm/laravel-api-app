<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\DB;


//Eloquent ORM: CRUD operations
class PostController extends Controller implements HasMiddleware
{
    //all route must have bearer token
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum') 
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // => select all from posts where posts.user_id = user.id
        // GET /api/posts

        //return only posts for the current user
        return Post::where('user_id', $request->user()->id)->get();
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

        //The post owner is the current user
        $post  = $request->user()->posts()->create($fields);

        return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {
        // => select all from posts where id = post->id AND user_id = $request->user()->id
        // GET /api/posts/id        

        //Show only post own by the current user
        $post = DB::table('posts')
                ->where('id', '=', $post->id)
                ->where('user_id', '=', $request->user()->id)
                ->get();
        
        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // => update into posts where id = post_id AND user_id = $request->user()->id
        // PUT /api/posts/id

        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        //First check if the current user own the $post
        $post1 = DB::table('posts')
                ->where('id', '=', $post->id)
                ->where('user_id', '=', $request->user()->id)
                ->get();

        //if not, return false
        if (!$post1->isNotEmpty()) {
            return [
                "status" => false,
            ];
        }
        
        //else execute update
        $post->update($fields);

        return [
            "status" => true,
            "post" => $post
        ];
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Request $request)
    {
        // => delete posts where id = post_id AND user_id = $request->user()->id
        // DELETE /api/posts/id

        $postId = $post->getKey();

        ////First check if the current user own the $post
        $post1 = DB::table('posts')
                ->where('id', '=', $post->id)
                ->where('user_id', '=', $request->user()->id)
                ->get();
        
        //if not, return false
        if (!$post1->isNotEmpty()) {
            return [
                "status" => false,
                "message" => "Deletion failed. You are not the owner of the post with ID: $postId"
            ];
        }
        
        //else execute delete and return true
        $post->delete();

        return [
            "status" => true,
            'message' => "Post with ID: $postId, is deleted successfully!"
        ];
    }
}
