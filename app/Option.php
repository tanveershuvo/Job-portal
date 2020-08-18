<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Option
 *
 * @property int $id
 * @property string|null $option_key
 * @property string|null $option_value
 * @method static \Illuminate\Database\Eloquent\Builder|Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Option whereOptionValue($value)
 * @mixin \Eloquent
 */
class Option extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
