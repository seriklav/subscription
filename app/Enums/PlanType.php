<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class PlanType extends Enum implements LocalizedEnum
{
    const Lite = 'lite';
    const Starter = 'starter';
    const Premium = 'premium';

    public function getPrice(): float
    {
        return config('subscription.plans.' . $this->value . '.price_per_user');
    }
}
