<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PayasanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data anak dari Dusun Payasan
        $anakData = [
            ['nama' => 'Luffia Irem Maari', 'tgl_lahir' => '2020-07-12', 'umur_thn' => 5, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Damanto, Jumarsih', 'bb' => 107, 'tb' => 18, 'lila' => 16.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Iren Juliyana Calista', 'tgl_lahir' => '2020-07-14', 'umur_thn' => 5, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Hartatik', 'bb' => 102.8, 'tb' => 15.1, 'lila' => 16.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Lutfan Hamid Maarif', 'tgl_lahir' => '2020-07-19', 'umur_thn' => 5, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Mas Agus Naaf Ilya Rahayu', 'bb' => 105.5, 'tb' => 15.5, 'lila' => 17, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Elvan Al Fallah', 'tgl_lahir' => '2020-07-27', 'umur_thn' => 5, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Slamet Riyadi, Nanik Sugiyarti', 'bb' => 110, 'tb' => 17.3, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Almira Nayliatul Az Zahra', 'tgl_lahir' => '2020-07-27', 'umur_thn' => 5, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Giyanto, Siti Umyati', 'bb' => 109.5, 'tb' => 16.8, 'lila' => 17, 'lk' => 51, 'status' => 'B'],
            ['nama' => 'Aurelia Mafteilania Arsyila', 'tgl_lahir' => '2020-09-10', 'umur_thn' => 4, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Eko Suwarto, Indah Sri Lestari', 'bb' => 98.8, 'tb' => 14, 'lila' => 17.5, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Muhammad Arkha Rofikhul A', 'tgl_lahir' => '2020-10-07', 'umur_thn' => 4, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Susanto, Surati', 'bb' => 103.2, 'tb' => 15.4, 'lila' => 17, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Andini Nayla Nurjannah', 'tgl_lahir' => '2020-11-21', 'umur_thn' => 4, 'umur_bln' => 8, 'jk' => 'P', 'nama_ortu' => 'Ahmad Nur Udin, Ari Uswatun', 'bb' => 94, 'tb' => 12.4, 'lila' => 15.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Irsyad Nafasya A', 'tgl_lahir' => '2021-02-02', 'umur_thn' => 4, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Slamet, Warni', 'bb' => 100.5, 'tb' => 14.7, 'lila' => 16, 'lk' => 52, 'status' => 'B'],
            ['nama' => 'Azka Sauqi Al Fatih', 'tgl_lahir' => '2021-06-07', 'umur_thn' => 4, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Lasmi, Zulaikah', 'bb' => 98, 'tb' => 12, 'lila' => 14.5, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Juwairiyah W.', 'tgl_lahir' => '2021-06-27', 'umur_thn' => 4, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Joko Suyono, Sri Kumeis', 'bb' => 103, 'tb' => 15.4, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Fayola Nadhifa Putri', 'tgl_lahir' => '2021-06-29', 'umur_thn' => 4, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Parno, Nuryani', 'bb' => 99, 'tb' => 15.5, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Ryana Natania', 'tgl_lahir' => '2021-07-04', 'umur_thn' => 4, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Joko Susilo, Siti Nur C.', 'bb' => 98.9, 'tb' => 12.7, 'lila' => 13.5, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Alfareza Dirgantara', 'tgl_lahir' => '2021-07-24', 'umur_thn' => 4, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'L. Listiono, Siti Nur Hidayah', 'bb' => 97, 'tb' => 13.3, 'lila' => 15.5, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Nindy Anindita Aninda', 'tgl_lahir' => '2021-08-24', 'umur_thn' => 3, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Nuriyanto, Ilun Astuti', 'bb' => 93.5, 'tb' => 13.1, 'lila' => 16, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Azkia Kusuma Putri', 'tgl_lahir' => '2021-09-27', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Parnin', 'bb' => 99.5, 'tb' => 17.5, 'lila' => 19, 'lk' => 49.5, 'status' => 'B'],
            ['nama' => 'Livia Talita Permatasari', 'tgl_lahir' => '2021-10-05', 'umur_thn' => 3, 'umur_bln' => 9, 'jk' => 'P', 'nama_ortu' => 'Lasno, Linda Susilowati', 'bb' => 90.5, 'tb' => 10.1, 'lila' => 13, 'lk' => 46, 'status' => 'BGM'],
            ['nama' => 'Ardania Dwi Laksono', 'tgl_lahir' => '2021-10-08', 'umur_thn' => 3, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Aris Rusmanto, Sutrisni', 'bb' => 95.5, 'tb' => 12.7, 'lila' => 15.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Devina Salma Aulia', 'tgl_lahir' => '2021-11-28', 'umur_thn' => 3, 'umur_bln' => 8, 'jk' => 'P', 'nama_ortu' => 'Zaini Wulan Sari', 'bb' => 94.7, 'tb' => 13.9, 'lila' => 16.5, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Muhammad Abrisam S', 'tgl_lahir' => '2022-01-28', 'umur_thn' => 3, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Khoeroni', 'bb' => 92.7, 'tb' => 11.8, 'lila' => 14, 'lk' => 48.5, 'status' => 'BGM'],
            ['nama' => 'Prisa Anindhita', 'tgl_lahir' => '2022-01-04', 'umur_thn' => 3, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Desain Endri', 'bb' => 96.5, 'tb' => 13.5, 'lila' => 15, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Ahmad Fathon Bakhtiar A', 'tgl_lahir' => '2022-04-29', 'umur_thn' => 3, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Khoiru Nisa Risma J', 'bb' => 92.5, 'tb' => 13.7, 'lila' => 15, 'lk' => 49.5, 'status' => 'B'],
            ['nama' => 'Arletta Almashira', 'tgl_lahir' => '2022-06-16', 'umur_thn' => 3, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Damayanti', 'bb' => 86.7, 'tb' => 10.6, 'lila' => 14.5, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Ahmad Raiyan Alfarizky', 'tgl_lahir' => '2022-07-29', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Fitri Andriani', 'bb' => 88, 'tb' => 10.4, 'lila' => 15, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Ahmad Zaiyan Malik I', 'tgl_lahir' => '2022-12-14', 'umur_thn' => 2, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Siti Nuraini', 'bb' => 87, 'tb' => 11, 'lila' => 14, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Reva Kahiyang Janaia', 'tgl_lahir' => '2023-01-03', 'umur_thn' => 2, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Wiwik Haryanti', 'bb' => 89.9, 'tb' => 11.6, 'lila' => 14, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Bryantara Ikbal S', 'tgl_lahir' => '2023-01-06', 'umur_thn' => 2, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Anik Wahyuni', 'bb' => 78, 'tb' => 8, 'lila' => 12.5, 'lk' => 46.5, 'status' => 'BGM'],
            ['nama' => 'Gavin Putra Pratama', 'tgl_lahir' => '2023-02-19', 'umur_thn' => 2, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Ramyati', 'bb' => 84, 'tb' => 10.5, 'lila' => 15.5, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Kayla Azahra Putri', 'tgl_lahir' => '2023-03-14', 'umur_thn' => 2, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Indah Sri Wahyuni', 'bb' => 80, 'tb' => 13.6, 'lila' => 17.5, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Aqeela Numa Najwa', 'tgl_lahir' => '2023-04-14', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Kasriatun', 'bb' => 82.5, 'tb' => 10.8, 'lila' => 14.5, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Kaila Sherly Shifa Bella', 'tgl_lahir' => '2023-06-04', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Sutisna Peni', 'bb' => 80.5, 'tb' => 9, 'lila' => 14, 'lk' => 44.5, 'status' => 'KR'],
            ['nama' => 'Mawar Nawang Wulan', 'tgl_lahir' => '2023-06-14', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Boinah', 'bb' => 83.3, 'tb' => 10.5, 'lila' => 15, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Metati Nawang Wulan', 'tgl_lahir' => '2023-06-30', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Umi Miftakhul K', 'bb' => 79, 'tb' => 9.3, 'lila' => 14, 'lk' => 44.5, 'status' => 'B'],
            ['nama' => 'Andrean Gian Hazard P', 'tgl_lahir' => '2023-07-09', 'umur_thn' => 2, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Siti Khoiriyah', 'bb' => 80, 'tb' => 9.3, 'lila' => 14, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ishara Yumna Malika', 'tgl_lahir' => '2023-09-21', 'umur_thn' => 1, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Nur Hayati Fitri Devi', 'bb' => 83.5, 'tb' => 10.5, 'lila' => 14, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Ganang Manggilih', 'tgl_lahir' => '2023-09-24', 'umur_thn' => 1, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Maya Indri Afsari', 'bb' => 81, 'tb' => 10.6, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Faris Zahrani', 'tgl_lahir' => '2024-02-09', 'umur_thn' => 1, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Puji Lestari', 'bb' => 83, 'tb' => 10.3, 'lila' => 15, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Calista Balqis Ramadhani', 'tgl_lahir' => '2024-03-01', 'umur_thn' => 1, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Siti Zulaikhah', 'bb' => 77, 'tb' => 8, 'lila' => 14, 'lk' => 45, 'status' => 'KR'],
            ['nama' => 'Ahmad Rayhan Anugrah', 'tgl_lahir' => '2024-03-24', 'umur_thn' => 1, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Puput Erna P', 'bb' => 78, 'tb' => 8.7, 'lila' => 15, 'lk' => 44.5, 'status' => 'B'],
            ['nama' => 'Ahmad Bryan Alvian', 'tgl_lahir' => '2024-04-22', 'umur_thn' => 1, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Siti Fatimah', 'bb' => 76, 'tb' => 10.1, 'lila' => 16, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ananda Farela Prasetya', 'tgl_lahir' => '2024-06-26', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Sri Andayani', 'bb' => 80, 'tb' => 10.8, 'lila' => 16.5, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Ahmad Raynza Farid Elvano', 'tgl_lahir' => '2024-06-28', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Siti Riyanti', 'bb' => 74, 'tb' => 8.2, 'lila' => 14.5, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ahmad Arhan Adiyatma', 'tgl_lahir' => '2024-09-18', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Sulastri', 'bb' => 71.5, 'tb' => 8.5, 'lila' => 15, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Nathan Narendra Putra', 'tgl_lahir' => '2024-09-14', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Sulaswati', 'bb' => 75.5, 'tb' => 10.9, 'lila' => 18, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Rifki Rahmad Prawira', 'tgl_lahir' => '2024-11-28', 'umur_thn' => 0, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Denik Maryuni', 'bb' => 68, 'tb' => 7.3, 'lila' => 14, 'lk' => 43, 'status' => 'B'],
            ['nama' => 'Hanindya Ayu Arsyila', 'tgl_lahir' => '2025-03-27', 'umur_thn' => 0, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Dewi Ristiyana', 'bb' => 65, 'tb' => 6.8, 'lila' => null, 'lk' => 41, 'status' => 'B'],
            ['nama' => 'Al Shaki Avriel Adhinatha', 'tgl_lahir' => '2025-04-24', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Widyawati Tisam Sari', 'bb' => 87, 'tb' => 10.3, 'lila' => 20, 'lk' => 43, 'status' => 'B'],
            ['nama' => 'Hanindya Aruna Aprilia J', 'tgl_lahir' => '2025-04-24', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Dewi Tiam Sari', 'bb' => 62.5, 'tb' => 5.3, 'lila' => null, 'lk' => 40, 'status' => 'B'],
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
                'desa' => 'Payasan', // Set desa ke Payasan
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
