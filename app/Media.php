<?php

namespace App;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use SoftDeletes;

    protected $table = 'media';

    protected $dates = ['deleted_at'];

	protected $fillable = [
        'title', 'description', 'meta_keywords' , 'category_id', 'media', 'thumbnail', 'user_id', 'media_type', 'media_target', 'views_count'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
