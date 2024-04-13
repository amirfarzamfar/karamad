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
            $table->enum('gender', ['male','female']);
            $table->enum('marital_status',['married ','single']);
            $table->date('year_of_birth')->nullable();
            $table->enum('military_exemption',['Exempt','Not Exempt']);
            $table->string('email');
            $table->string('phone_number');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('address');
            $table->text('about_me')->nullable();
            $table->enum('status',['accepted' , 'not_accepted'])->nullable();
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
