<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        Gejala::truncate();

        $data = [
            ['kode_gejala' => 'KG001', 'nama_gejala' => 'Demam', 'cf_pakar' => 0.4],
            ['kode_gejala' => 'KG002', 'nama_gejala' => 'Nafsu makan menurun', 'cf_pakar' => 0.4],
            ['kode_gejala' => 'KG003', 'nama_gejala' => 'Tubuh sangat lemah', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG004', 'nama_gejala' => 'Sesak napas', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG005', 'nama_gejala' => 'Produksi menurun', 'cf_pakar' => 0.5],
            ['kode_gejala' => 'KG006', 'nama_gejala' => 'Gangguan pencernaan', 'cf_pakar' => 0.5],
            ['kode_gejala' => 'KG007', 'nama_gejala' => 'Bulu kusam', 'cf_pakar' => 0.6],
            ['kode_gejala' => 'KG008', 'nama_gejala' => 'Pendarahan dari lubang tubuh', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG009', 'nama_gejala' => 'Keluar lendir dari hidung', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG010', 'nama_gejala' => 'Batuk', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG011', 'nama_gejala' => 'Air liur berlebihan', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG012', 'nama_gejala' => 'Pembengkakan tubuh', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG013', 'nama_gejala' => 'Pembengkakan leher', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG014', 'nama_gejala' => 'Napas cepat', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG015', 'nama_gejala' => 'Ambing bengkak', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG016', 'nama_gejala' => 'Kematian mendadak', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG017', 'nama_gejala' => 'Suara ngorok', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG018', 'nama_gejala' => 'Keluar lendir dari mulut', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG019', 'nama_gejala' => 'Luka pada mulut', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG020', 'nama_gejala' => 'Perut sebelah kiri membesar', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG021', 'nama_gejala' => 'Keguguran', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG022', 'nama_gejala' => 'Berat badan menurun', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG023', 'nama_gejala' => 'Luka pada lidah', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG024', 'nama_gejala' => 'Ambing terasa panas', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG025', 'nama_gejala' => 'Diare ringan', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG026', 'nama_gejala' => 'Sulit bernapas setelah makan', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG027', 'nama_gejala' => 'Luka pada gusi', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG028', 'nama_gejala' => 'Susu menggumpal', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG029', 'nama_gejala' => 'Retensi plasenta', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG030', 'nama_gejala' => 'Gelisah', 'cf_pakar' => 0.6],
            ['kode_gejala' => 'KG031', 'nama_gejala' => 'Pertumbuhan lambat', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG032', 'nama_gejala' => 'Produksi susu menurun drastis', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG033', 'nama_gejala' => 'Gangguan reproduksi', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG034', 'nama_gejala' => 'Sering menendang perut', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG035', 'nama_gejala' => 'Salivasi berlebihan', 'cf_pakar' => 0.8],
            ['kode_gejala' => 'KG036', 'nama_gejala' => 'Feses cair', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG037', 'nama_gejala' => 'Infertilitas', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG038', 'nama_gejala' => 'Tidak mau makan', 'cf_pakar' => 0.7],
            ['kode_gejala' => 'KG039', 'nama_gejala' => 'Kejang', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG040', 'nama_gejala' => 'Keracunan akut', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG041', 'nama_gejala' => 'Dehidrasi', 'cf_pakar' => 0.9],
            ['kode_gejala' => 'KG042', 'nama_gejala' => 'Kotoran encer terus-menerus', 'cf_pakar' => 1.0],
            ['kode_gejala' => 'KG043', 'nama_gejala' => 'Lemas berkepanjangan', 'cf_pakar' => 0.8],
        ];

        foreach ($data as $item) {
            Gejala::create($item);
        }
    }
}
