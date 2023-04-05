<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user_liked_posts = $user->likedPosts;
        $user_liked_posts_id = [];
        foreach ($user_liked_posts as $user_liked_post) {
            $user_liked_posts_id[] = $user_liked_post->id;
        }

        $posts = Post::all();

        foreach ($posts as $post) {
            $post->user;
            $post->comments;

            if(in_array($post->id, $user_liked_posts_id)) {

                $post->liked = true;
            } else {
                $post->liked = false;
            }

             foreach($post->comments as $comment) {
                $comment->user;
        }
        }

        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'image|mimes:jpeg,png,jpg|max:2048']);
        
        $name = uniqid() . '.' . $request->image->extension();
        $request->image->move(public_path('images/posts'), $name);

        $post = Post::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $name
        ]);

        return ['success' => 'Post creato con successo', 'id' => $post->id, 'image' => $name];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(['title' => 'required', 'description' => 'required']);
        $post->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image
        ]);
        return ['success' => 'Post modificato con successo'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return ['success' => 'Post eliminato con successo'];
    }
}
