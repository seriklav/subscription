<?php

namespace App\Services;

use App\Jobs\ScheduleSubscriptionUpdateJob;
use App\Repositories\SubscriptionRepository;
use App\Models\Subscription;
use App\Enums\PlanType;
use App\Enums\BillingFrequency;
use Carbon\Carbon;

class SubscriptionService
{
    public function __construct(protected SubscriptionRepository $subscriptionRepository)
    {
    }

    public function calculateTotal(PlanType $plan, int $userCount, BillingFrequency $billingFrequency): float
    {
        $rate = $plan->getPrice();
        $total = $rate * $userCount;

        if ($billingFrequency === BillingFrequency::Yearly) {
            $discount = config('subscription.discount.yearly');
            $total *= 12;
            $total *= (1 - $discount);
        }

        return $total;
    }

    public function upgradeOrDowngrade(
        Subscription $subscription,
        PlanType $newPlan,
        int $userCount,
        BillingFrequency $billingFrequency
    ): Subscription
    {
        $totalPrice = $this->calculateTotal($newPlan, $userCount, $billingFrequency);

        $this->subscriptionRepository->update($subscription, [
            'new_plan' => $newPlan->value,
            'new_user_count' => $userCount,
            'new_billing_frequency' => $billingFrequency->value,
            'new_total_price' => $totalPrice,
        ]);

        $nextBillingDate = Carbon::parse($subscription->next_billing_date);

        ScheduleSubscriptionUpdateJob::dispatch($subscription)->delay(now()->addMinute());

        return $subscription;
    }
}
