<?php

namespace App\Listeners;

use App\Models\Subscription;
use App\Enums\PlanType;
use App\Enums\BillingFrequency;
use Illuminate\Auth\Events\Registered;

class CreateDefaultSubscription
{
    public function handle(Registered $event): void
    {
        $user = $event->user;

        $pricePerUser = config('subscription.plans.lite.price_per_user');

        Subscription::create([
            'user_id' => $user->id,
            'plan' => PlanType::Lite,
            'user_count' => 1,
            'billing_frequency' => BillingFrequency::Monthly,
            'total_price' => $pricePerUser,
            'next_billing_date' => now()->addMonth(),
        ]);
    }
}
