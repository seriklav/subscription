<?php

namespace App\Dtos;

use Spatie\LaravelData\Data;
use App\Enums\PlanType;
use App\Enums\BillingFrequency;

class SubscriptionDTO extends Data
{
    public function __construct(
        public PlanType $plan,
        public int $userCount,
        public BillingFrequency $billingFrequency
    ) {}
}
