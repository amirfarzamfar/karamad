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
        Schema::create('user_datas', function (Blueprint $table) {
            $table->id();
            $table->char('name');
            $table->char('family');
            $table->enum('gender', ['male', 'female']);
            $table->enum('marital_status', ['married ', 'single']);
            $table->date('year_of_birth')->nullable();
            $table->enum('military_exemption', ['Exempt', 'Not Exempt']);
            $table->string('email');
            $table->string('phone_number');
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->text('address');
            $table->text('about_me')->nullable();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
