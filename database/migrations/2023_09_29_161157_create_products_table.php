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
            $table->increments('id_product');
            $table->string('name', 100);
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->on('product_categories')->references('id_category');
            $table->unsignedInteger('brand_id');
            $table->foreign('brand_id')->on('brands')->references('id_brand');
            $table->unsignedInteger('unit_id');
            $table->foreign('unit_id')->on('units')->references('id_unit');
            $table->char('barcode', 15)->unique();
            $table->double('min_stock')->default(0);
            $table->double('max_stock')->default(0);
            $table->double('purchase_price')->default(0);
            $table->double('selling_price')->default(0);
            $table->enum('is_active', ["Y", "N"]);
            $table->string('created_by', 50);
            $table->dateTime('created_at');
            $table->string('updated_by', 50)->nullable();
            $table->dateTime('updated_at')->nullable();
            // $table->timestamps();
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
