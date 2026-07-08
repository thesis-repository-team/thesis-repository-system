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
        Schema::create('theses', function (Blueprint $table) {
            // original, but i want to ask u about this table.
            $table->id();
            $table->string('title');
            $table->longText('abstract')->nullable();
            $table->longText('description')->nullable();
            $table->foreignId('department_id')->constrained('departments', 'id')->cascadeOnDelete();
            $table->string('author_name');

            // theses will be posted by "hods" or "student"
            // so using "User" table instead of "hods" table or "student" table 
            // note: "User" table contain all user roles (admin, hod, student) 
            // student name will be here if they their request to upload is approved by admin or hod.
            // cannot be null. admin & hod can upload.
            $table->foreignId('submitted_by')->constrained('users')->cascadeOnDelete();

            // if thesis is posted by "hod" -> verify_by = null
            // if thesis is posted by "student" -> verify_by = hod_id (who verify the thesis)
            // can be null. null if admin or hod approved
            $table->foreignId('published_by')->constrained('users')->cascadeOnDelete();
            $table->timestamp('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses');
    }
};
