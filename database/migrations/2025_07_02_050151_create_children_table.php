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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_ortu')->nullable(); // Ditambahkan: Nama Orang Tua
            $table->date('tanggal_lahir'); // Ditambahkan: Tanggal Lahir Anak
            $table->integer('usia'); // dalam bulan, bisa dihitung otomatis
            $table->char('jenis_kelamin', 1); // L atau P
            $table->string('desa');
            $table->float('berat_badan'); // kg
            $table->float('tinggi_badan'); // cm
            $table->float('lingkar_lengan')->nullable(); // Ditambahkan: LiLA dalam cm
            $table->float('lingkar_kepala')->nullable(); // Ditambahkan: LK dalam cm
            $table->string('status_gizi'); // Bawah Garis Merah, Kurang, Baik
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
