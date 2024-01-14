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
        Schema::create('vendors', function (Blueprint $table) {
            $table->char('id_vendor', 10)->primary();
            $table->string('name', 50);
            $table->string('phone', 20)->nullable();
            $table->string('types_product');
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->string('email', 100)->unique();
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
        Schema::dropIfExists('vendors');
    }
};
