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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->cascadeOnDelete();
            $table->foreignId('driver_id')->nullable()->constrained('drivers')->nullOnDelete()->default(0);
            $table->float('delivary_value')->default(0);
            $table->float('discount_value')->default(0);
            $table->float('tax_value')->default(0);  // الضريبه
            $table->float('sub_total')->default(0);  // السعر في العدد
            $table->float('summation')->default(0);  // الاجمالي
            $table->string('status')->default(0);
            $table->integer('receipt_type')->default(0);  // 0 = delivary , 1 = customer
            $table->date('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
