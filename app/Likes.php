<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    protected $table = 'likes';

	protected $fillable = [
        'user_id', 'media_id', 'likes', 'dislikes'
    ];

    public function media()
    {
        return $this->belongsTo('App\Media');
    }
}