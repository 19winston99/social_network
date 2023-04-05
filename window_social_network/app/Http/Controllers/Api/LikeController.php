<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'post_id' => 'required'
        ]);
        
        $same_likes = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id)->get();
        if (count($same_likes) > 0) {
            return ['failed' => 'Like già presente'];
        }
        Like::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id
        ]);

        return ['success' => 'Like creato con successo'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }

    public function dislike(Request $request) {
        $request->validate([
            'user_id' => 'required',
            'post_id' => 'required'
        ]);

        $results = Like::where('user_id', $request->user_id)->where('post_id', $request->post_id)->get();
        $like = $results[0];
        if (!$like) return ["error" => 'Like non esiste'];
        $like->delete();
        return ['success' => 'Like cancellato con successo'];
    }
}
