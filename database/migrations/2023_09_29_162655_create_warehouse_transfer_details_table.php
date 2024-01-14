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
        Schema::create('warehouse_transfer_details', function (Blueprint $table) {
            $table->char('number');
            $table->foreign('number')->on('warehouse_transfers')->references('number');
            $table->unsignedInteger('period_id');
            $table->date('date');
            $table->unsignedInteger('product_id');
            $table->double('qty')->default(0);
            $table->double('price')->default(0);
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
        Schema::dropIfExists('warehouse_transfer_details');
    }
};
