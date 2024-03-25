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
        Schema::create('educational_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id');
            $table->foreign('resume_id')->references('id')->on('resumes')->onDelete('cascade');
            $table->string('grade');
            $table->string('field_of_study');
            $table->string('university_name');
            $table->timestamp('entering_name');
            $table->timestamp('graduation_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_records');
    }
};
