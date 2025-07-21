<?php

// database/seeders/ArtikelSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('artikels')->insert([
            [
                'title' => 'Panduan Gizi Anak 1000 HPK',
                'author' => 'Dr. Anisa',
                'image' => 'artikel1.jpg',
                'content' => '<h2>Pentingnya Gizi di 1000 Hari Pertama</h2><p>1000 Hari Pertama Kehidupan (HPK) adalah periode emas yang dimulai sejak janin dalam kandungan hingga anak berusia dua tahun. Asupan gizi yang optimal pada periode ini sangat menentukan kualitas kesehatan dan kecerdasan anak di masa depan.</p><p>Pastikan ibu hamil dan anak mendapatkan asupan zat besi, asam folat, dan yodium yang cukup.</p><ul><li>Zat Besi: Mencegah anemia.</li><li>Asam Folat: Penting untuk perkembangan sistem saraf.</li><li>Yodium: Mencegah gangguan pertumbuhan.</li></ul>',
                'date' => '2025-07-14',
                'is_new' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Makanan Sehat untuk Anak Balita',
                'author' => 'Puskesmas Kalangdosari',
                'image' => 'artikel2.jpg',
                'content' => '<h2>Rekomendasi Makanan Sehat</h2><p>Untuk mendukung tumbuh kembang balita, berikan makanan yang bervariasi dan seimbang. Prioritaskan sumber protein hewani seperti telur, ikan, dan daging.</p><p><strong>Contoh menu seimbang:</strong> Nasi, sup ayam dengan sayuran, dan buah sebagai pencuci mulut.</p>',
                'date' => '2025-06-30',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pencegahan Stunting Sejak Dini',
                'author' => 'Tim Kesehatan Desa',
                'image' => 'artikel3.jpg',
                'content' => '<h2>Langkah Praktis Pencegahan</h2><p>Pencegahan stunting adalah upaya kolektif. Dimulai dari pemantauan rutin ke posyandu, pemberian ASI eksklusif selama 6 bulan, hingga pengenalan Makanan Pendamping ASI (MP-ASI) yang berkualitas.</p><p>Jangan ragu untuk berkonsultasi dengan kader posyandu atau tenaga kesehatan terdekat.</p>',
                'date' => '2025-07-01',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
