<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KalangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $anakData = [
            ['nama' => 'Muhammad Sabiul Muttaqin', 'tgl_lahir' => '2020-11-06', 'umur_thn' => 4, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Akhmad Juri, Rumi Ulfiah', 'tb' => 112, 'bb' => 22, 'lila' => 20, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Delisa Silvia Aneska', 'tgl_lahir' => '2020-12-22', 'umur_thn' => 4, 'umur_bln' => 7, 'jk' => 'P', 'nama_ortu' => 'Nur Solikin, Siti Nur Hidayati', 'tb' => 100, 'bb' => 13, 'lila' => 15, 'lk' => 48.2, 'status' => 'KR'],
            ['nama' => 'Muhammad Aufa Febriansyah', 'tgl_lahir' => '2021-02-02', 'umur_thn' => 4, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Mustajab, Luffiyanti', 'tb' => 95, 'bb' => 13, 'lila' => 15, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Akbar Rayyan', 'tgl_lahir' => '2021-03-15', 'umur_thn' => 4, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Suladi, Luluk Yuliana', 'tb' => 99, 'bb' => 14, 'lila' => 14, 'lk' => 49.5, 'status' => 'B'],
            ['nama' => 'Muhammad Syaihurrohman', 'tgl_lahir' => '2021-03-28', 'umur_thn' => 4, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'M.Rifa\'i, Muniroh', 'tb' => 100, 'bb' => 13, 'lila' => 14, 'lk' => 50, 'status' => 'KR'],
            ['nama' => 'Azka Faqih Ahmad', 'tgl_lahir' => '2021-04-07', 'umur_thn' => 4, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'M.Safi\'i, Siti Khoirotun N', 'tb' => 103, 'bb' => 16, 'lila' => 17, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Ahmad Gibran Al Latif', 'tgl_lahir' => '2021-06-21', 'umur_thn' => 4, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Jasmani, Eli Nur M', 'tb' => 94, 'bb' => 14, 'lila' => 16, 'lk' => 50.5, 'status' => 'B'],
            ['nama' => 'Bilal El Rafasy Ahmad', 'tgl_lahir' => '2021-07-20', 'umur_thn' => 4, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Ahmad Kundori, Ana Fiolita S', 'tb' => 95.6, 'bb' => 13, 'lila' => 15, 'lk' => 49.5, 'status' => 'B'],
            ['nama' => 'Muhammad Fahri Alfarizki', 'tgl_lahir' => '2021-08-02', 'umur_thn' => 3, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Miftahul Huda, Anifatul Q', 'tb' => 93.5, 'bb' => 13, 'lila' => 17, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Fahima Hana Zulaikha', 'tgl_lahir' => '2021-09-04', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Novaku Fujianto Y, Tri Irnawati', 'tb' => 96.5, 'bb' => 15, 'lila' => 19, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Felicia Shanum', 'tgl_lahir' => '2022-01-05', 'umur_thn' => 3, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Ririna Fatikah', 'tb' => 91, 'bb' => 11, 'lila' => 15, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Ahmad Fathon Akmal Wafa', 'tgl_lahir' => '2022-01-25', 'umur_thn' => 3, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Ufin Nikmah', 'tb' => 93.2, 'bb' => 13, 'lila' => 15, 'lk' => 51, 'status' => 'B'],
            ['nama' => 'Ayfa Zafa Aziza', 'tgl_lahir' => '2022-02-22', 'umur_thn' => 3, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Siti Luluk Ur K', 'tb' => 91.5, 'bb' => 12, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Naura Aprinissa Hafidzah', 'tgl_lahir' => '2022-04-20', 'umur_thn' => 3, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Nuriyatul Badriyah', 'tb' => 88.5, 'bb' => 10, 'lila' => 15, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Zanisa Aprilia Ramadhani', 'tgl_lahir' => '2022-04-26', 'umur_thn' => 3, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Mukayati', 'tb' => 88, 'bb' => 11, 'lila' => 15, 'lk' => 49, 'status' => 'KR'],
            ['nama' => 'Nur Almaira Raissa', 'tgl_lahir' => '2022-06-15', 'umur_thn' => 3, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Siti Katimah', 'tb' => 86.5, 'bb' => 11, 'lila' => 17, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Muhammad Eza Latif A', 'tgl_lahir' => '2022-10-05', 'umur_thn' => 2, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Setia Ayu Ningsih', 'tb' => 87.5, 'bb' => 13, 'lila' => 17, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Nadia Ufi Maulida', 'tgl_lahir' => '2022-10-19', 'umur_thn' => 2, 'umur_bln' => 9, 'jk' => 'P', 'nama_ortu' => 'Daryani', 'tb' => 85, 'bb' => 9.8, 'lila' => 15, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Muhammad Yusuf Anmar A', 'tgl_lahir' => '2022-11-11', 'umur_thn' => 2, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Umi Lailatul Y', 'tb' => 89.2, 'bb' => 14, 'lila' => 17, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Nauren Maydina Khanza', 'tgl_lahir' => '2023-06-02', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Maria Ulfa', 'tb' => 76, 'bb' => 8.3, 'lila' => 14, 'lk' => 47, 'status' => 'BGM'],
            ['nama' => 'Arumi Razita Humaira', 'tgl_lahir' => '2023-07-31', 'umur_thn' => 2, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Lasmi', 'tb' => 83.5, 'bb' => 11, 'lila' => 16, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Syarif Deryan Ahmad', 'tgl_lahir' => '2023-08-31', 'umur_thn' => 1, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Anik Nur Afifah', 'tb' => 81, 'bb' => 11, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Syarif Rayyan Ahmad', 'tgl_lahir' => '2023-08-31', 'umur_thn' => 1, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Anik Nur Afifah', 'tb' => 81, 'bb' => 11, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Ayana Rizqa Nazafarin', 'tgl_lahir' => '2024-05-25', 'umur_thn' => 1, 'umur_bln' => 2, 'jk' => 'P', 'nama_ortu' => 'Rin Sumarsih', 'tb' => 78, 'bb' => 10, 'lila' => 16, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Syarefa Qiyara', 'tgl_lahir' => '2024-06-01', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Aslihatul Zumaroh', 'tb' => 75, 'bb' => 7.7, 'lila' => 15, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Alnaisyra Chasina Achmad', 'tgl_lahir' => '2024-09-04', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Siti Afiatun Nainah', 'tb' => 69, 'bb' => 7.3, 'lila' => 15, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Albyandra Zayyan Ahmad', 'tgl_lahir' => '2024-09-21', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Ainun Nafisah', 'tb' => 68, 'bb' => 7.8, 'lila' => 16, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Kalea Elvira Noviani', 'tgl_lahir' => '2024-11-11', 'umur_thn' => 0, 'umur_bln' => 8, 'jk' => 'P', 'nama_ortu' => 'Siti Amnah', 'tb' => 69, 'bb' => 7.3, 'lila' => 17, 'lk' => 41, 'status' => 'B'],
            ['nama' => 'Siti Aisyah', 'tgl_lahir' => '2025-01-22', 'umur_thn' => 0, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Umi Nur Mahmudah', 'tb' => 69, 'bb' => 8.3, 'lila' => 16, 'lk' => 40, 'status' => 'B'],
            ['nama' => 'Tasaka Almir Faizan', 'tgl_lahir' => '2025-01-04', 'umur_thn' => 0, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Taratika Putri Riantya', 'tb' => 67, 'bb' => 6.9, 'lila' => null, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Muhammad Devan Al Kafi', 'tgl_lahir' => '2025-02-02', 'umur_thn' => 0, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Nurul Badriah', 'tb' => 67, 'bb' => 7.3, 'lila' => null, 'lk' => 43, 'status' => 'B'],
            ['nama' => 'Afizah Kharina Nadhifah', 'tgl_lahir' => '2025-04-04', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Umi Lailatul Yulaikah', 'tb' => 60, 'bb' => 5.7, 'lila' => null, 'lk' => 38, 'status' => 'B'],
            ['nama' => 'Asyiqa Hanin Az Zahra', 'tgl_lahir' => '2025-04-10', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Siti Qomariah', 'tb' => 68, 'bb' => 5.6, 'lila' => null, 'lk' => 39, 'status' => 'B'],
            ['nama' => 'Ahmad Najmi Abidzar Kamil', 'tgl_lahir' => '2025-05-28', 'umur_thn' => 0, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Yuli Setiyowati', 'tb' => 58, 'bb' => 4.9, 'lila' => null, 'lk' => null, 'status' => 'B'],
        ];
        // Pemetaan status gizi
        $statusMapping = [
            'B' => 'Baik',
            'KR' => 'Kurang',
            'BGM' => 'Bawah Garis Merah',
        ];

        foreach ($anakData as $data) {
            // Menghitung total usia dalam bulan dari data THN dan BLN
            $usia_bulan = ($data['umur_thn'] * 12) + $data['umur_bln'];

            DB::table('children')->insert([
                'nama' => $data['nama'],
                'nama_ortu' => $data['nama_ortu'],
                'tanggal_lahir' => Carbon::parse($data['tgl_lahir']),
                'usia' => $usia_bulan,
                'jenis_kelamin' => $data['jk'],
                'desa' => 'Kalang', // Set desa ke Kalang
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
