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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('gender',['male' , 'female']);
            $table->enum('military_exemption',['Exempt','Not Exempt']);
            $table->enum('type_of_cooperation',['full_time' , 'part_time' , 'telecommuting' , 'internship','project']);
            $table->decimal('salary', 10, 2)->nullable();
            $table->string('city/province');
            $table->string('degree_of_education');
            $table->text('address');
            $table->text('about');
            $table->foreignId('organization_id')->constrained('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('status',['open','closed','awaiting_review'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
