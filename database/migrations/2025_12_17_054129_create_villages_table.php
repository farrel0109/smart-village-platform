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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                     // Nama desa
            $table->string('code', 20)->unique();       // Kode desa unik
            $table->string('province');                 // Provinsi
            $table->string('regency');                  // Kabupaten/Kota
            $table->string('district');                 // Kecamatan
            $table->string('address')->nullable();      // Alamat kantor desa
            $table->string('phone', 15)->nullable();    // No. telepon
            $table->string('email')->nullable();        // Email desa
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Add village_id to users table
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('village_id')->nullable()->after('role_id')->constrained('villages')->nullOnDelete();
        });

        // Add village_id to residents table
        Schema::table('residents', function (Blueprint $table) {
            $table->foreignId('village_id')->nullable()->after('status')->constrained('villages')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
            $table->dropColumn('village_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['village_id']);
            $table->dropColumn('village_id');
        });

        Schema::dropIfExists('villages');
    }
};
