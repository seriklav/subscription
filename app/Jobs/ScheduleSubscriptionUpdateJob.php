<?php

namespace App\Jobs;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ScheduleSubscriptionUpdateJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected Subscription $subscription;

    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function handle(): void
    {
        if (!$this->subscription->new_plan) {
            return;
        }

        $this->subscription->plan = $this->subscription->new_plan;
        $this->subscription->user_count = $this->subscription->new_user_count;
        $this->subscription->billing_frequency = $this->subscription->new_billing_frequency;
        $this->subscription->total_price = $this->subscription->new_total_price;

        $this->subscription->next_billing_date = $this->calculateNextBillingDate(
            $this->subscription->billing_frequency
        );

        $this->subscription->new_plan = null;
        $this->subscription->new_user_count = null;
        $this->subscription->new_billing_frequency = null;
        $this->subscription->new_total_price = null;

        $this->subscription->save();
    }

    private function calculateNextBillingDate(string $billingFrequency): Carbon
    {
        return $billingFrequency === 'yearly'
            ? Carbon::now()->addYear()
            : Carbon::now()->addMonth();
    }
}
