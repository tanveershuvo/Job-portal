<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;

/**
 * App\Category
 *
 * @property int $id
 * @property string|null $category_name
 * @property string|null $category_slug
 * @property int|null $job_count
 * @property-read Collection|Job[] $active_jobs
 * @property-read int|null $active_jobs_count
 * @property-read Collection|Job[] $jobs
 * @property-read int|null $jobs_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereCategoryName($value)
 * @method static Builder|Category whereCategorySlug($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereJobCount($value)
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, string $slug)
 * @method static create(array $data)
 * @method static find($id)
 * @mixin Eloquent
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
