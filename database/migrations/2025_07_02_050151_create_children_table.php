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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('usia'); // dalam bulan
            $table->float('berat_badan'); // kg
            $table->float('tinggi_badan'); // cm
            $table->string('desa');
            $table->string('status_gizi'); // Normal, Ringan, Sedang, Berat
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
