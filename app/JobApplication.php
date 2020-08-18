<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\JobApplication
 *
 * @property int $id
 * @property int|null $job_id
 * @property int|null $employer_id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $message
 * @property string|null $resume
 * @property int|null $is_shortlisted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $resume_url
 * @property-read \App\Job|null $job
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereEmployerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereIsShortlisted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobApplication whereUserId($value)
 * @mixin \Eloquent
 */
class JobApplication extends Model
{
    protected $guarded = [];

    public function getResumeUrlAttribute(){
        return asset('storage/uploads/resume/'.$this->resume);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }
}
