<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;

class Post extends Model
{
    protected $guarded = [];

    public function getFeatureImageUriAttribute(){
        if ($this->feature_image){
            return asset('storage/uploads/images/blog/full/'.$this->feature_image);
        }
        return asset('assets/images/placeholder.png');
    }
    public function getFeatureImageThumbUriAttribute(){
        if ($this->feature_image){
            return asset('storage/uploads/images/blog/thumb/'.$this->feature_image);
        }
        return asset('assets/images/placeholder.png');
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'deleted' => PostDeleted::class,
        'updated' => PostUpdated::class,
    ];

}
