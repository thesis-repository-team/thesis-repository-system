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
        Schema::create('thesis_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id')->constrained('theses', 'id')->cascadeOnDelete();
            $table->string('file_name')->nullable();
            $table->string('file_type', 50)->nullable();
            $table->string('file_path', 500);
            // $table->foreignId('uploaded_by')->nullable()->constrained('users', 'id')->nullOnDelete();
            /// redundant
            $table->timestamp('uploaded_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thesis_files');
    }
};
