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
        Schema::create('thesis_requests', function (Blueprint $table) {
            $table->id();
            $table->string('author_name');
            $table->foreignId('submitted_by')->constrained('users'); // student and student can not be deleted
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->foreignId('thesis_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->text('abstract');
            $table->text('description');
            $table->string('pdf_file')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamp('submitted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_requests');
    }
};