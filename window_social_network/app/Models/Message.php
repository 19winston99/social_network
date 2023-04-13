<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['sender_user_id', 'recipient_user_id', 'body', 'image'];

    public function sender_user()
    {
        return $this->belongsTo('App\Models\User', 'sender_user_id');
    }

    public function recipient_user()
    {
        return $this->belongsTo('App\Models\User', 'recipient_user_id');
    }
}
