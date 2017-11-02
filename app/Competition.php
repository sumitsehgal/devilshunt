<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use SoftDeletes;

    protected $table = 'competitions';

    protected $dates = ['deleted_at'];

	protected $fillable = [
        'title', 'description', 'category_id', 'filename', 'minimum_candidates', 'minimum_points', 'status', 'isstart', 'isend'
    ];

    public function levels()
    {
        return $this->hasMany('App\Level');
    }
}
