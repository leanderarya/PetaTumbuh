<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DumpilDuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data anak dari Dusun Dumpil 2
        $anakData = [
            ['nama' => 'Salma Gendis Syanila', 'tgl_lahir' => '2020-08-24', 'umur_thn' => 4, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Ahmad Muslih Dian P, Ulfa N', 'tb' => 100, 'bb' => 15.4, 'lila' => 18, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Faizan Jazib Abqori', 'tgl_lahir' => '2020-08-01', 'umur_thn' => 4, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Yanito, Miftakhurrohmah', 'tb' => 107.5, 'bb' => 16.5, 'lila' => 19, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Ahmad Arkha Althafira', 'tgl_lahir' => '2020-08-24', 'umur_thn' => 4, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Muhamad Soni, Naning W', 'tb' => 113, 'bb' => 20.1, 'lila' => 19, 'lk' => 52, 'status' => 'B'],
            ['nama' => 'Bilfaqih Jonathan Haniframa', 'tgl_lahir' => '2020-11-02', 'umur_thn' => 4, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Edi Cahyono, Nur hidayati', 'tb' => 102, 'bb' => 15.3, 'lila' => 19, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Ismes Salsya Purnomo', 'tgl_lahir' => '2020-11-10', 'umur_thn' => 4, 'umur_bln' => 8, 'jk' => 'P', 'nama_ortu' => 'Ahmad Purnomo, Hena Nur H', 'tb' => 94, 'bb' => 13.5, 'lila' => 18, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Jauzan Azkano', 'tgl_lahir' => '2020-12-13', 'umur_thn' => 4, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Mujamil, Mika Kristiyawati', 'tb' => 101, 'bb' => 14.7, 'lila' => 14.5, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Ahmad Khairul Abqory', 'tgl_lahir' => '2020-12-15', 'umur_thn' => 4, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Lilik Pujiati, Faidhotul I', 'tb' => 105, 'bb' => 16.8, 'lila' => 17, 'lk' => 49.5, 'status' => 'B'],
            ['nama' => 'Ayra Khairani Aryanti', 'tgl_lahir' => '2021-01-11', 'umur_thn' => 4, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Yuli Kristiyanto', 'tb' => 94, 'bb' => 13, 'lila' => 17, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Tristyan Khairil Nareswara', 'tgl_lahir' => '2021-02-26', 'umur_thn' => 4, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Eko Kristanto, Titik Ernawati', 'tb' => 98, 'bb' => 13.6, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Ghania Humaira', 'tgl_lahir' => '2021-07-14', 'umur_thn' => 4, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Suyanto, Kasriyati', 'tb' => 94.5, 'bb' => 12.2, 'lila' => 15, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Erina Salwa Yumnara', 'tgl_lahir' => '2021-08-05', 'umur_thn' => 3, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Joko Saryono, Zanik Dai A', 'tb' => 91.7, 'bb' => 11.2, 'lila' => 16, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Ghaitsa Agustina Pasca', 'tgl_lahir' => '2021-08-07', 'umur_thn' => 3, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Muh Indra Mulyadi, Kasmiyati', 'tb' => 93.5, 'bb' => 13.4, 'lila' => 17, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Mirzano Rama Septiawan', 'tgl_lahir' => '2021-09-02', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Maryono, Dian Oktavitasari', 'tb' => 90, 'bb' => 11.8, 'lila' => 16, 'lk' => 51, 'status' => 'B'],
            ['nama' => 'Alfathiraz Rezky Akbar', 'tgl_lahir' => '2021-09-18', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Arif Mardiyono, Muryanti', 'tb' => 96, 'bb' => 13, 'lila' => 18, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Kinanti Nur Aini', 'tgl_lahir' => '2021-11-26', 'umur_thn' => 3, 'umur_bln' => 8, 'jk' => 'P', 'nama_ortu' => 'Purwanti', 'tb' => 93, 'bb' => 13.2, 'lila' => 18, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Febrian Rasyid Alfarizqi', 'tgl_lahir' => '2021-12-28', 'umur_thn' => 3, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Lipta Novita Sari', 'tb' => 98, 'bb' => 14.1, 'lila' => 17, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Muhammad Abizar Alfarizi R', 'tgl_lahir' => '2022-02-28', 'umur_thn' => 3, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Siti Nur Choiriyah', 'tb' => 99, 'bb' => 12, 'lila' => 17, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Akyan Rayyan Rafasya Hadi', 'tgl_lahir' => '2022-05-17', 'umur_thn' => 3, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Murtiningsih', 'tb' => 95, 'bb' => 15.8, 'lila' => 20, 'lk' => 52, 'status' => 'B'],
            ['nama' => 'Ahmad Arsya Putra P', 'tgl_lahir' => '2022-06-13', 'umur_thn' => 3, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Siti Zahrotun Naviah', 'tb' => 85.5, 'bb' => 9.3, 'lila' => 16, 'lk' => 45, 'status' => 'BGM'],
            ['nama' => 'Devanka Ali Putra P', 'tgl_lahir' => '2022-07-12', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Sri Dewi Purwati', 'tb' => 89, 'bb' => 11.3, 'lila' => 17, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Kamaliyat Hibrizi Alfarazi', 'tgl_lahir' => '2022-07-16', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Sely Cahyawati', 'tb' => 92.2, 'bb' => 14.5, 'lila' => 20, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Zalina Arumi Hanum Syarif', 'tgl_lahir' => '2022-09-25', 'umur_thn' => 2, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Pricelia Wulandari', 'tb' => 88, 'bb' => 10, 'lila' => 16, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Ahmad Radiv Irfandi', 'tgl_lahir' => '2022-11-02', 'umur_thn' => 2, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Yanti', 'tb' => 90.5, 'bb' => 12.5, 'lila' => 18, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Caka Raditya Arfadhi', 'tgl_lahir' => '2022-12-14', 'umur_thn' => 2, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Sofiana Romadona', 'tb' => 95.5, 'bb' => 19.3, 'lila' => 22, 'lk' => 49, 'status' => 'OB'],
            ['nama' => 'Khalisa Rafania Ramadhani', 'tgl_lahir' => '2023-03-30', 'umur_thn' => 2, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Yuliana Indah Safitri', 'tb' => 80.5, 'bb' => 8.9, 'lila' => 15, 'lk' => 45, 'status' => 'KR'],
            ['nama' => 'Gyaneswar Uwais Shankara', 'tgl_lahir' => '2023-04-03', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Gian Amelia', 'tb' => 87, 'bb' => 10.5, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Zalina Erina Fathon', 'tgl_lahir' => '2023-04-12', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Siti Muanisah', 'tb' => 81, 'bb' => 8.9, 'lila' => 15, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Azka Gibran Alfarizqi', 'tgl_lahir' => '2023-04-28', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Rohmad', 'tb' => 93.5, 'bb' => 16.8, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Latif Gibran Alfarizqi', 'tgl_lahir' => '2023-04-28', 'umur_thn' => 2, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Chiyatul Mubasiroh', 'tb' => 75.5, 'bb' => 8.7, 'lila' => 16, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Daffa Izzudin Husain', 'tgl_lahir' => '2023-08-07', 'umur_thn' => 1, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Siti Indahsari', 'tb' => 89, 'bb' => 12, 'lila' => 18, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Callista Azzahra Agustina', 'tgl_lahir' => '2023-08-22', 'umur_thn' => 1, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Sofiana Nur Zubaidah', 'tb' => 83, 'bb' => 11.3, 'lila' => 14.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Dewi Candra Kirana', 'tgl_lahir' => '2023-09-12', 'umur_thn' => 1, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Sumiyem', 'tb' => 80, 'bb' => 12, 'lila' => 16, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Izzam Lizam Ahmad Alawi', 'tgl_lahir' => '2023-09-25', 'umur_thn' => 1, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Khoirun Nisa', 'tb' => 78, 'bb' => 8.8, 'lila' => 16, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Affiya Maharani', 'tgl_lahir' => '2024-01-08', 'umur_thn' => 1, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Ismawati', 'tb' => 78, 'bb' => 9.7, 'lila' => 17, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Shidqia Ainur Rohmah', 'tgl_lahir' => '2024-01-08', 'umur_thn' => 1, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Ismawati', 'tb' => 77, 'bb' => 8.1, 'lila' => 16, 'lk' => 44, 'status' => 'KR'],
            ['nama' => 'Muhammad Abdizar Al G', 'tgl_lahir' => '2024-01-17', 'umur_thn' => 1, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Puji Wulandari', 'tb' => 79.1, 'bb' => 10, 'lila' => 18, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Akmal Fauzi Ramadhan', 'tgl_lahir' => '2024-01-17', 'umur_thn' => 1, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Siti Ulfiah', 'tb' => 79.5, 'bb' => 9.7, 'lila' => 16, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Paras Rakha Sholichat', 'tgl_lahir' => '2024-02-02', 'umur_thn' => 1, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Ufi Solekah Fita Nursanti', 'tb' => 74, 'bb' => 7.9, 'lila' => 16, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Ahmad Arsyana Ramadhan D', 'tgl_lahir' => '2024-04-09', 'umur_thn' => 1, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Siti Maimunah', 'tb' => 75, 'bb' => 10.5, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Waffa Dzakira Azzafea', 'tgl_lahir' => '2024-06-03', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Ika Wijayanti', 'tb' => 73, 'bb' => 8.1, 'lila' => 17, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Azura Aqila Saputri', 'tgl_lahir' => '2024-06-10', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Junis', 'tb' => 75, 'bb' => 8.6, 'lila' => 17, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Vania Amalina Mafaza', 'tgl_lahir' => '2024-06-11', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Wijanti', 'tb' => 72, 'bb' => 7.3, 'lila' => 16, 'lk' => 43, 'status' => 'B'],
            ['nama' => 'Ahmad Aidan Raffasya', 'tgl_lahir' => '2024-06-13', 'umur_thn' => 1, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Bela Kurniawati', 'tb' => 74, 'bb' => 7.8, 'lila' => 18, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Sayidan Danish Zulfikar', 'tgl_lahir' => '2024-07-07', 'umur_thn' => 1, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Sri Dwi Asih', 'tb' => 74, 'bb' => 7.8, 'lila' => 16, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Reynard Arjuno Arza Acello', 'tgl_lahir' => '2024-07-27', 'umur_thn' => 1, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Rita Vitriyaningsih', 'tb' => 74, 'bb' => 8.4, 'lila' => 17, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Ahmad Ghaisan Alfaris', 'tgl_lahir' => '2024-07-30', 'umur_thn' => 1, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Nurgiana', 'tb' => 74, 'bb' => 9.4, 'lila' => 18, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Farenza Arkatama Wardani', 'tgl_lahir' => '2024-08-19', 'umur_thn' => 0, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Fillarotun Nur Rohmah', 'tb' => 73, 'bb' => 9.5, 'lila' => 14, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Adira Zafira Agustina', 'tgl_lahir' => '2024-08-19', 'umur_thn' => 0, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Ike Lima Mubakiro', 'tb' => 68, 'bb' => 6.9, 'lila' => 15, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Argantara Madya Septa', 'tgl_lahir' => '2024-09-13', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Siti Khotimah/Suhartanto', 'tb' => 67, 'bb' => 8, 'lila' => 17, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Aliea Shanum Al Mahyra', 'tgl_lahir' => '2024-09-14', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Dea Marlinda/Ebi', 'tb' => 71, 'bb' => 7.3, 'lila' => 16, 'lk' => 43, 'status' => 'B'],
            ['nama' => 'Ahmad Andika Baskara', 'tgl_lahir' => '2024-12-07', 'umur_thn' => 0, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Rusna Isti Komariah', 'tb' => 73, 'bb' => 7.5, 'lila' => 17, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Destala Erito Arganta', 'tgl_lahir' => '2024-12-16', 'umur_thn' => 0, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Ira Ristiana', 'tb' => 68, 'bb' => 7.6, 'lila' => 18, 'lk' => 44.5, 'status' => 'B'],
            ['nama' => 'Kenzio Arhan Gevandra', 'tgl_lahir' => '2025-01-10', 'umur_thn' => 0, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Siti Patimah', 'tb' => 69.5, 'bb' => 9.7, 'lila' => 19, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Laticia Permata Jelita', 'tgl_lahir' => '2025-01-21', 'umur_thn' => 0, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Ani Julita', 'tb' => 65, 'bb' => 7.2, 'lila' => null, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Grecya Elshanum Putri Wibowo', 'tgl_lahir' => '2025-02-28', 'umur_thn' => 0, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Jati Viki Arsanti', 'tb' => 59, 'bb' => 5.3, 'lila' => null, 'lk' => 39, 'status' => 'KR'],
            ['nama' => 'Zioshaka Keenari Ichiro S.M', 'tgl_lahir' => '2025-01-17', 'umur_thn' => 0, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Zumi Agustina', 'tb' => 61, 'bb' => 5.2, 'lila' => null, 'lk' => 39, 'status' => 'KR'],
            ['nama' => 'Alifia Agnez Ghea Gefanda', 'tgl_lahir' => '2025-04-29', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'P', 'nama_ortu' => 'Finanda', 'tb' => 58.4, 'bb' => 4.9, 'lila' => null, 'lk' => 37, 'status' => 'B'],
            ['nama' => 'Arganta Gala Respati', 'tgl_lahir' => '2025-05-01', 'umur_thn' => 0, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Suparmi', 'tb' => 60, 'bb' => 5, 'lila' => null, 'lk' => 37, 'status' => 'B'],
            ['nama' => 'Sienna Malika Dresanala', 'tgl_lahir' => '2025-05-13', 'umur_thn' => 0, 'umur_bln' => 2, 'jk' => 'P', 'nama_ortu' => 'Sumarsih', 'tb' => 53, 'bb' => 4.3, 'lila' => null, 'lk' => 36, 'status' => 'B'],
        ];

        // Pemetaan status gizi
        $statusMapping = [
            'B' => 'Baik',
            'KR' => 'Kurang',
            'BGM' => 'Bawah Garis Merah',
            'OB' => 'Obesitas',
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
                'desa' => 'Dumpil 2', // Set desa ke Dumpil 2
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
