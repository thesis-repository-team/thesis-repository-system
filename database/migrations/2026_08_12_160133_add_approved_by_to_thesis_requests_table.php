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
        Schema::table('thesis_requests', function (Blueprint $table) {
            $table->foreignId('approved_by')
                ->nullable()
                ->after('submitted_by')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('thesis_requests', function (Blueprint $table) {
            $table->dropForeign('thesis_requests_approved_by_foreign');
            $table->dropColumn('approved_by');
        });
    }
};
