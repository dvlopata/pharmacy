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
        Schema::dropIfExists('products');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->integer('quantity');
            $table->integer('amount');
            $table->string('description');
            $table->string('recommendation');
            $table->string('composition');
            $table->string('methodApplication');
            $table->unsignedBigInteger('category_subcategory_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->timestamps();

            $table->index('category_subcategory_id', 'product_category_subcategory_idx');
            $table->index('manufacturer_id', 'product_manufacturer_idx');

            $table->foreign('category_subcategory_id', 'category_subcategory_id')->on('category_subcategories')->references('id');
            $table->foreign('manufacturer_id', 'manufacturer_id')->on('manufacturers')->references('id');
        });
    }
};
