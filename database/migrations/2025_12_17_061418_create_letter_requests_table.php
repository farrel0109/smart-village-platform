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
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_number')->unique();     // Nomor pengajuan
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('village_id')->constrained()->onDelete('cascade');
            $table->foreignId('letter_type_id')->constrained()->onDelete('cascade');
            $table->text('purpose');                        // Keperluan/tujuan
            $table->text('notes')->nullable();              // Catatan tambahan
            $table->enum('status', [
                'pending',      // Menunggu diproses
                'processing',   // Sedang diproses
                'completed',    // Selesai
                'rejected'      // Ditolak
            ])->default('pending');
            $table->text('rejection_reason')->nullable();   // Alasan penolakan
            $table->string('document_path')->nullable();    // Path file surat jadi
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
