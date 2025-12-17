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
        Schema::table('letter_requests', function (Blueprint $table) {
            // Official letter number: 015/470/DS-SJM/XII/2025
            $table->string('letter_number')->nullable()->after('request_number');
            
            // Dynamic data for flexible form fields
            $table->json('dynamic_data')->nullable()->after('notes');
            
            // Attachments JSON: {"rt": "path/to/rt.pdf", "rw": "path/to/rw.pdf", "other": [...]}
            $table->json('attachments')->nullable()->after('dynamic_data');
            
            // Who signs the letter
            $table->enum('signed_by', ['head', 'secretary'])->default('head')->after('attachments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letter_requests', function (Blueprint $table) {
            $table->dropColumn(['letter_number', 'dynamic_data', 'attachments', 'signed_by']);
        });
    }
};
