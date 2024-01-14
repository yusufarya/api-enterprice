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
        Schema::create('cusromers', function (Blueprint $table) {
            $table->char('id_customer', 10)->primary();
            $table->string('name', 50);
            $table->char('username', 20);
            $table->enum('gender', ["M", "F"]);
            $table->string('place_of_birth', 50);
            $table->date('date_of_birth');
            $table->string('no_telp', 20)->nullable();
            $table->string('address');
            $table->string('email', 100)->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedInteger('grade_id')->default(0);
            $table->foreign('grade_id')->on('customer_grades')->references('id_grade');
            $table->enum('is_active', ["Y", "N"]);
            $table->dateTime('last_login')->nullable();
            $table->string('created_by', 50);
            $table->dateTime('created_at');
            $table->string('updated_by', 50)->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->string('token');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cusromers');
    }
};
