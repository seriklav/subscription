<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class BillingFrequency extends Enum implements LocalizedEnum
{
    const Monthly = 'monthly';
    const Yearly = 'yearly';
}
