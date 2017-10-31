<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompetitionData extends Model
{
    protected $table = 'competition_data';

	protected $fillable = [
        'user_id', 'level_id', 'likes', 'dislikes', 'competition_unit_id', 'competition_id'
    ];
}
