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
        Schema::create('stock_adjustment_details', function (Blueprint $table) {
            $table->char('number');
            $table->foreign('number')->on('stock_adjustments')->references('number');
            $table->unsignedInteger('period_id');
            $table->date('date');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id_product');
            $table->double('qty')->default(0);
            $table->double('price')->default(0);
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('warehouse_id');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustment_details');
    }
};
