<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UpdateSubscriptionController extends Controller
{
    public function __construct(protected SubscriptionService $subscriptionService)
    {
    }

    public function __invoke(SubscriptionRequest $request): RedirectResponse
    {
        $dto = $request->toDTO();

        $subscription = Auth::user()->subscription;

        $this->subscriptionService->upgradeOrDowngrade(
            $subscription,
            $dto->plan,
            $dto->userCount,
            $dto->billingFrequency
        );

        return redirect()->route('subscription.show', $subscription)
            ->with('success', __('Subscription updated successfully'));
    }
}
