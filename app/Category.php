<?php

namespace App;

use App\Job;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\Category
 *
 * @property int $id
 * @property string|null $category_name
 * @property string|null $category_slug
 * @property int|null $job_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Job[] $active_jobs
 * @property-read int|null $active_jobs_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Job[] $jobs
 * @property-read int|null $jobs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCategorySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereJobCount($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use Notifiable;
    protected $guarded = [];
    public $timestamps = false;

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function active_jobs()
    {
        return $this->hasMany(Job::class)->whereStatus(1)->where('deadline', '>=', date('Y-m-d') . ' 00:00:00');
    }

    public function job_count()
    {
        return $this->hasMany(Job::class)->whereStatus(1)->count();
    }
}
