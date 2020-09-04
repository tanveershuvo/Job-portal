<?php

namespace App;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticated;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * App\User
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $gender
 * @property string|null $photo
 * @property string $user_type
 * @property int $active_status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $followable
 * @property-read mixed $followers
 * @property-read mixed $logo_url
 * @property-read mixed $premium_jobs_balance
 * @property-read Collection|Job[] $jobs
 * @property-read int|null $jobs_count
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @method static Builder|User agent()
 * @method static Builder|User employer()
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereActiveStatus($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereGender($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhoto($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereUserType($value)
 * @mixin Eloquent
 */
class User extends Authenticated
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jobs()
    {
        return $this->hasMany(Job::class)->orderBy('id', 'desc');
    }

    public function is_user()
    {
        return $this->user_type === 'user';
    }

    /**
     * @return bool
     */
    public function is_admin()
    {
        return $this->user_type === 'admin';
    }

    public function is_employer()
    {
        return $this->user_type === 'employer';
    }

    public function is_agent()
    {
        return $this->user_type === 'agent';
    }

    public function scopeEmployer($query)
    {
        return $query->whereUserType('employer');
    }

    public function scopeAgent($query)
    {
        return $query->whereUserType('agent');
    }

    public function isEmployerFollowed($employer_id = null)
    {
        if (!$employer_id || !Auth::check()) {
            return false;
        }

        $user = Auth::user();
        $isFollowed = UserFollowingEmployer::whereUserId($user->id)->whereEmployerId($employer_id)->first();

        if ($isFollowed) {
            return true;
        }
        return false;
    }

    public function getFollowersAttribute()
    {
        $followersCount = UserFollowingEmployer::whereEmployerId($this->id)->count();
        if ($followersCount) {
            return number_format($followersCount);
        }
        return 0;
    }

    public function getFollowableAttribute()
    {
        if (!Auth::check()) {
            return true;
        }

        $user = Auth::user();
        return $this->id !== $user->id;
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return asset('storage/uploads/images/logos/' . $this->logo);
        }
        return asset('assets/images/company.png');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getPremiumJobsBalanceAttribute($value)
    {
        return $value;
    }

    public function checkJobBalace()
    {
        $totalPremiumJobsPaid = $this->payments()->success()->sum('premium_job');
        $totalPosted = $this->jobs()->whereIsPremium(1)->count();
        $balance = $totalPremiumJobsPaid - $totalPosted;

        $this->premium_jobs_balance = $balance;
        $this->save();
    }

    public function signed_up_datetime()
    {
        $created_date_time = $this->created_at->timezone(get_option('default_timezone'))->format(get_option('date_format_custom') . ' ' . get_option('time_format_custom'));

        return $created_date_time;
    }

    public function status_context()
    {
        $status = $this->active_status;

        $context = '';
        switch ($status) {
            case '0':
                $context = 'Pending';
                break;
            case '1':
                $context = 'Active';
                break;
            case '2':
                $context = 'Block';
                break;
        }
        return $context;
    }

}
