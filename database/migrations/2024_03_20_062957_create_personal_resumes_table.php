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
        Schema::create('personal_resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_data_id');
            $table->foreign('user_data_id')->references('id')->on('user_datas')->onDelete('cascade');
            $table->string('unique_name');
            $table->string('name');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_resumes');
    }
};
