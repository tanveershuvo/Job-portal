<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded = [];
    protected $table = 'districts';

    function district()
    {
        return $this->belongsTo('App/Divison', 'division_id');
    }
}
