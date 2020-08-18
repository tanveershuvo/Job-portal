<?php

namespace App;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Post
 *
 * @mixin Eloquent
 * @property int $id
 * @property int|null $user_id
 * @property string|null $title
 * @property string|null $slug
 * @property string|null $post_content
 * @property string|null $feature_image
 * @property string|null $type
 * @property string|null $status
 * @property int|null $show_in_header_menu
 * @property int|null $show_in_footer_menu
 * @property int|null $views
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $author
 * @property-read string $feature_image_thumb_uri
 * @property-read string $feature_image_uri
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereFeatureImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereShowInFooterMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereShowInHeaderMenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereViews($value)
 */
class Post extends Model
{
    protected $guarded = [];
    /**
     * @var mixed
     */
    private $feature_image;

    /**
     * @return string
     */
    public function getFeatureImageUriAttribute()
    {
        if ($this->feature_image) {
            return asset('storage/uploads/images/blog/full/' . $this->feature_image);
        }
        return asset('assets/images/placeholder.png');
    }

    /**
     * @return string
     */
    public function getFeatureImageThumbUriAttribute()
    {
        if ($this->feature_image) {
            return asset('storage/uploads/images/blog/thumb/' . $this->feature_image);
        }
        return asset('assets/images/placeholder.png');
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @var string[]
     */
    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'deleted' => PostDeleted::class,
        'updated' => PostUpdated::class,
    ];

}
