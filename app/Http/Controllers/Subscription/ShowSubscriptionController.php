<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Repositories\SubscriptionRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ShowSubscriptionController extends Controller
{
    public function __construct(protected SubscriptionRepository $subscriptionRepository)
    {
    }

    public function __invoke(): Application|Factory|View|RedirectResponse
    {
        $subscription = Auth::user()->subscription;

        return view('subscriptions.index', compact('subscription'));
    }
}
