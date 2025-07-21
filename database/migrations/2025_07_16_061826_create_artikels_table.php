<?php

// database/migrations/YYYY_MM_DD_xxxxxx_create_artikels_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
 * Run the migrations.
 *
 * Creates the 'artikels' table with columns for id, title, author, image, 
 * content, date, is_new, and timestamps. The author column defaults to 
 * 'Tim Kesehatan Desa', the image column is nullable, and the is_new column 
 * defaults to false.
 */

    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->default('Tim Kesehatan Desa');
            $table->string('image')->nullable(); // Kolom gambar yang nullable
            $table->longText('content'); // Isi artikel lengkap dalam format HTML
            $table->date('date');
            $table->boolean('is_new')->default(false);
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Menghapus tabel artikels beserta isi datanya.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
