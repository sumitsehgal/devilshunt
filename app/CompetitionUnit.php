<?php

namespace App;

use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Database\Eloquent\Model;

class CompetitionUnit extends Model
{
    use SoftDeletes;

    protected $table = 'competition_units';

    protected $dates = ['deleted_at'];

	protected $fillable = [
        'media_id', 'user_id', 'competition_id', 'status'
    ];
    //status = 0 = media not moved to competition data means competition didn't start
    //user_id is owner of media
    //
}
