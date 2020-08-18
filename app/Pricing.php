<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Pricing
 *
 * @mixin Eloquent
 * @property int $id
 * @property string|null $package_name
 * @property int|null $price
 * @property int|null $premium_job
 * @method static Builder|Pricing newModelQuery()
 * @method static Builder|Pricing newQuery()
 * @method static Builder|Pricing query()
 * @method static Builder|Pricing whereId($value)
 * @method static Builder|Pricing wherePackageName($value)
 * @method static Builder|Pricing wherePremiumJob($value)
 * @method static Builder|Pricing wherePrice($value)
 */
class Pricing extends Model
{
    protected $guarded = [];
    public $timestamps = false;
}
