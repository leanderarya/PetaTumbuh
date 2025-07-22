<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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
                'content' => '<h2>Pentingnya Gizi di 1000 Hari Pertama</h2><p>1000 Hari Pertama Kehidupan (HPK) adalah periode emas yang dimulai sejak janin dalam kandungan hingga anak berusia dua tahun. Asupan gizi yang optimal pada periode ini sangat menentukan kualitas kesehatan dan kecerdasan anak di masa depan.</p><ul><li>Zat Besi: Mencegah anemia.</li><li>Asam Folat: Penting untuk perkembangan sistem saraf.</li><li>Yodium: Mencegah gangguan pertumbuhan.</li></ul>',
                'date' => '2025-07-14',
                'is_new' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Makanan Sehat untuk Anak Balita',
                'author' => 'Puskesmas Kalangdosari',
                'image' => 'artikel2.jpg',
                'content' => '<h2>Rekomendasi Makanan Sehat</h2><p>Untuk mendukung tumbuh kembang balita, berikan makanan yang bervariasi dan seimbang. Prioritaskan sumber protein hewani seperti telur, ikan, dan daging.</p><strong>Contoh menu seimbang:</strong> Nasi, sup ayam dengan sayuran, dan buah sebagai pencuci mulut.</p>',
                'date' => '2025-06-30',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pencegahan Stunting Sejak Dini',
                'author' => 'Tim Kesehatan Desa',
                'image' => 'artikel3.jpg',
                'content' => '<h2>Langkah Praktis Pencegahan</h2><p>Pencegahan stunting adalah upaya kolektif. Dimulai dari pemantauan rutin ke posyandu, pemberian ASI eksklusif selama 6 bulan, hingga pengenalan MP-ASI yang berkualitas.</p><p>Jangan ragu untuk berkonsultasi dengan kader posyandu atau tenaga kesehatan terdekat.</p>',
                'date' => '2025-07-01',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pentingnya Imunisasi Dasar Lengkap',
                'author' => 'Dinas Kesehatan',
                'image' => 'artikel4.jpg',
                'content' => '<h2>Perlindungan Anak Melalui Imunisasi</h2><p>Imunisasi dasar lengkap wajib diberikan untuk mencegah penyakit berbahaya seperti campak, polio, dan difteri. Pastikan jadwal imunisasi anak Anda sesuai dengan anjuran pemerintah.</p>',
                'date' => '2025-07-12',
                'is_new' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Menu MP-ASI Rumahan untuk Si Kecil',
                'author' => 'Bid. Ernawati',
                'image' => 'artikel5.jpg',
                'content' => '<h2>Kreasi MP-ASI Mudah</h2><p>Buat MP-ASI dengan bahan lokal seperti ubi, ayam, dan sayuran. MP-ASI seimbang meningkatkan daya tahan tubuh dan membantu pertumbuhan optimal.</p>',
                'date' => '2025-06-25',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ibu Hamil dan Pentingnya Suplementasi',
                'author' => 'Dr. Wulan',
                'image' => 'artikel6.jpg',
                'content' => '<h2>Suplementasi untuk Ibu Hamil</h2><p>Ibu hamil sebaiknya mengonsumsi suplemen zat besi dan asam folat secara rutin. Hal ini dapat mengurangi risiko anemia dan meningkatkan kualitas janin.</p>',
                'date' => '2025-07-10',
                'is_new' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tanda-tanda Anak Mengalami Stunting',
                'author' => 'Tim Posyandu',
                'image' => 'artikel7.jpg',
                'content' => '<h2>Kenali Gejala Stunting</h2><p>Anak stunting cenderung lebih pendek dari teman seusianya, sering sakit, dan perkembangan motoriknya terhambat. Jika muncul tanda-tanda tersebut, konsultasikan ke posyandu terdekat.</p>',
                'date' => '2025-06-21',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Peran Keluarga dalam Cegah Stunting',
                'author' => 'PKK Kalangdosari',
                'image' => 'artikel8.jpg',
                'content' => '<h2>Keluarga sebagai Garda Terdepan</h2><p>Dukungan keluarga sangat penting dalam pencegahan stunting. Perhatikan pola makan, kebersihan, dan jadwalkan kontrol rutin ke posyandu.</p>',
                'date' => '2025-07-06',
                'is_new' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Air Bersih dan Sanitasi untuk Anak Sehat',
                'author' => 'Sanitarian Desa',
                'image' => 'artikel9.jpg',
                'content' => '<h2>Pentingnya Akses Air Bersih</h2><p>Lingkungan bersih, akses air bersih, dan sanitasi memadai dapat mencegah penyakit diare yang sering menjadi penyebab stunting.</p>',
                'date' => '2025-06-18',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cuci Tangan, Cegah Stunting!',
                'author' => 'Puskesmas Kalangdosari',
                'image' => 'artikel10.jpg',
                'content' => '<h2>Kebiasaan Sehat dari Rumah</h2><p>Mengajarkan anak mencuci tangan sebelum makan dan setelah bermain adalah kebiasaan sederhana yang berdampak besar pada kesehatan anak.</p>',
                'date' => '2025-06-15',
                'is_new' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}