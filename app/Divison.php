<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Divison
 * @package App
 */
class Divison extends Model
{
    protected $guarded = [];
    protected $table = 'divisions';

    /**
     * @return HasMany
     */
    function divison()
    {
        return $this->hasMany('App/District');
    }
}
