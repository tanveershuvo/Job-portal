<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class RecruiterDetails extends Model
{
    use Sluggable;

    protected $guarded = [];
    public $timestamps = false;

    /**
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'company_slug' => [
                'source' => 'company_name'
            ]
        ];
    }
}
