<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul e-book
            $table->text('description'); // Deskripsi
            $table->string('file_path'); // Path ke file PDF
            $table->string('cover_path'); // Path ke cover gambar
            $table->boolean('is_new')->default(true); // Menampilkan badge "NEW"
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
}