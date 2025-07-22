<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PrakitanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data anak dari Dusun Prakitan
        $anakData = [
            ['nama' => 'Ahmad Aditya Deffa', 'tgl_lahir' => '2020-07-10', 'jk' => 'L', 'nama_ortu' => 'Ahmad Sobirin', 'bb' => 10.2, 'tb' => 15.6, 'lila' => 16.5, 'lk' => 48.5, 'status' => 'B'],
            ['nama' => 'Muhammad Shaqille H.A.K', 'tgl_lahir' => '2020-09-02', 'jk' => 'L', 'nama_ortu' => 'Supardi, Dewi Puspitasari', 'bb' => 10.4, 'tb' => 14.3, 'lila' => 14.7, 'lk' => 46.5, 'status' => 'B'],
            ['nama' => 'Adriel Azril', 'tgl_lahir' => '2020-12-01', 'jk' => 'L', 'nama_ortu' => 'M. Japar Sidiq, Komisatun', 'bb' => 10.3, 'tb' => 14.7, 'lila' => 13.6, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Nafiz Afka Maulana', 'tgl_lahir' => '2021-02-05', 'jk' => 'L', 'nama_ortu' => 'Sudiono, Tasmik, Sri W', 'bb' => 95.8, 'tb' => 13.1, 'lila' => 14.5, 'lk' => 49, 'status' => 'KR'],
            ['nama' => 'Akhtar Zhafran Alfariqy', 'tgl_lahir' => '2021-10-05', 'jk' => 'L', 'nama_ortu' => 'Ahmad Mustakim, Olik M', 'bb' => 103.3, 'tb' => 15.3, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Jesicca Oktavia Maharani', 'tgl_lahir' => '2021-12-12', 'jk' => 'P', 'nama_ortu' => 'Sutrisno Pujiono, Laili Hidayah', 'bb' => 94.8, 'tb' => 11.5, 'lila' => 14, 'lk' => 47.5, 'status' => 'KR'],
            ['nama' => 'Muhammad Haidar Al-Azam', 'tgl_lahir' => '2021-10-25', 'jk' => 'L', 'nama_ortu' => 'Ch.Sholeh, Ulul K, Atik', 'bb' => 87.6, 'tb' => 11, 'lila' => 13.5, 'lk' => 48.5, 'status' => 'KR'],
            ['nama' => 'Shofia Nurul Tasbikha', 'tgl_lahir' => '2021-10-27', 'jk' => 'P', 'nama_ortu' => 'An.Syaroni, Uun Kurniati', 'bb' => 91.2, 'tb' => 11.3, 'lila' => 13.5, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Havika Revanza Maulida', 'tgl_lahir' => '2021-10-30', 'jk' => 'P', 'nama_ortu' => 'Rohmad, Umi Vuji Anti', 'bb' => 90, 'tb' => 10.5, 'lila' => 14, 'lk' => 45.5, 'status' => 'KR'],
            ['nama' => 'Muhammad Hamim N', 'tgl_lahir' => '2021-11-24', 'jk' => 'L', 'nama_ortu' => 'Umi Alfiatun N', 'bb' => 97, 'tb' => 12.2, 'lila' => 15, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Zia Annisatul Latifa', 'tgl_lahir' => '2021-11-28', 'jk' => 'P', 'nama_ortu' => 'Maimatul Kusna', 'bb' => 87.7, 'tb' => 11, 'lila' => 11.5, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Khairina Zharifa Almahyra', 'tgl_lahir' => '2021-12-26', 'jk' => 'P', 'nama_ortu' => 'Siti Khoerotun Nikmah', 'bb' => 90.8, 'tb' => 10.8, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Habibah evi nurjanah', 'tgl_lahir' => '2022-02-14', 'jk' => 'P', 'nama_ortu' => 'Nyamri', 'bb' => 90.7, 'tb' => 12.1, 'lila' => 15, 'lk' => 46.5, 'status' => 'B'],
            ['nama' => 'Muhammad Maulana Syafiq', 'tgl_lahir' => '2022-02-21', 'jk' => 'L', 'nama_ortu' => 'Aman Naim', 'bb' => 86, 'tb' => 11.1, 'lila' => 14.3, 'lk' => 49, 'status' => 'KR'],
            ['nama' => 'Adzillatul Nurul Juhaniyah', 'tgl_lahir' => '2022-02-27', 'jk' => 'P', 'nama_ortu' => 'Ika Wahyu S', 'bb' => 86.3, 'tb' => 11.7, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Muhammad Gibran Nurul Juhaniyah', 'tgl_lahir' => '2022-02-27', 'jk' => 'L', 'nama_ortu' => 'Sutaryono', 'bb' => 90.5, 'tb' => 13.6, 'lila' => 15, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Muhammad Rayyanul Aditama', 'tgl_lahir' => '2022-03-01', 'jk' => 'L', 'nama_ortu' => 'Ismi Rahma Hevi.S', 'bb' => 85.5, 'tb' => 11.2, 'lila' => 14, 'lk' => 47.5, 'status' => 'KR'],
            ['nama' => 'Afina Mawakim', 'tgl_lahir' => '2022-06-03', 'jk' => 'P', 'nama_ortu' => 'Siti Dwi Sulaswati', 'bb' => 82, 'tb' => 8.9, 'lila' => 13.5, 'lk' => 46, 'status' => 'BGM'],
            ['nama' => 'Muhammad Ilyas Khoironi', 'tgl_lahir' => '2022-08-04', 'jk' => 'L', 'nama_ortu' => 'Siti Romlah', 'bb' => 83, 'tb' => 9.3, 'lila' => 12.5, 'lk' => 49, 'status' => 'BGM'],
            ['nama' => 'Ameera Rkhmah', 'tgl_lahir' => '2022-09-06', 'jk' => 'P', 'nama_ortu' => 'Fika Nikmatul K', 'bb' => 89.6, 'tb' => 11.9, 'lila' => 14.5, 'lk' => 46.5, 'status' => 'B'],
            ['nama' => 'Aloya Nadzifa An Nayyira', 'tgl_lahir' => '2022-10-18', 'jk' => 'P', 'nama_ortu' => 'Umi Saroh', 'bb' => 93, 'tb' => 11, 'lila' => 13.8, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Ahmad Rafka Halim Putra', 'tgl_lahir' => '2023-02-19', 'jk' => 'L', 'nama_ortu' => 'Al Hajah Umroh', 'bb' => 90, 'tb' => 16.4, 'lila' => 19, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Lala Afriska Almayra Santoso', 'tgl_lahir' => '2023-02-22', 'jk' => 'P', 'nama_ortu' => 'Siti Ruhhayati', 'bb' => 79, 'tb' => 9.6, 'lila' => 15.5, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Siti Iqlima Shoqeena A', 'tgl_lahir' => '2023-02-27', 'jk' => 'P', 'nama_ortu' => 'Dewi Puspitasari', 'bb' => 84.4, 'tb' => 10.2, 'lila' => 14.9, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Muhammad Adam Alfarisi', 'tgl_lahir' => '2023-03-15', 'jk' => 'L', 'nama_ortu' => 'Nur Khofifah', 'bb' => 86.9, 'tb' => 12.1, 'lila' => 14.5, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Humaira Afra Kirani', 'tgl_lahir' => '2023-04-08', 'jk' => 'P', 'nama_ortu' => 'Nafiatul Kusnah', 'bb' => 75.5, 'tb' => 7.4, 'lila' => 14, 'lk' => 43, 'status' => 'BGM'],
            ['nama' => 'Arshanda Arfanuro Alfarizi', 'tgl_lahir' => '2023-05-17', 'jk' => 'L', 'nama_ortu' => 'Siti Mukaromah', 'bb' => 81.8, 'tb' => 10.7, 'lila' => 13.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Lathifah Nur Aira Fauzi', 'tgl_lahir' => '2023-06-17', 'jk' => 'P', 'nama_ortu' => 'Sri Murniati', 'bb' => 84, 'tb' => 9.6, 'lila' => 14, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Muhammad Ali Solin', 'tgl_lahir' => '2023-06-25', 'jk' => 'L', 'nama_ortu' => 'Siti Sofiatun', 'bb' => 82.9, 'tb' => 10.5, 'lila' => 14, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Muhammad Akmal Maulana', 'tgl_lahir' => '2023-07-11', 'jk' => 'L', 'nama_ortu' => 'Deni Rana Suryati', 'bb' => 79, 'tb' => 8.9, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Kalyana Ayu Andri', 'tgl_lahir' => '2023-09-19', 'jk' => 'P', 'nama_ortu' => 'Siti Sundari', 'bb' => 74.1, 'tb' => 6.9, 'lila' => 13.5, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Khumaira Ainunnisa Az Z', 'tgl_lahir' => '2023-11-08', 'jk' => 'P', 'nama_ortu' => 'Winik Indarwati', 'bb' => 73, 'tb' => 7.8, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ahmad Devano Bobi Pratama', 'tgl_lahir' => '2024-01-29', 'jk' => 'L', 'nama_ortu' => 'Siti Khoeriyatun Wasiyah', 'bb' => 72, 'tb' => 7, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ahmad Nur Adzhil', 'tgl_lahir' => '2024-05-12', 'jk' => 'L', 'nama_ortu' => 'L. Uswatun K', 'bb' => 72, 'tb' => 6.8, 'lila' => 13.5, 'lk' => 45, 'status' => 'BGM'],
            ['nama' => 'Ahmad Nur Adzril', 'tgl_lahir' => '2024-05-12', 'jk' => 'L', 'nama_ortu' => 'Nanik Pujiastutik', 'bb' => 75, 'tb' => 8.9, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Muhammad Ulil Albab', 'tgl_lahir' => '2024-06-06', 'jk' => 'L', 'nama_ortu' => 'Naili Rohmah', 'bb' => 74, 'tb' => 8.5, 'lila' => 14, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Ahmad Khuluqi Khasan', 'tgl_lahir' => '2024-06-26', 'jk' => 'L', 'nama_ortu' => 'Yasykur Larasati', 'bb' => 70, 'tb' => 8.8, 'lila' => 14.5, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Khiara Zevaria Azalea', 'tgl_lahir' => '2024-07-09', 'jk' => 'P', 'nama_ortu' => 'Ernawati', 'bb' => 70, 'tb' => 7.9, 'lila' => 14.5, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Muhammad Fardana Maulana', 'tgl_lahir' => '2024-07-27', 'jk' => 'L', 'nama_ortu' => 'Endang Surwiyati', 'bb' => 73, 'tb' => 8.3, 'lila' => 15, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Mahrus Ali', 'tgl_lahir' => '2024-08-21', 'jk' => 'L', 'nama_ortu' => 'Istikhoroh', 'bb' => 74, 'tb' => 10.9, 'lila' => 16, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Lilias Nailil Amani', 'tgl_lahir' => '2024-11-09', 'jk' => 'P', 'nama_ortu' => 'Ulpa Duwiyanti', 'bb' => 75, 'tb' => 8.8, 'lila' => 14.5, 'lk' => 14.2, 'status' => 'B'],
            ['nama' => 'Hayat Zean Fadillah', 'tgl_lahir' => '2024-12-13', 'jk' => 'L', 'nama_ortu' => 'Rindhih Ayu Yuliya', 'bb' => 68, 'tb' => 7.7, 'lila' => 13, 'lk' => 42.5, 'status' => 'B'],
            ['nama' => 'Alea Elmatra', 'tgl_lahir' => '2024-12-20', 'jk' => 'P', 'nama_ortu' => 'Urmila Matiurkar', 'bb' => 63, 'tb' => 7.1, 'lila' => 14, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Ahmad Elzio Devandra', 'tgl_lahir' => '2024-12-23', 'jk' => 'L', 'nama_ortu' => 'Titik Ambarwati', 'bb' => 72, 'tb' => 9.2, 'lila' => 15.5, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Alifah Lutfia Jannah', 'tgl_lahir' => '2025-01-14', 'jk' => 'P', 'nama_ortu' => 'Nyamri', 'bb' => 67, 'tb' => 7.2, 'lila' => 14, 'lk' => 41, 'status' => 'B'],
            ['nama' => 'Safira Nashwa Fauziyah', 'tgl_lahir' => '2025-04-27', 'jk' => 'P', 'nama_ortu' => 'Siti Mutmainah', 'bb' => 58.3, 'tb' => 6.6, 'lila' => 11, 'lk' => 41, 'status' => 'B'],
        ];

        // Pemetaan status gizi berdasarkan klarifikasi Anda
        $statusMapping = [
            'B' => 'Baik',
            'KR' => 'Kurang',
            'BGM' => 'Bawah Garis Merah',
        ];

        // Hapus data lama jika ada
        // Child::where('desa', 'Prakitan')->delete();

        foreach ($anakData as $data) {
            $tanggal_lahir = Carbon::parse($data['tgl_lahir']);
            $usia_bulan = $tanggal_lahir->diffInMonths(now());

            DB::table('children')->insert([
                'nama' => $data['nama'],
                'nama_ortu' => $data['nama_ortu'],
                'tanggal_lahir' => $tanggal_lahir,
                'usia' => $usia_bulan,
                'jenis_kelamin' => $data['jk'],
                'desa' => 'Prakitan',
                'berat_badan' => $data['bb'],
                'tinggi_badan' => $data['tb'],
                'lingkar_lengan' => $data['lila'],
                'lingkar_kepala' => $data['lk'],
                'status_gizi' => $statusMapping[$data['status']] ?? 'Baik',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
