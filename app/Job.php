<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * App\Job
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $company_name
 * @property string|null $job_title
 * @property string|null $job_slug
 * @property string|null $position
 * @property int|null $category_id
 * @property string|null $is_any_where
 * @property int|null $salary
 * @property int|null $salary_upto
 * @property int|null $is_negotiable
 * @property string|null $salary_cycle
 * @property string|null $salary_currency
 * @property int|null $vacancy
 * @property string $gender
 * @property string|null $job_type
 * @property string|null $exp_level
 * @property string|null $description
 * @property string|null $skills
 * @property string|null $responsibilities
 * @property string|null $educational_requirements
 * @property string|null $experience_requirements
 * @property string|null $additional_requirements
 * @property string|null $benefits
 * @property string|null $apply_instruction
 * @property string|null $district
 * @property int|null $experience_required_years
 * @property int|null $experience_plus
 * @property int|null $views
 * @property string|null $approved_at
 * @property Carbon|null $deadline
 * @property int|null $status
 * @property string|null $job_id
 * @property int|null $is_premium
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|JobApplication[] $application
 * @property-read int|null $application_count
 * @property-read User|null $employer
 * @method static Builder|Job active()
 * @method static Builder|Job approved()
 * @method static Builder|Job blocked()
 * @method static Builder|Job newModelQuery()
 * @method static Builder|Job newQuery()
 * @method static Builder|Job pending()
 * @method static Builder|Job premium()
 * @method static Builder|Job query()
 * @method static Builder|Job whereAdditionalRequirements($value)
 * @method static Builder|Job whereApplyInstruction($value)
 * @method static Builder|Job whereApprovedAt($value)
 * @method static Builder|Job whereBenefits($value)
 * @method static Builder|Job whereCategoryId($value)
 * @method static Builder|Job whereCompanyName($value)
 * @method static Builder|Job whereCreatedAt($value)
 * @method static Builder|Job whereDeadline($value)
 * @method static Builder|Job whereDescription($value)
 * @method static Builder|Job whereDistrict($value)
 * @method static Builder|Job whereEducationalRequirements($value)
 * @method static Builder|Job whereExpLevel($value)
 * @method static Builder|Job whereExperiencePlus($value)
 * @method static Builder|Job whereExperienceRequiredYears($value)
 * @method static Builder|Job whereExperienceRequirements($value)
 * @method static Builder|Job whereGender($value)
 * @method static Builder|Job whereId($value)
 * @method static Builder|Job whereIsAnyWhere($value)
 * @method static Builder|Job whereIsNegotiable($value)
 * @method static Builder|Job whereIsPremium($value)
 * @method static Builder|Job whereJobId($value)
 * @method static Builder|Job whereJobSlug($value)
 * @method static Builder|Job whereJobTitle($value)
 * @method static Builder|Job whereJobType($value)
 * @method static Builder|Job wherePosition($value)
 * @method static Builder|Job whereResponsibilities($value)
 * @method static Builder|Job whereSalary($value)
 * @method static Builder|Job whereSalaryCurrency($value)
 * @method static Builder|Job whereSalaryCycle($value)
 * @method static Builder|Job whereSalaryUpto($value)
 * @method static Builder|Job whereSkills($value)
 * @method static Builder|Job whereStatus($value)
 * @method static Builder|Job whereUpdatedAt($value)
 * @method static Builder|Job whereUserId($value)
 * @method static Builder|Job whereVacancy($value)
 * @method static Builder|Job whereViews($value)
 * @mixin Eloquent
 */
class Job extends Model
{
    protected $guarded = [];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'deadline',
    ];


    /**
     * @return BelongsTo
     */
    public
    function employer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public
    function application()
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * @param $query
     * @return mixed
     */
    public
    function scopePending($query)
    {
        return $query->where('status', '=', 0);
    }

    /**
     * @param $query
     * @return mixed
     */
    public
    function scopeApproved($query)
    {
        return $query->where('status', '=', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public
    function scopeActive($query)
    {
        return $query->where('status', '=', 1)->where('deadline', '>=', date('Y-m-d') . ' 00:00:00');
    }

    /**
     * @param $query
     * @return mixed
     */
    public
    function scopeBlocked($query)
    {
        return $query->where('status', '=', 2);
    }

    /**
     * @param $query
     * @return mixed
     */
    public
    function scopePremium($query)
    {
        return $query->whereIsPremium(1);
    }

    /**
     * @param null $string
     * @return string
     */
    public
    function nl2ulformat($string = null)
    {
        if (!$string) {
            return '';
        }
        $array = explode("\n", $string);
        $output = '';
        if (is_array($array) && count($array)) {
            $output .= '<ul>';
            foreach ($array as $item) {
                $output .= '<li class="mb-2">' . $item . '</li>';
            }
            $output .= '</ul>';
        }
        return $output;
    }

    /**
     * @return bool
     */
    public
    function is_active()
    {
        return $this->status == 1;
    }

    /**
     * @return bool
     */
    public
    function is_pending()
    {
        return $this->status == 0;
    }

    /**
     * @return bool
     */
    public
    function can_edit()
    {
        $viewable = false;

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_admin() || $user->id == $this->user_id) {
                $viewable = true;
            }
        }

        return $viewable;
    }

    /**
     * @return string
     */
    public
    function status_context()
    {
        $status = $this->status;
        $html = '';
        switch ($status) {
            case 0:
                $html = '<span class="text-muted">' . trans('app.pending') . '</span>';
                break;
            case 1:
                $html = '<span class="text-success">' . trans('app.published') . '</span>';
                break;
            case 2:
                $html = '<span class="text-warning">' . trans('app.blocked') . '</span>';
                break;
        }
        return $html;
    }

}
