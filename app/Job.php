<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
 * @property \Illuminate\Support\Carbon|null $deadline
 * @property int|null $status
 * @property string|null $job_id
 * @property int|null $is_premium
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\JobApplication[] $application
 * @property-read int|null $application_count
 * @property-read \App\User|null $employer
 * @method static \Illuminate\Database\Eloquent\Builder|Job active()
 * @method static \Illuminate\Database\Eloquent\Builder|Job approved()
 * @method static \Illuminate\Database\Eloquent\Builder|Job blocked()
 * @method static \Illuminate\Database\Eloquent\Builder|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job pending()
 * @method static \Illuminate\Database\Eloquent\Builder|Job premium()
 * @method static \Illuminate\Database\Eloquent\Builder|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereAdditionalRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereApplyInstruction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereBenefits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereEducationalRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereExpLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereExperiencePlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereExperienceRequiredYears($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereExperienceRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereIsAnyWhere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereIsNegotiable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereIsPremium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereResponsibilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereSalaryCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereSalaryCycle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereSalaryUpto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereSkills($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereVacancy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereViews($value)
 * @mixin \Eloquent
 */
class Job extends Model
{
    protected $guarded = [];


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'deadline',
    ];

    public function employer(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function application(){
        return $this->hasMany(JobApplication::class);
    }

    public function scopePending($query){
        return $query->where('status', '=', 0);
    }
    public function scopeApproved($query){
        return $query->where('status', '=', 1);
    }
    public function scopeActive($query){
        return $query->where('status', '=', 1)->where('deadline', '>=', date('Y-m-d').' 00:00:00');
    }
    public function scopeBlocked($query){
        return $query->where('status', '=', 2);
    }
    public function scopePremium($query){
        return $query->whereIsPremium(1);
    }

    public function nl2ulformat($string = null){
        if ( ! $string){
            return '';
        }
        $array = explode("\n", $string);
        $output = '';
        if(is_array($array) && count($array)) {
            $output .= '<ul>';
            foreach ($array as $item){
                $output .= '<li class="mb-2">'.$item.'</li>';
            }
            $output .= '</ul>';
        }
        return $output;
    }

    public function is_active(){
        return $this->status == 1;
    }

    public function is_pending(){
        return $this->status == 0;
    }

    public function can_edit(){
        $viewable = false;

        if (Auth::check()){
            $user = Auth::user();
            if ( $user->is_admin() || $user->id == $this->user_id){
                $viewable = true;
            }
        }

        return $viewable;
    }

    public function status_context(){
        $status = $this->status;
        $html = '';
        switch ($status){
            case 0:
                $html = '<span class="text-muted">'.trans('app.pending').'</span>';
                break;
            case 1:
                $html = '<span class="text-success">'.trans('app.published').'</span>';
                break;
            case 2:
                $html = '<span class="text-warning">'.trans('app.blocked').'</span>';
                break;
        }
        return $html;
    }

}
