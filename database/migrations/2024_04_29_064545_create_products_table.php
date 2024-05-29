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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->string('image');
            $table->integer('quantity');
            $table->string('description');
            $table->string('recommendation');
            $table->string('composition');
            $table->string('methodApplication');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->timestamps();

            $table->index('subcategory_id', 'product_subcategory_idx');
            $table->index('manufacturer_id', 'product_manufacturer_idx');

            $table->foreign('subcategory_id', 'subcategory_id')->on('subcategories')->references('id');
            $table->foreign('manufacturer_id', 'manufacturer_id')->on('manufacturers')->references('id');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
