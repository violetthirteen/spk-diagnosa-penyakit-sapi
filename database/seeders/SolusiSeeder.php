<?php

namespace Database\Seeders;

use App\Models\Solusi;
use Illuminate\Database\Seeder;

class SolusiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kode_solusi' => 'KS001', 'deskripsi_solusi' => 'Isolasi ternak dan laporkan ke dinas peternakan.'],
            ['kode_solusi' => 'KS002', 'deskripsi_solusi' => 'Berikan antibiotik sesuai anjuran dokter hewan.'],
            ['kode_solusi' => 'KS003', 'deskripsi_solusi' => 'Perbaiki ventilasi kandang dan terapi antibiotik.'],
            ['kode_solusi' => 'KS004', 'deskripsi_solusi' => 'Isolasi ternak dan lakukan vaksinasi PMK.'],
            ['kode_solusi' => 'KS005', 'deskripsi_solusi' => 'Jaga kebersihan ambing dan lakukan pengobatan mastitis.'],
            ['kode_solusi' => 'KS006', 'deskripsi_solusi' => 'Pisahkan ternak yang terinfeksi dan lakukan pemeriksaan reproduksi.'],
            ['kode_solusi' => 'KS007', 'deskripsi_solusi' => 'Berikan obat cacing dan perbaiki manajemen pakan.'],
            ['kode_solusi' => 'KS008', 'deskripsi_solusi' => 'Berikan penanganan kembung dan keluarkan gas rumen.'],
            ['kode_solusi' => 'KS009', 'deskripsi_solusi' => 'Hentikan pakan penyebab keracunan dan lakukan terapi suportif.'],
            ['kode_solusi' => 'KS010', 'deskripsi_solusi' => 'Berikan cairan elektrolit dan cegah dehidrasi.'],
        ];

        foreach ($data as $item) {
            Solusi::create($item);
        }
    }
}
