<?php

namespace App;

use App\Job;
use Illuminate\Database\Eloquent\Model;

/**
 * App\FlagJob
 *
 * @property int $id
 * @property int|null $job_id
 * @property string|null $reason
 * @property string|null $email
 * @property string|null $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Job|null $job
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlagJob whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FlagJob extends Model
{
    protected $guarded = [];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
