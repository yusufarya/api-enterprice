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
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->char('number')->primary();
            $table->unsignedInteger('period_id');
            $table->date('date');
            $table->enum('type', ['plus', 'minus']);
            $table->double('total_qty')->default(0);
            $table->double('total_price')->default(0);
            $table->string('notes', 200)->nullable();
            $table->unsignedInteger('branch_id');
            $table->string('created_by', 50);
            $table->dateTime('created_at');
            $table->string('updated_by', 50);
            $table->dateTime('updated_at');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_adjustments');
    }
};
