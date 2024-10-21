<?php

use App\Enums\BillingFrequency;
use App\Enums\PlanType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('plan', PlanType::asArray());
            $table->integer('user_count');
            $table->enum('billing_frequency', BillingFrequency::asArray());
            $table->decimal('total_price');
            $table->date('next_billing_date');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
