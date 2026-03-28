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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Mahasiswa Pemohon
            $table->foreignId('template_id')->constrained('letter_templates'); // Jenis Surat
            $table->text('purpose'); // Keperluan

            // Status Surat
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // Verifikasi Admin
            $table->foreignId('verified_by')->nullable()->constrained('users'); // Admin yang verifikasi
            $table->timestamp('verified_at')->nullable();
            $table->text('rejection_notes')->nullable(); // Alasan penolakan

            // Hasil Akhir
            $table->string('file_path')->nullable(); // Path PDF
            $table->string('verification_code')->unique()->nullable(); // Kode QR

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
