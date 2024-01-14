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
        Schema::create('purchase_invoice_details', function (Blueprint $table) {
            $table->char('number');
            $table->foreign('number')->on('purchase_invoices')->references('number');
            $table->unsignedInteger('period_id');
            $table->unsignedInteger('vendor_id');
            $table->date('date');
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id_product');
            $table->double('qty')->default(0);
            $table->double('price')->default(0);
            $table->double('discount_percent')->default(0);
            $table->double('discount_value')->default(0);
            $table->double('tax_value')->default(0);
            $table->double('shipping_charge')->default(0);
            $table->unsignedInteger('branch_id');
            $table->foreign('branch_id')->on('branches')->references('id_branch');
            $table->unsignedInteger('warehouse_id');
            $table->foreign('warehouse_id')->on('warehouses')->references('id_warehouse');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_invoice_details');
    }
};
