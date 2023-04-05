<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function usersLiked() {
        return $this->belongsToMany('App\Models\User', 'likes');
    }

    public function comments() {
        return $this->hasMany('App\Models\Comment');
    }
}
