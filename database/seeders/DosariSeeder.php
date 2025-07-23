<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DosariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data anak dari Dusun Dosari
        $anakData = [
            ['nama' => 'Amanda Yulvika Maheswari', 'tgl_lahir' => '2020-07-05', 'umur_thn' => 5, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Supriyanto, Rini', 'tb' => 103.2, 'bb' => 19.2, 'lila' => 21, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Rendra Sayhan Fathlani', 'tgl_lahir' => '2020-10-02', 'umur_thn' => 4, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Sutikno, Siti Munawaroh', 'tb' => 98, 'bb' => 14.2, 'lila' => 18, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Viola Shezan Mecca Q', 'tgl_lahir' => '2020-10-15', 'umur_thn' => 4, 'umur_bln' => 9, 'jk' => 'P', 'nama_ortu' => 'Edi Saputra, Faidhotul I', 'tb' => 98, 'bb' => 14, 'lila' => 18, 'lk' => 47.5, 'status' => 'B'],
            ['nama' => 'Felecia Ananda Saputri', 'tgl_lahir' => '2021-02-08', 'umur_thn' => 4, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Kasmi', 'tb' => 97, 'bb' => 16, 'lila' => 20, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Kirania Nur Fadhilah', 'tgl_lahir' => '2021-12-23', 'umur_thn' => 3, 'umur_bln' => 7, 'jk' => 'P', 'nama_ortu' => 'Risnawati', 'tb' => 93.5, 'bb' => 11.7, 'lila' => 17, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Deina Nadifa Ayu Razita', 'tgl_lahir' => '2022-06-23', 'umur_thn' => 3, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Sugihartiningsih', 'tb' => 93, 'bb' => 12.2, 'lila' => 16, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Ahmad Arshaka Agustian', 'tgl_lahir' => '2022-08-19', 'umur_thn' => 2, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Lilik Pujiati', 'tb' => 84, 'bb' => 10.9, 'lila' => 16, 'lk' => 50, 'status' => 'KR'],
            ['nama' => 'Najwa Alviana Azzahra', 'tgl_lahir' => '2023-01-29', 'umur_thn' => 2, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Ambarwati', 'tb' => 80, 'bb' => 10.7, 'lila' => 16, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Azkiya Nadifa Almaira', 'tgl_lahir' => '2023-03-11', 'umur_thn' => 2, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Jarminik', 'tb' => 83, 'bb' => 10.8, 'lila' => 17, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Muhammad Farhan Pranaja', 'tgl_lahir' => '2023-04-25', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Diana Lofiyani', 'tb' => 84, 'bb' => 11.2, 'lila' => 17, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Najwa Zahra Salsabila', 'tgl_lahir' => '2023-04-25', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Ririh Nofitasari', 'tb' => 83, 'bb' => 10.8, 'lila' => 17, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Muhammad Sulthonul I', 'tgl_lahir' => '2023-06-14', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Pritananda Sari', 'tb' => 83, 'bb' => 9.4, 'lila' => 15.5, 'lk' => 45, 'status' => 'KR'],
            ['nama' => 'Jesika Anggraeni', 'tgl_lahir' => '2024-01-02', 'umur_thn' => 1, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Suti', 'tb' => 80, 'bb' => 10.8, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Aulia Hilyatun Naimah', 'tgl_lahir' => '2024-01-13', 'umur_thn' => 1, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Ufi Mubayanah', 'tb' => 80, 'bb' => 11.2, 'lila' => 17.5, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Ataliya Maharani', 'tgl_lahir' => '2024-07-01', 'umur_thn' => 1, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Puji', 'tb' => 70, 'bb' => 8.1, 'lila' => 16, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Muhammad Rayyan Al Fatih', 'tgl_lahir' => '2024-07-02', 'umur_thn' => 1, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Sholihah', 'tb' => 77, 'bb' => 9.5, 'lila' => 17, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Muhammad Khoirul Al Farizi', 'tgl_lahir' => '2025-03-31', 'umur_thn' => 0, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Fitriningsih', 'tb' => 62, 'bb' => 6.4, 'lila' => null, 'lk' => 40, 'status' => 'B'],
            ['nama' => 'Alghaisan Hafiz Thabrani', 'tgl_lahir' => '2025-04-25', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Devi Risnawati', 'tb' => 62, 'bb' => 6.3, 'lila' => null, 'lk' => 39, 'status' => 'B'],
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
                'desa' => 'Dosari', // Set desa ke Dosari
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
