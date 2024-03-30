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
            $table->foreignId('user_data_id');
            $table->foreign('user_data_id')->references('id')->on('user_datas')->onDelete('cascade');
            $table->string('grade');
            $table->string('field_of_study');
            $table->string('university_name');
            $table->timestamp('entering_year')->nullable();
            $table->timestamp('graduation_year')->nullable();
            $table->enum('currently_studying',['yes' , null])->nullable()->default(null);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
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
