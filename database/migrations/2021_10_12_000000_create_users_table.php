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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('job_category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('family')->nullable();
            $table->string('phone_number')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->timestamp('reset_pass_verified_at')->nullable();
            $table->string('national_id')->nullable();
            $table->string('password')->nullable();
            $table->string('password_confirmation')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
