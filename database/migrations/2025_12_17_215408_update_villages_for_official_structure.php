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
        Schema::table('villages', function (Blueprint $table) {
            // Rename 'code' to 'village_code' if exists, or add new
            if (Schema::hasColumn('villages', 'code')) {
                $table->renameColumn('code', 'village_code');
            } else {
                $table->string('village_code', 20)->nullable()->after('address');
            }
            
            // Add official structure fields
            $table->string('head_name')->nullable()->after('village_code');      // Nama Kepala Desa
            $table->string('head_title')->nullable()->after('head_name');        // Gelar/Jabatan
            $table->string('head_nip')->nullable()->after('head_title');         // NIP (jika PNS)
            $table->string('secretary_name')->nullable()->after('head_nip');     // Nama Sekdes
            $table->string('secretary_nip')->nullable()->after('secretary_name');// NIP Sekdes
            $table->string('logo_path')->nullable()->after('secretary_nip');     // Logo desa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('villages', function (Blueprint $table) {
            $table->dropColumn([
                'head_name', 'head_title', 'head_nip', 
                'secretary_name', 'secretary_nip', 'logo_path'
            ]);
        });
    }
};
