<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('subscription.Subscription Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <p>{{ __('subscription.Current Plan') }}: {{ $subscription->plan->description }}</p>
                    <p>{{ __('subscription.User Count') }}: {{ $subscription->user_count }}</p>
                    <p>{{ __('subscription.Billing Frequency') }}
                        : {{ $subscription->billing_frequency->description }}</p>
                    <p>{{ __('subscription.Total Price') }}: €{{ $subscription->total_price }}</p>
                    <p>{{ __('subscription.Next Billing Date') }}: {{ $subscription->next_billing_date }}</p>
                </div>
            </div>

            @if($subscription->new_plan)
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <h2>{{ __('subscription.Upcoming Changes') }}</h2>
                </h2>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <p>{{ __('subscription.Next Plan') }}: {{ $subscription->new_plan->description }}</p>
                        <p>{{ __('subscription.Next User Count') }}: {{ $subscription->new_user_count }}</p>
                        <p>{{ __('subscription.Next Billing Frequency') }}
                            : {{ $subscription->new_billing_frequency->description }}</p>
                        <p>{{ __('subscription.Next Total Price') }}: €{{ $subscription->new_total_price }}</p>
                    </div>
                </div>
            @endif

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <h2>{{ __('subscription.Update Subscription') }}</h2>
            </h2>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('subscription.update', $subscription->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="plan">{{ __('subscription.Plan') }}:</label>
                            <select name="plan" id="plan" class="form-control">
                                @foreach (App\Enums\PlanType::asSelectArray() as $value => $label)
                                    <option
                                        value="{{ $value }}" {{ $subscription->plan->value == $value ? 'selected' : '' }}>
                                        {{ __($label) }} -
                                        €{{ config('subscription.plans.' . $value . '.price_per_user') }} {{ __('per user') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="user_count">{{ __('subscription.User Count') }}:</label>
                            <input type="number" name="user_count" id="user_count"
                                   value="{{ $subscription->user_count }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="billing_frequency">{{ __('subscription.Billing Frequency') }}:</label>
                            <select name="billing_frequency" id="billing_frequency" class="form-control">
                                @foreach (App\Enums\BillingFrequency::asSelectArray() as $value => $label)
                                    <option
                                        value="{{ $value }}" {{ $subscription->billing_frequency->value == $value ? 'selected' : '' }}>
                                        {{ __($label) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <x-primary-button>{{ __('subscription.Update') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
