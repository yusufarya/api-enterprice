<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->char('id_user', 10)->primary();
        //     $table->string('name', 50);
        //     $table->char('username', 30)->unique('users_username_unique');
        //     $table->enum('gender', ["M", "F"]);
        //     $table->string('place_of_birth', 50)->nullable();
        //     $table->date('date_of_birth')->nullable();
        //     $table->string('no_telp', 20)->nullable();
        //     $table->string('address')->nullable();
        //     $table->string('email', 100)->unique('users_email_unique');
        //     // $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->unsignedBigInteger('role_id')->nullable('false');
        //     $table->enum('is_active', ["Y", "N"])->default('Y');
        //     $table->dateTime('last_login')->nullable();
        //     $table->string('token')->nullable()->unique('users_token_unique');
        //     $table->string('created_by', 50)->nullable();
        //     $table->dateTime('created_at')->nullable();
        //     $table->string('updated_by', 50)->nullable();
        //     $table->dateTime('updated_at')->nullable();
            
        // });
        
        // Schema::table('users', function(Blueprint $table) {
            // $table->foreign('role_id')->on('user_roles')->references('id');
            // alter table `users` add constraint `users_role_id_foreign` foreign key (`role_id`) references `user_roles` (`id`)
        // });
    // }

    /**
     * Reverse the migrations.
     */
    // public function down(): void
    // {
    //     Schema::dropIfExists('users');
    // }
};
