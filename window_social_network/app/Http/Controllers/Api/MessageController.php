<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $current_user_id = $request->personalId;
        $current_conversation_user_id = $request->id;
        $messages = Message::where(function ($query) use ($current_user_id, $current_conversation_user_id) {
            $query->where('sender_user_id', $current_user_id)
                ->where('recipient_user_id', $current_conversation_user_id);
        })->orWhere(function ($query) use ($current_user_id, $current_conversation_user_id) {
            $query->where('sender_user_id', $current_conversation_user_id)
                ->where('recipient_user_id', $current_user_id);
        })->get();
        return $messages;
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
        $request->validate(['sender_user_id' => 'required', 'recipient_user_id' => 'required']);
        if ($request->image) {
            $name = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('images/messages'), $name);
        } else {
            $name = null;
        }
        $message = Message::create([
            'sender_user_id' => $request->sender_user_id,
            'recipient_user_id' => $request->recipient_user_id,
            'body' => $request->body ? $request->body : null,
            'image' => $name
        ]);
        return ['success' => 'Messaggio inviato con successo', 'image' => $name, 'id' => $message->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message = Message::find($message->id);
        $message->delete();
        return ['success' => 'Messaggio eliminato con successo'];
    }
}
