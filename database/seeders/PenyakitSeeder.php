<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_penyakit' => 'P01', 'nama_penyakit' => 'Antraks', 'deskripsi' => 'Penyakit infeksi akut yang disebabkan oleh bakteri Bacillus anthracis. Dapat menular ke manusia dan bersifat zoonosis. Gejala khas meliputi demam tinggi, pembengkakan tubuh, dan kematian mendadak.'],
            ['kode_penyakit' => 'P02', 'nama_penyakit' => 'Septicemia Epizootica (SE)', 'deskripsi' => 'Penyakit infeksi bakteri Pasteurella multocida yang menyerang saluran pernapasan sapi. Ditandai dengan pembengkakan leher dan suara ngorok akibat penyempitan saluran napas.'],
            ['kode_penyakit' => 'P03', 'nama_penyakit' => 'Pneumonia', 'deskripsi' => 'Radang paru-paru pada sapi yang disebabkan oleh infeksi bakteri atau virus. Gejala utama meliputi batuk, napas cepat, dan keluarnya lendir dari mulut.'],
            ['kode_penyakit' => 'P04', 'nama_penyakit' => 'Penyakit Mulut dan Kuku (PMK)', 'deskripsi' => 'Penyakit virus yang sangat menular dengan gejala khas luka pada mulut, lidah, dan kuku. Menyebabkan produksi susu menurun drastis dan air liur berlebihan.'],
            ['kode_penyakit' => 'P05', 'nama_penyakit' => 'Mastitis', 'deskripsi' => 'Radang ambing yang disebabkan oleh infeksi bakteri. Mengakibatkan ambing bengkak, terasa panas, dan susu menggumpal. Sangat umum terjadi pada sapi perah.'],
            ['kode_penyakit' => 'P06', 'nama_penyakit' => 'Brucellosis', 'deskripsi' => 'Penyakit reproduksi yang disebabkan oleh bakteri Brucella abortus. Menyebabkan keguguran berulang, retensi plasenta, dan infertilitas pada sapi betina.'],
            ['kode_penyakit' => 'P07', 'nama_penyakit' => 'Cacingan', 'deskripsi' => 'Infestasi cacing parasit pada saluran pencernaan sapi. Menyebabkan bulu kusam, diare ringan, pertumbuhan lambat, dan penurunan berat badan.'],
            ['kode_penyakit' => 'P08', 'nama_penyakit' => 'Kembung (Bloat)', 'deskripsi' => 'Akumulasi gas berlebihan pada rumen yang menyebabkan perut sebelah kiri membesar. Sapi gelisah, sering menendang perut, dan sulit bernapas setelah makan.'],
            ['kode_penyakit' => 'P09', 'nama_penyakit' => 'Keracunan Pakan', 'deskripsi' => 'Kondisi akibat sapi mengonsumsi pakan yang mengandung racun atau zat berbahaya. Gejala meliputi kejang, salivasi berlebihan, dan keracunan akut.'],
            ['kode_penyakit' => 'P10', 'nama_penyakit' => 'Diare Akut', 'deskripsi' => 'Gangguan pencernaan parah yang ditandai dengan feses cair terus-menerus. Menyebabkan dehidrasi berat dan lemas berkepanjangan jika tidak segera ditangani.'],
        ];

        foreach ($data as $item) {
            Penyakit::create($item);
        }
    }
}
