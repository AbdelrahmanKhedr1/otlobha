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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('price')->default(0);
            $table->string('description')->nullable();
            $table->date('pro_date')->nullable();
            $table->date('exp_date')->nullable();
            $table->string('stock_quantity')->default(0);
            $table->integer('from_time')->default(0); // الوقت المستغرق ل عمل المنتج
            $table->integer('to_time')->default(0); // الوقت المستغرق ل عمل المنتج
            $table->enum('is_percentage',[0,1,2])->default(0);
            $table->float('discount')->nullable();
            $table->float('taxValue')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('store_id')->nullable()->constrained('stores')->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained('products')->cascadeOnDelete();
            $table->foreignId('item_id')->nullable()->constrained('items')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
