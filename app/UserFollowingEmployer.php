<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserFollowingEmployer
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $employer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer whereEmployerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserFollowingEmployer whereUserId($value)
 * @mixin \Eloquent
 */
class UserFollowingEmployer extends Model
{
    protected $guarded = [];
}
