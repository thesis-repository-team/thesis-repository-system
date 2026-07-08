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
        Schema::create('saved_theses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students', 'id')->cascadeOnDelete();
            $table->foreignId('thesis_id')->constrained('theses', 'id')->cascadeOnDelete();
            $table->dateTime('saved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saved_theses');
    }
};
