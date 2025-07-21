<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('perkembangan_gizis', function (Blueprint $table) {
            $table->id();  // Primary key untuk perkembangan_gizis
            $table->foreignId('anak_id')->constrained('children')->onDelete('cascade');  // Foreign key untuk anak_id
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('tinggi_badan', 5, 2);
            $table->string('status_gizi');
            $table->text('catatan')->nullable();
            $table->date('tanggal_pemeriksaan');  // Menambahkan kolom tanggal_pemeriksaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkembangan_gizis');
    }
};