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
            ['nama' => 'Ahmad Aditya Deffa', 'tgl_lahir' => '2020-07-10', 'jk' => 'L', 'nama_ortu' => 'Ahmad Sobirin', 'tb' => 10.2, 'bb' => 15.6, 'lila' => 16.5, 'lk' => 48.5, 'status' => 'B'],
            ['nama' => 'Muhammad Shaqille H.A.K', 'tgl_lahir' => '2020-09-02', 'jk' => 'L', 'nama_ortu' => 'Supardi, Dewi Puspitasari', 'tb' => 10.4, 'bb' => 14.3, 'lila' => 14.7, 'lk' => 46.5, 'status' => 'B'],
            ['nama' => 'Adriel Azril', 'tgl_lahir' => '2020-12-01', 'jk' => 'L', 'nama_ortu' => 'M. Japar Sidiq, Komisatun', 'tb' => 10.3, 'bb' => 14.7, 'lila' => 13.6, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Nafiz Afka Maulana', 'tgl_lahir' => '2021-02-05', 'jk' => 'L', 'nama_ortu' => 'Sudiono, Tasmik, Sri W', 'tb' => 95.8, 'bb' => 13.1, 'lila' => 14.5, 'lk' => 49, 'status' => 'KR'],
            ['nama' => 'Akhtar Zhafran Alfariqy', 'tgl_lahir' => '2021-10-05', 'jk' => 'L', 'nama_ortu' => 'Ahmad Mustakim, Olik M', 'tb' => 103.3, 'bb' => 15.3, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Jesicca Oktavia Maharani', 'tgl_lahir' => '2021-12-12', 'jk' => 'P', 'nama_ortu' => 'Sutrisno Pujiono, Laili Hidayah', 'tb' => 94.8, 'bb' => 11.5, 'lila' => 14, 'lk' => 47.5, 'status' => 'KR'],
            ['nama' => 'Muhammad Haidar Al-Azam', 'tgl_lahir' => '2021-10-25', 'jk' => 'L', 'nama_ortu' => 'Ch.Sholeh, Ulul K, Atik', 'tb' => 87.6, 'bb' => 11, 'lila' => 13.5, 'lk' => 48.5, 'status' => 'KR'],
            ['nama' => 'Shofia Nurul Tasbikha', 'tgl_lahir' => '2021-10-27', 'jk' => 'P', 'nama_ortu' => 'An.Syaroni, Uun Kurniati', 'tb' => 91.2, 'bb' => 11.3, 'lila' => 13.5, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Havika Revanza Maulida', 'tgl_lahir' => '2021-10-30', 'jk' => 'P', 'nama_ortu' => 'Rohmad, Umi Vuji Anti', 'tb' => 90, 'bb' => 10.5, 'lila' => 14, 'lk' => 45.5, 'status' => 'KR'],
            ['nama' => 'Muhammad Hamim N', 'tgl_lahir' => '2021-11-24', 'jk' => 'L', 'nama_ortu' => 'Umi Alfiatun N', 'tb' => 97, 'bb' => 12.2, 'lila' => 15, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Zia Annisatul Latifa', 'tgl_lahir' => '2021-11-28', 'jk' => 'P', 'nama_ortu' => 'Maimatul Kusna', 'tb' => 87.7, 'bb' => 11, 'lila' => 11.5, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Khairina Zharifa Almahyra', 'tgl_lahir' => '2021-12-26', 'jk' => 'P', 'nama_ortu' => 'Siti Khoerotun Nikmah', 'tb' => 90.8, 'bb' => 10.8, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Habibah evi nurjanah', 'tgl_lahir' => '2022-02-14', 'jk' => 'P', 'nama_ortu' => 'Nyamri', 'tb' => 90.7, 'bb' => 12.1, 'lila' => 15, 'lk' => 46.5, 'status' => 'B'],
            ['nama' => 'Muhammad Maulana Syafiq', 'tgl_lahir' => '2022-02-21', 'jk' => 'L', 'nama_ortu' => 'Aman Naim', 'tb' => 86, 'bb' => 11.1, 'lila' => 14.3, 'lk' => 49, 'status' => 'KR'],
            ['nama' => 'Adzillatul Nurul Juhaniyah', 'tgl_lahir' => '2022-02-27', 'jk' => 'P', 'nama_ortu' => 'Ika Wahyu S', 'tb' => 86.3, 'bb' => 11.7, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Muhammad Gibran Nurul Juhaniyah', 'tgl_lahir' => '2022-02-27', 'jk' => 'L', 'nama_ortu' => 'Sutaryono', 'tb' => 90.5, 'bb' => 13.6, 'lila' => 15, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Muhammad Rayyanul Aditama', 'tgl_lahir' => '2022-03-01', 'jk' => 'L', 'nama_ortu' => 'Ismi Rahma Hevi.S', 'tb' => 85.5, 'bb' => 11.2, 'lila' => 14, 'lk' => 47.5, 'status' => 'KR'],
            ['nama' => 'Afina Mawakim', 'tgl_lahir' => '2022-06-03', 'jk' => 'P', 'nama_ortu' => 'Siti Dwi Sulaswati', 'tb' => 82, 'bb' => 8.9, 'lila' => 13.5, 'lk' => 46, 'status' => 'BGM'],
            ['nama' => 'Muhammad Ilyas Khoironi', 'tgl_lahir' => '2022-08-04', 'jk' => 'L', 'nama_ortu' => 'Siti Romlah', 'tb' => 83, 'bb' => 9.3, 'lila' => 12.5, 'lk' => 49, 'status' => 'BGM'],
            ['nama' => 'Ameera Rkhmah', 'tgl_lahir' => '2022-09-06', 'jk' => 'P', 'nama_ortu' => 'Fika Nikmatul K', 'tb' => 89.6, 'bb' => 11.9, 'lila' => 14.5, 'lk' => 46.5, 'status' => 'B'],
            ['nama' => 'Aloya Nadzifa An Nayyira', 'tgl_lahir' => '2022-10-18', 'jk' => 'P', 'nama_ortu' => 'Umi Saroh', 'tb' => 93, 'bb' => 11, 'lila' => 13.8, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Ahmad Rafka Halim Putra', 'tgl_lahir' => '2023-02-19', 'jk' => 'L', 'nama_ortu' => 'Al Hajah Umroh', 'tb' => 90, 'bb' => 16.4, 'lila' => 19, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Lala Afriska Almayra Santoso', 'tgl_lahir' => '2023-02-22', 'jk' => 'P', 'nama_ortu' => 'Siti Ruhhayati', 'tb' => 79, 'bb' => 9.6, 'lila' => 15.5, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Siti Iqlima Shoqeena A', 'tgl_lahir' => '2023-02-27', 'jk' => 'P', 'nama_ortu' => 'Dewi Puspitasari', 'tb' => 84.4, 'bb' => 10.2, 'lila' => 14.9, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Muhammad Adam Alfarisi', 'tgl_lahir' => '2023-03-15', 'jk' => 'L', 'nama_ortu' => 'Nur Khofifah', 'tb' => 86.9, 'bb' => 12.1, 'lila' => 14.5, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Humaira Afra Kirani', 'tgl_lahir' => '2023-04-08', 'jk' => 'P', 'nama_ortu' => 'Nafiatul Kusnah', 'tb' => 75.5, 'bb' => 7.4, 'lila' => 14, 'lk' => 43, 'status' => 'BGM'],
            ['nama' => 'Arshanda Arfanuro Alfarizi', 'tgl_lahir' => '2023-05-17', 'jk' => 'L', 'nama_ortu' => 'Siti Mukaromah', 'tb' => 81.8, 'bb' => 10.7, 'lila' => 13.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Lathifah Nur Aira Fauzi', 'tgl_lahir' => '2023-06-17', 'jk' => 'P', 'nama_ortu' => 'Sri Murniati', 'tb' => 84, 'bb' => 9.6, 'lila' => 14, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Muhammad Ali Solin', 'tgl_lahir' => '2023-06-25', 'jk' => 'L', 'nama_ortu' => 'Siti Sofiatun', 'tb' => 82.9, 'bb' => 10.5, 'lila' => 14, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Muhammad Akmal Maulana', 'tgl_lahir' => '2023-07-11', 'jk' => 'L', 'nama_ortu' => 'Deni Rana Suryati', 'tb' => 79, 'bb' => 8.9, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Kalyana Ayu Andri', 'tgl_lahir' => '2023-09-19', 'jk' => 'P', 'nama_ortu' => 'Siti Sundari', 'tb' => 74.1, 'bb' => 6.9, 'lila' => 13.5, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Khumaira Ainunnisa Az Z', 'tgl_lahir' => '2023-11-08', 'jk' => 'P', 'nama_ortu' => 'Winik Indarwati', 'tb' => 73, 'bb' => 7.8, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ahmad Devano Bobi Pratama', 'tgl_lahir' => '2024-01-29', 'jk' => 'L', 'nama_ortu' => 'Siti Khoeriyatun Wasiyah', 'tb' => 72, 'bb' => 7, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Luki Ahmad Zaidan', 'tgl_lahir' => '2024-03-12', 'jk' => 'L', 'nama_ortu' => 'Wahyuningsih', 'tb' => 72, 'bb' => 6.8, 'lila' => 13.5, 'lk' => 45, 'status' => 'BGM'],
            ['nama' => 'Ahmad Nur Adzril', 'tgl_lahir' => '2024-05-12', 'jk' => 'L', 'nama_ortu' => 'Nanik Pujiastutik', 'tb' => 75, 'bb' => 8.9, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Muhammad Ulil Albab', 'tgl_lahir' => '2024-06-06', 'jk' => 'L', 'nama_ortu' => 'Naili Rohmah', 'tb' => 74, 'bb' => 8.5, 'lila' => 14, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Ahmad Khuluqi Khasan', 'tgl_lahir' => '2024-06-26', 'jk' => 'L', 'nama_ortu' => 'Yasykur Larasati', 'tb' => 70, 'bb' => 8.8, 'lila' => 14.5, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Khiara Zevaria Azalea', 'tgl_lahir' => '2024-07-09', 'jk' => 'P', 'nama_ortu' => 'Ernawati', 'tb' => 70, 'bb' => 7.9, 'lila' => 14.5, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Muhammad Fardana Maulana', 'tgl_lahir' => '2024-07-27', 'jk' => 'L', 'nama_ortu' => 'Endang Surwiyati', 'tb' => 73, 'bb' => 8.3, 'lila' => 15, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Mahrus Ali', 'tgl_lahir' => '2024-08-21', 'jk' => 'L', 'nama_ortu' => 'Istikhoroh', 'tb' => 74, 'bb' => 10.9, 'lila' => 16, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Lilias Nailil Amani', 'tgl_lahir' => '2024-11-09', 'jk' => 'P', 'nama_ortu' => 'Ulpa Duwiyanti', 'tb' => 75, 'bb' => 8.8, 'lila' => 14.5, 'lk' => 14.2, 'status' => 'B'],
            ['nama' => 'Hayat Zean Fadillah', 'tgl_lahir' => '2024-12-13', 'jk' => 'L', 'nama_ortu' => 'Rindhih Ayu Yuliya', 'tb' => 68, 'bb' => 7.7, 'lila' => 13, 'lk' => 42.5, 'status' => 'B'],
            ['nama' => 'Alea Elmatra', 'tgl_lahir' => '2024-12-20', 'jk' => 'P', 'nama_ortu' => 'Urmila Matiurkar', 'tb' => 63, 'bb' => 7.1, 'lila' => 14, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Ahmad Elzio Devandra', 'tgl_lahir' => '2024-12-23', 'jk' => 'L', 'nama_ortu' => 'Titik Ambarwati', 'tb' => 72, 'bb' => 9.2, 'lila' => 15.5, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Alifah Lutfia Jannah', 'tgl_lahir' => '2025-01-14', 'jk' => 'P', 'nama_ortu' => 'Nyamri', 'tb' => 67, 'bb' => 7.2, 'lila' => 14, 'lk' => 41, 'status' => 'B'],
            ['nama' => 'Safira Nashwa Fauziyah', 'tgl_lahir' => '2025-04-27', 'jk' => 'P', 'nama_ortu' => 'Siti Mutmainah', 'tb' => 58.3, 'bb' => 6.6, 'lila' => 11, 'lk' => 41, 'status' => 'B'],
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
