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
        Schema::table('letter_types', function (Blueprint $table) {
            // Add classification code from Permendagri
            $table->string('classification_code', 10)->after('code');   // Kode klasifikasi: 470, 500, dll
            $table->string('template_view')->nullable()->after('requirements'); // Nama blade template
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letter_types', function (Blueprint $table) {
            $table->dropColumn(['classification_code', 'template_view']);
        });
    }
};
