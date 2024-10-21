<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\PlanType;
use App\Enums\BillingFrequency;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property PlanType $plan
 * @property int $user_count
 * @property BillingFrequency $billing_frequency
 * @property float $total_price
 * @property DateTime $next_billing_date
 * @property PlanType $new_plan
 * @property int $new_user_count
 * @property BillingFrequency $new_billing_frequency
 * @property float $new_total_price
 * @property DateTime $new_next_billing_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read string $plan_description
 * @property-read string $billing_frequency_description
 *
 * @mixin Builder
 */
class Subscription extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $casts = [
        'plan' => PlanType::class,
        'billing_frequency' => BillingFrequency::class,
        'next_billing_date' => 'date',
        'new_plan' => PlanType::class,
        'new_billing_frequency' => BillingFrequency::class,
        'new_next_billing_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
