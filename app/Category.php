<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
