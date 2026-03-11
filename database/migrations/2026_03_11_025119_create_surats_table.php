<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('jenis_surat_id')->constrained()->onDelete('cascade');
            $table->text('keperluan');
            $table->enum('status', ['pending_admin', 'approved', 'rejected'])->default('pending_admin');
            $table->string('nomor_surat', 100)->nullable();
            $table->string('file_pdf', 255)->nullable();
            $table->text('catatan_penolakan')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
