<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Orders
 *
 * @mixin Eloquent
 * @method static Builder|Orders newModelQuery()
 * @method static Builder|Orders newQuery()
 * @method static Builder|Orders query()
 */
class Orders extends Model
{
    protected $guarded = [];
}
