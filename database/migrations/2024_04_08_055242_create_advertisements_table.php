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
            $table->foreignId('organization_id');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreignId('job_category_id');
            $table->foreign('job_category_id')->references('id')->on('job_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('title');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->enum('type_of_cooperation', ['full_time', 'part_time', 'telecommuting', 'internship', 'project']);
            $table->enum('military_exemption', ['Exempt', 'Not Exempt']);
            $table->decimal('salary', 10, 2)->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('degree_of_education');
            $table->text('address');
            $table->text('about');
            $table->text('Advantages');
            $table->enum('status', ['active', 'closed', 'awaiting_review'])->default('active');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
