<?php
    return [
        \App\Enums\PlanType::class => [
            \App\Enums\PlanType::Lite => "Lite",
            \App\Enums\PlanType::Starter => "Starter",
            \App\Enums\PlanType::Premium => "Premium",
        ],

        \App\Enums\BillingFrequency::class => [
            \App\Enums\BillingFrequency::Monthly => "Monthly",
            \App\Enums\BillingFrequency::Yearly => "Yearly",
        ],
    ];
