<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Child;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DumpilSatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data anak dari Dusun Dumpil 1
$anakData = [
            ['nama' => 'Revako Nizam Al Farizi', 'tgl_lahir' => '2020-07-21', 'umur_thn' => 4, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Hadi Suwiknyo, Solekah', 'tb' => 98.4, 'bb' => 14.4, 'lila' => 15.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Jeviko Calista Putri', 'tgl_lahir' => '2020-09-05', 'umur_thn' => 4, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Akhmad Aris, A. Mufaroh', 'tb' => 101.5, 'bb' => 18.7, 'lila' => 19.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Kharisma Zulia Aulia', 'tgl_lahir' => '2020-09-13', 'umur_thn' => 4, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Muhamad Nur Kholis, Titik Nur', 'tb' => 101, 'bb' => 15.9, 'lila' => 18, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Fadlan Muhbir Al Khalifi', 'tgl_lahir' => '2020-12-15', 'umur_thn' => 4, 'umur_bln' => 7, 'jk' => 'P', 'nama_ortu' => 'Nur Solikin, Sri Nur Indayati', 'tb' => 105, 'bb' => 15.7, 'lila' => 16, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Ahmad Subhan Faqih Fatih', 'tgl_lahir' => '2021-01-26', 'umur_thn' => 4, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Eko Purwanto, Puji Astuti', 'tb' => 99, 'bb' => 14.8, 'lila' => 15.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Nabila Nazhan Kisha Kirana P', 'tgl_lahir' => '2021-02-10', 'umur_thn' => 4, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Muhtarom, Sri Puji Astuti', 'tb' => 101, 'bb' => 14.7, 'lila' => 16, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Adelia Fia Fatunisa', 'tgl_lahir' => '2021-02-11', 'umur_thn' => 4, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Sutiyo, Sulastri', 'tb' => 96, 'bb' => 14.5, 'lila' => 18, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Zalfa Uli Abshor', 'tgl_lahir' => '2021-02-27', 'umur_thn' => 4, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Ahmad Basori, Umi Kholifah', 'tb' => 96.5, 'bb' => 13, 'lila' => 16, 'lk' => 50, 'status' => 'B'],
            ['nama' => 'Al Syadad Syifaudin Maryanto', 'tgl_lahir' => '2021-03-07', 'umur_thn' => 4, 'umur_bln' => 4, 'jk' => 'L', 'nama_ortu' => 'Lestanto, Putri Safitri C', 'tb' => 106, 'bb' => 15.8, 'lila' => 16, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Anezka Ristati Jannah', 'tgl_lahir' => '2021-03-14', 'umur_thn' => 4, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Akhmad Rifa, Eka Sri M', 'tb' => 103, 'bb' => 14.8, 'lila' => 16, 'lk' => 51, 'status' => 'B'],
            ['nama' => 'Nuna Lail Mufliha', 'tgl_lahir' => '2021-03-24', 'umur_thn' => 4, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Muntahar, Siti Fatimah', 'tb' => 105, 'bb' => 16.3, 'lila' => 17.5, 'lk' => 51, 'status' => 'B'],
            ['nama' => 'Rayan Dzian Adhitama', 'tgl_lahir' => '2021-04-04', 'umur_thn' => 4, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Nika Andriani', 'tb' => 96.5, 'bb' => 13, 'lila' => 15, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Arhan Rayhur Rohmad', 'tgl_lahir' => '2021-04-05', 'umur_thn' => 4, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Jasman, Larasati', 'tb' => 94.5, 'bb' => 15, 'lila' => 16.5, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Aqila Keisya Almahyra', 'tgl_lahir' => '2021-05-01', 'umur_thn' => 4, 'umur_bln' => 2, 'jk' => 'P', 'nama_ortu' => 'Kusnan Sg, Edenia Ernia', 'tb' => 98, 'bb' => 13.7, 'lila' => 16, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Muhammad Mahrez B', 'tgl_lahir' => '2021-07-07', 'umur_thn' => 4, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Riyan Ifitakhul J', 'tb' => 104.5, 'bb' => 16.8, 'lila' => 15.5, 'lk' => 51, 'status' => 'B'],
            ['nama' => 'Bening Zillal Anashia', 'tgl_lahir' => '2021-08-04', 'umur_thn' => 3, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Mohamad Yussunu, Linda Siska', 'tb' => 90, 'bb' => 11, 'lila' => 15, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Qiana Hasna Wahyuningsias', 'tgl_lahir' => '2021-09-06', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Danang Sugiharto, Madawati', 'tb' => 96.5, 'bb' => 13, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Nadhirrizky Abdizar', 'tgl_lahir' => '2021-09-28', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Andib Syaifudin, Niken Ayu P', 'tb' => 88, 'bb' => 11.5, 'lila' => 15.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Ahmad Gibran', 'tgl_lahir' => '2021-09-30', 'umur_thn' => 3, 'umur_bln' => 10, 'jk' => 'L', 'nama_ortu' => 'Cipto Haryanto, Sudarti', 'tb' => 93, 'bb' => 12.9, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Muhammad Naufal Genzie A', 'tgl_lahir' => '2021-10-08', 'umur_thn' => 3, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Arifin, Sri Erna Melati', 'tb' => 91.7, 'bb' => 11, 'lila' => 14.5, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Reyhan Azriel Wijanarko', 'tgl_lahir' => '2021-10-22', 'umur_thn' => 3, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Zulia Ari W, Ela Wulandari', 'tb' => 97, 'bb' => 13.7, 'lila' => 17, 'lk' => 48.5, 'status' => 'B'],
            ['nama' => 'Valencia Maulida', 'tgl_lahir' => '2021-10-22', 'umur_thn' => 3, 'umur_bln' => 9, 'jk' => 'P', 'nama_ortu' => 'Mochamad Soleh, Sulasih', 'tb' => 83.5, 'bb' => 9.8, 'lila' => 14, 'lk' => 48, 'status' => 'BGM'],
            ['nama' => 'Ahmad Haikal Nur Kholish', 'tgl_lahir' => '2021-11-04', 'umur_thn' => 3, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Dwi Puspitasari', 'tb' => 88, 'bb' => 11.4, 'lila' => 15, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Ahmad Fikri Nurul Huda', 'tgl_lahir' => '2021-11-11', 'umur_thn' => 3, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Dwi Purwatiningsih', 'tb' => 95, 'bb' => 13.4, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Arfan Ahnaf Maulana', 'tgl_lahir' => '2021-11-29', 'umur_thn' => 3, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Narso Saropah', 'tb' => 91.5, 'bb' => 12.3, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Callysta Celstya Desidra', 'tgl_lahir' => '2021-12-11', 'umur_thn' => 3, 'umur_bln' => 7, 'jk' => 'P', 'nama_ortu' => 'Ramah Oktaviana', 'tb' => 90, 'bb' => 11.8, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Dzakya Zain', 'tgl_lahir' => '2022-01-03', 'umur_thn' => 3, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Nurul Laili N', 'tb' => 92.7, 'bb' => 11.6, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Azril Arrifqi', 'tgl_lahir' => '2022-01-09', 'umur_thn' => 3, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Mutmainatul Kholimah', 'tb' => 90.8, 'bb' => 10.7, 'lila' => 14, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Raditya Rahayu', 'tgl_lahir' => '2022-02-19', 'umur_thn' => 3, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Mindarsih', 'tb' => 94, 'bb' => 12.8, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Muhammad Galuh Arasya', 'tgl_lahir' => '2022-02-21', 'umur_thn' => 3, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Reni Puspitasari', 'tb' => 100, 'bb' => 15.4, 'lila' => 16.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Aisha Rakyra Almahira', 'tgl_lahir' => '2022-03-30', 'umur_thn' => 3, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Siti Saadah', 'tb' => 94.5, 'bb' => 13.4, 'lila' => 17, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Afino Ardiansyah', 'tgl_lahir' => '2022-04-18', 'umur_thn' => 3, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Sri Jarwani', 'tb' => 93, 'bb' => 11.6, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Zafa Nuria Rahma', 'tgl_lahir' => '2022-06-28', 'umur_thn' => 3, 'umur_bln' => 1, 'jk' => 'P', 'nama_ortu' => 'Indah Riyaningsih', 'tb' => 89, 'bb' => 11.3, 'lila' => 16, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Anindya Arumi Fauziah', 'tgl_lahir' => '2022-07-04', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Rohman Sofiana', 'tb' => 90.9, 'bb' => 12.2, 'lila' => 15, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Arwan Dylan Alfarizki', 'tgl_lahir' => '2022-07-06', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Dewi Setiyaningsih', 'tb' => 93, 'bb' => 12.8, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Galvin Ardean Restu Pratama', 'tgl_lahir' => '2022-07-06', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Linasih', 'tb' => 84.5, 'bb' => 10, 'lila' => 14, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Ahmad Fauzan', 'tgl_lahir' => '2022-07-29', 'umur_thn' => 3, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Alya Ardana Wijayanti', 'tb' => 88, 'bb' => 12, 'lila' => 16, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Niko Anggara', 'tgl_lahir' => '2022-08-01', 'umur_thn' => 2, 'umur_bln' => 11, 'jk' => 'L', 'nama_ortu' => 'Intan Sari', 'tb' => 94, 'bb' => 12.6, 'lila' => 14, 'lk' => 49, 'status' => 'B'],
            ['nama' => 'Shaza Anjar Hafizah', 'tgl_lahir' => '2022-08-11', 'umur_thn' => 2, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Rita Fitri Lestari', 'tb' => 92.5, 'bb' => 14.4, 'lila' => 16, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Calista Balqis Maharani', 'tgl_lahir' => '2022-08-24', 'umur_thn' => 2, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Tsalisah Nadroh', 'tb' => 87.2, 'bb' => 11.4, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Sheryl Allea Ovanda', 'tgl_lahir' => '2023-01-09', 'umur_thn' => 2, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Dwi Purwanti', 'tb' => 87.3, 'bb' => 9.9, 'lila' => 13.5, 'lk' => 47, 'status' => 'KR'],
            ['nama' => 'Shaqueel Alzeva Ovanda', 'tgl_lahir' => '2023-01-24', 'umur_thn' => 2, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Artati Kristiana', 'tb' => 85.6, 'bb' => 10.4, 'lila' => 14, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Danindra Anindyaswari', 'tgl_lahir' => '2023-01-21', 'umur_thn' => 2, 'umur_bln' => 6, 'jk' => 'P', 'nama_ortu' => 'Puji Rahayu', 'tb' => 87.5, 'bb' => 11, 'lila' => 15.5, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Mikayla Izura', 'tgl_lahir' => '2023-03-16', 'umur_thn' => 2, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Anis Sholikhah', 'tb' => 85.5, 'bb' => 11, 'lila' => 15, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Pangayu Enzi Rania', 'tgl_lahir' => '2023-05-06', 'umur_thn' => 2, 'umur_bln' => 2, 'jk' => 'P', 'nama_ortu' => 'Siti Nur Rahayu', 'tb' => 83.5, 'bb' => 12.4, 'lila' => 17, 'lk' => 45.5, 'status' => 'B'],
            ['nama' => 'Erzhan Aksa Darellano', 'tgl_lahir' => '2023-05-17', 'umur_thn' => 2, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Novia Ika Safitri', 'tb' => 78, 'bb' => 9.2, 'lila' => 14, 'lk' => 48, 'status' => 'KR'],
            ['nama' => 'Alwi Assadad', 'tgl_lahir' => '2023-05-22', 'umur_thn' => 2, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Rika Tantriana', 'tb' => 87, 'bb' => 10.3, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Anzelino Harta Abbas Lubawi', 'tgl_lahir' => '2023-06-02', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Nanik Itaningrum', 'tb' => 82, 'bb' => 10.3, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Gevari Zio Kurniawan', 'tgl_lahir' => '2023-06-03', 'umur_thn' => 2, 'umur_bln' => 1, 'jk' => 'L', 'nama_ortu' => 'Siti Wahyuni', 'tb' => 83.7, 'bb' => 10.9, 'lila' => 15, 'lk' => 48, 'status' => 'B'],
            ['nama' => 'Gelar Awang Arshagita', 'tgl_lahir' => '2023-07-25', 'umur_thn' => 2, 'umur_bln' => 0, 'jk' => 'L', 'nama_ortu' => 'Eli Nur Daningsih', 'tb' => 78.5, 'bb' => 8.8, 'lila' => 14, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Ahmad Arzan Atharrazka', 'tgl_lahir' => '2023-10-31', 'umur_thn' => 1, 'umur_bln' => 9, 'jk' => 'L', 'nama_ortu' => 'Ita Indah Cahyawati', 'tb' => 78, 'bb' => 9.6, 'lila' => 16, 'lk' => 46, 'status' => 'B'],
            ['nama' => 'Kelvin Novaldy Riswanda', 'tgl_lahir' => '2023-11-10', 'umur_thn' => 1, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Dina', 'tb' => 80, 'bb' => 11.5, 'lila' => 17, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Muhammad Ibrahim Ajazuli', 'tgl_lahir' => '2023-12-05', 'umur_thn' => 1, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Putri Dewanti', 'tb' => 83.5, 'bb' => 11.7, 'lila' => 19, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Narendra Ghifari Prayoga', 'tgl_lahir' => '2023-12-11', 'umur_thn' => 1, 'umur_bln' => 7, 'jk' => 'L', 'nama_ortu' => 'Luluk Ulul Azmi', 'tb' => 80, 'bb' => 8.7, 'lila' => 12, 'lk' => 46, 'status' => 'KR'],
            ['nama' => 'Jelena Mehru Andalusia', 'tgl_lahir' => '2023-12-18', 'umur_thn' => 1, 'umur_bln' => 7, 'jk' => 'P', 'nama_ortu' => 'Danang Srihandoko, Siti Saropah', 'tb' => 75, 'bb' => 9.4, 'lila' => 15.5, 'lk' => 43, 'status' => 'B'],
            ['nama' => 'Ahmad Arkan Rianto', 'tgl_lahir' => '2024-05-27', 'umur_thn' => 1, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Asa Seftiani', 'tb' => 74, 'bb' => 8.4, 'lila' => 15, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Ayumna Fazeela Tia Arshinta', 'tgl_lahir' => '2024-07-31', 'umur_thn' => 1, 'umur_bln' => 0, 'jk' => 'P', 'nama_ortu' => 'Hana Wijanti', 'tb' => 75, 'bb' => 8.7, 'lila' => 14.5, 'lk' => 45, 'status' => 'B'],
            ['nama' => 'Keymora Ajeng Maulida', 'tgl_lahir' => '2024-08-19', 'umur_thn' => 0, 'umur_bln' => 11, 'jk' => 'P', 'nama_ortu' => 'Suyanti', 'tb' => 72, 'bb' => 7.6, 'lila' => 14, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Alena Maulida Zahra', 'tgl_lahir' => '2024-09-20', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Umiatin, Joko Wiranto', 'tb' => 72, 'bb' => 9.6, 'lila' => 17, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Nadhira Sururi Hafidzah', 'tgl_lahir' => '2024-09-27', 'umur_thn' => 0, 'umur_bln' => 10, 'jk' => 'P', 'nama_ortu' => 'Dian Puspitasari, Ahmad Zaenal A', 'tb' => 67, 'bb' => 6.5, 'lila' => 13.5, 'lk' => 43, 'status' => 'KR'],
            ['nama' => 'Tania Oktaviana', 'tgl_lahir' => '2024-10-29', 'umur_thn' => 0, 'umur_bln' => 9, 'jk' => 'P', 'nama_ortu' => 'Tera Setyana, Ahmad Khasan', 'tb' => 66, 'bb' => 6.8, 'lila' => 16, 'lk' => 41, 'status' => 'B'],
            ['nama' => 'Agatha Kenzio Abhinara', 'tgl_lahir' => '2024-11-27', 'umur_thn' => 0, 'umur_bln' => 8, 'jk' => 'L', 'nama_ortu' => 'Ratnawati', 'tb' => 70, 'bb' => 8.6, 'lila' => 15, 'lk' => 47, 'status' => 'B'],
            ['nama' => 'Alhanan Gufron Elfattah', 'tgl_lahir' => '2025-01-11', 'umur_thn' => 0, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Eva Yuni Kurniasari', 'tb' => 70, 'bb' => 9.6, 'lila' => null, 'lk' => 44, 'status' => 'B'],
            ['nama' => 'Rizqon Adam Maulana', 'tgl_lahir' => '2025-01-28', 'umur_thn' => 0, 'umur_bln' => 6, 'jk' => 'L', 'nama_ortu' => 'Ica Lwisky Alvanita', 'tb' => 65, 'bb' => 6.6, 'lila' => null, 'lk' => 40, 'status' => 'B'],
            ['nama' => 'Alfath Zaidan Malik', 'tgl_lahir' => '2025-02-06', 'umur_thn' => 0, 'umur_bln' => 5, 'jk' => 'L', 'nama_ortu' => 'Nanik Sulamsih', 'tb' => 68, 'bb' => 7.5, 'lila' => null, 'lk' => 42, 'status' => 'B'],
            ['nama' => 'Maira Alfiatunnisa', 'tgl_lahir' => '2025-02-13', 'umur_thn' => 0, 'umur_bln' => 5, 'jk' => 'P', 'nama_ortu' => 'Veri Setiyawati', 'tb' => 65, 'bb' => 5.9, 'lila' => null, 'lk' => 41, 'status' => 'B'],
            ['nama' => 'Mirza Nirmala', 'tgl_lahir' => '2025-03-24', 'umur_thn' => 0, 'umur_bln' => 4, 'jk' => 'P', 'nama_ortu' => 'Lailatul Qomariah', 'tb' => 64, 'bb' => 6.1, 'lila' => null, 'lk' => 40, 'status' => 'B'],
            ['nama' => 'Zavian Diggo Kaeshan', 'tgl_lahir' => '2025-04-16', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Aida Nabila Husna', 'tb' => 61, 'bb' => 5.5, 'lila' => null, 'lk' => 38, 'status' => 'B'],
            ['nama' => 'Muhammad Maimun Affan', 'tgl_lahir' => '2025-04-18', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Anik Firmasari', 'tb' => 61, 'bb' => 6.1, 'lila' => null, 'lk' => 40, 'status' => 'B'],
            ['nama' => 'Nael Shakalingga Elyas N', 'tgl_lahir' => '2025-04-23', 'umur_thn' => 0, 'umur_bln' => 3, 'jk' => 'L', 'nama_ortu' => 'Novitasari', 'tb' => 64, 'bb' => 6.4, 'lila' => null, 'lk' => 39, 'status' => 'B'],
            ['nama' => 'Rafindra Azmi Pratama', 'tgl_lahir' => '2025-05-06', 'umur_thn' => 0, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Dea Yandri Tria', 'tb' => 59, 'bb' => 4.7, 'lila' => null, 'lk' => 39, 'status' => 'B'],
            ['nama' => 'Muhammad Raja Azizi W', 'tgl_lahir' => '2025-05-19', 'umur_thn' => 0, 'umur_bln' => 2, 'jk' => 'L', 'nama_ortu' => 'Juarningsih', 'tb' => 56, 'bb' => 4.6, 'lila' => null, 'lk' => 38, 'status' => 'B'],
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
                'desa' => 'Dumpil 1', // Set desa ke Dumpil 1
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
