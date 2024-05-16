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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_data_id');
            $table->foreign('user_data_id')->references('id')->on('user_datas')->onDelete('cascade');
            $table->string('job_title');
            $table->string('organization_name');
            $table->date('start_of_work')->nullable();
            $table->date('end_of_work')->nullable();
            $table->enum('currently_employed',['true','false'])->default('false');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
