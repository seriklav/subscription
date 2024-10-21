<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->enum('new_plan', ['lite', 'starter', 'premium'])
                ->nullable()
                ->after('next_billing_date');
            $table->integer('new_user_count')
                ->nullable()
                ->after('new_plan');
            $table->enum('new_billing_frequency', ['monthly', 'yearly'])
                ->nullable()
                ->after('next_billing_date');
            $table->decimal('new_total_price', 8, 2)
                ->nullable()
                ->after('new_billing_frequency');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn([
                'new_plan',
                'new_user_count',
                'new_billing_frequency',
                'new_total_price',
            ]);
        });
    }
};
