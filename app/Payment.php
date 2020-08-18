<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Payment
 *
 * @property int $id
 * @property int $user_id
 * @property int $package_id
 * @property string $package_name
 * @property int $premium_jobs
 * @property string $email
 * @property float $amount
 * @property string|null $status
 * @property string|null $session_id
 * @property string|null $transaction_id
 * @property string $payment_option
 * @property string|null $payment_method
 * @property string $currency
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @property mixed premium_job
 * @method static Builder|Payment newModelQuery()
 * @method static Builder|Payment newQuery()
 * @method static Builder|Payment query()
 * @method static Builder|Payment success()
 * @method static Builder|Payment whereAmount($value)
 * @method static Builder|Payment whereCreatedAt($value)
 * @method static Builder|Payment whereCurrency($value)
 * @method static Builder|Payment whereEmail($value)
 * @method static Builder|Payment whereId($value)
 * @method static Builder|Payment wherePackageId($value)
 * @method static Builder|Payment wherePackageName($value)
 * @method static Builder|Payment wherePaymentMethod($value)
 * @method static Builder|Payment wherePaymentOption($value)
 * @method static Builder|Payment wherePremiumJobs($value)
 * @method static Builder|Payment whereSessionId($value)
 * @method static Builder|Payment whereStatus($value)
 * @method static Builder|Payment whereTransactionId($value)
 * @method static Builder|Payment whereUpdatedAt($value)
 * @method static Builder|Payment whereUserId($value)
 * @mixin Eloquent
 */
class Payment extends Model
{
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @param $query
     * @return mixed
     */
    public function scopeSuccess($query)
    {
        return $query->where('status', '=', 'success');
    }
}
