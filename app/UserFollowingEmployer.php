<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\UserFollowingEmployer
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $employer_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|UserFollowingEmployer newModelQuery()
 * @method static Builder|UserFollowingEmployer newQuery()
 * @method static Builder|UserFollowingEmployer query()
 * @method static Builder|UserFollowingEmployer whereCreatedAt($value)
 * @method static Builder|UserFollowingEmployer whereEmployerId($value)
 * @method static Builder|UserFollowingEmployer whereId($value)
 * @method static Builder|UserFollowingEmployer whereUpdatedAt($value)
 * @method static Builder|UserFollowingEmployer whereUserId($value)
 * @mixin Eloquent
 */
class UserFollowingEmployer extends Model
{
    protected $guarded = [];
}
