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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->char('number')->primary();
            $table->unsignedInteger('period_id');
            $table->unsignedInteger('vendor_id');
            $table->date('date');
            $table->double('total_qty_request')->default(0);
            $table->double('total_qty_received')->default(0);
            $table->double('total_price')->default(0);
            $table->double('discount_percent')->default(0);
            $table->double('discount_value')->default(0);
            $table->double('tax_percent')->default(0);
            $table->double('tax_value')->default(0);
            $table->double('charge')->default(0);
            $table->double('nett')->default(0);
            $table->string('notes')->nullable();
            $table->enum('status', ['open', 'close'])->nullable();
            $table->unsignedInteger('branch_id');
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
        Schema::dropIfExists('purchase_orders');
    }
};
