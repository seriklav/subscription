<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Dtos\SubscriptionDTO;
use App\Enums\PlanType;
use App\Enums\BillingFrequency;
use BenSampo\Enum\Rules\EnumValue;

class SubscriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'plan' => ['required', new EnumValue(PlanType::class, false)],
            'user_count' => 'required|integer|min:1',
            'billing_frequency' => ['required', new EnumValue(BillingFrequency::class, false)],
        ];
    }

    public function toDTO(): SubscriptionDTO
    {
        return SubscriptionDTO::from([
            'plan' => PlanType::fromValue($this->input('plan')),
            'userCount' => $this->input('user_count'),
            'billingFrequency' => BillingFrequency::fromValue($this->input('billing_frequency'))
        ]);
    }
}
