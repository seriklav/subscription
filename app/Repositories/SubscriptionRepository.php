<?php

namespace App\Repositories;

use App\Models\Subscription;

class SubscriptionRepository
{
    public function findById(int $id): ?Subscription
    {
        return Subscription::find($id);
    }

    public function update(Subscription $subscription, array $data): bool
    {
        return $subscription->update($data);
    }
}
