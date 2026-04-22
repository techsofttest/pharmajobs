<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Link subscription to order instead of storing duplicate razorpay IDs
            $table->foreignId('order_id')
                  ->nullable()
                  ->after('package_id')
                  ->constrained('orders')
                  ->nullOnDelete();

            // Add cancellation tracking
            $table->timestamp('cancelled_at')->nullable()->after('status');

            // Remove duplicate razorpay columns (already on orders table)
            $table->dropColumn(['razorpay_order_id', 'razorpay_payment_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropColumn(['order_id', 'cancelled_at']);
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
        });
    }
};
