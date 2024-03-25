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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->enum('gender', ['male','female']);
            $table->enum('marital_status',['married ','single']);
            $table->timestamp('year_of_birth');
            $table->enum('military_exemption',['Exempt','Not Exempt']);
            $table->string('email');
            $table->string('phone_number');
            $table->string('province');
            $table->string('city');
            $table->text('address');
            $table->text('about_me');
            $table->foreignId('jobCategory_id');
            $table->foreign('jobCategory_id')->references('id')->on('job_categories')->onDelete('cascade');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
