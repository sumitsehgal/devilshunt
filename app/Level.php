<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';


	protected $fillable = [
        'title', 'competition_id', 'end_date', 'end_time', 'minimum_candidate', 'minimum_points', 'sequence_order', 'underwork', 'no_of_days'
    ];


    
}
