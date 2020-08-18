<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Pricing
 *
 * @property int $id
 * @property string|null $package_name
 * @property int|null $price
 * @property int|null $premium_job
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing wherePackageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing wherePremiumJob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pricing wherePrice($value)
 * @mixin \Eloquent
 */
class Pricing extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
