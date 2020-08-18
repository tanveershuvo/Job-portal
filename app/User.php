<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * App\User
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $district
 * @property string|null $city
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $address_2
 * @property string|null $website
 * @property string|null $phone
 * @property string|null $photo
 * @property string $user_type
 * @property string|null $company
 * @property string|null $company_slug
 * @property string|null $company_size
 * @property string|null $about_company
 * @property string|null $logo
 * @property int|null $premium_jobs_balance
 * @property int $active_status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $followable
 * @property-read mixed $followers
 * @property-read mixed $logo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Job[] $jobs
 * @property-read int|null $jobs_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Payment[] $payments
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|User agent()
 * @method static \Illuminate\Database\Eloquent\Builder|User employer()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAboutCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActiveStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanySize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCompanySlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePremiumJobsBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWebsite($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
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
