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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');

            $table->index('order_id', 'order_product_order_idx');
            $table->index('product_id', 'order_product_product_idx');

            $table->foreign('order_id', 'order_id')->on('orders')->references('id');
            $table->foreign('product_id', 'product_id')->on('products')->references('id');

            $table->integer('quantity')->default(1);
            $table->double('price')->default(0);

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
