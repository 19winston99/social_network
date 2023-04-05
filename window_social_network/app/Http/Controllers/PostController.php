<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
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
        $request->validate(['title' => 'required', 'description' => 'required', 'image' => 'image|mimes:jpeg,png,jpg|max:2048']);

        if ($request->image) {
            $name = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images/posts'), $name);
        } else {
            $name = $post->image;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $name
        ]);
        $user = User::find(Auth::user()->id);
        $posts = $user->posts()->with('comments.user')->get();
        return redirect()->route('users.show', ['success' => 'Post modificato con successo', 'user' => $user, 'posts' => $posts]);
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
        File::delete(public_path('images/posts/' . $post->image));
        $user = User::find(Auth::user()->id);
        $posts = $user->posts()->with('comments.user')->get();
        return redirect()->route('users.show', ['success' => 'Post eliminato con successo', 'user' => $user, 'posts' => $posts]);
    }
}
