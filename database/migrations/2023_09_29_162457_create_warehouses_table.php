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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->increments('id_warehouse');
            $table->string('name', 80);
            $table->string('address');
            $table->string('notes')->nullable();
            $table->enum('is_active', ["Y", "N"]);
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
        Schema::dropIfExists('warehouses');
    }
};
