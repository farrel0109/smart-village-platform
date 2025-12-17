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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('kk_number', 16)->unique(); // Nomor Kartu Keluarga
            $table->string('head_name'); // Nama Kepala Keluarga
            $table->foreignId('head_resident_id')->nullable()->constrained('residents')->onDelete('set null');
            $table->text('address');
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->foreignId('village_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Add family_id to residents table
        Schema::table('residents', function (Blueprint $table) {
            $table->foreignId('family_id')->nullable()->after('id')->constrained()->onDelete('set null');
            $table->enum('family_role', ['head', 'wife', 'child', 'parent', 'other'])->nullable()->after('family_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropForeign(['family_id']);
            $table->dropColumn(['family_id', 'family_role']);
        });
        
        Schema::dropIfExists('families');
    }
};
