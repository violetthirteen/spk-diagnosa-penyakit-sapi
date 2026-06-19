<?php

namespace Database\Seeders;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Solusi;
use Illuminate\Database\Seeder;

class AturanSeeder extends Seeder
{
    public function run(): void
    {
        Aturan::truncate();

        $getPenyakitId = fn ($kode) => Penyakit::where('kode_penyakit', $kode)->value('id');
        $getGejalaId = fn ($kode) => Gejala::where('kode_gejala', $kode)->value('id');
        $getSolusiId = fn ($kode) => Solusi::where('kode_solusi', $kode)->value('id');

        $aturan = [
            // A01 - Antraks
            ['penyakit' => 'P01', 'gejala' => ['KG001', 'KG002', 'KG003', 'KG008', 'KG012', 'KG016'], 'solusi' => 'KS001'],
            // A02 - SE
            ['penyakit' => 'P02', 'gejala' => ['KG001', 'KG002', 'KG004', 'KG009', 'KG013', 'KG017'], 'solusi' => 'KS002'],
            // A03 - Pneumonia
            ['penyakit' => 'P03', 'gejala' => ['KG001', 'KG002', 'KG004', 'KG010', 'KG014', 'KG018'], 'solusi' => 'KS003'],
            // A04 - PMK
            ['penyakit' => 'P04', 'gejala' => ['KG001', 'KG005', 'KG011', 'KG019', 'KG023', 'KG027'], 'solusi' => 'KS004'],
            // A05 - Mastitis
            ['penyakit' => 'P05', 'gejala' => ['KG001', 'KG005', 'KG015', 'KG024', 'KG028', 'KG032'], 'solusi' => 'KS005'],
            // A06 - Brucellosis
            ['penyakit' => 'P06', 'gejala' => ['KG001', 'KG005', 'KG021', 'KG029', 'KG033', 'KG037'], 'solusi' => 'KS006'],
            // A07 - Cacingan
            ['penyakit' => 'P07', 'gejala' => ['KG001', 'KG006', 'KG007', 'KG022', 'KG025', 'KG031'], 'solusi' => 'KS007'],
            // A08 - Bloat
            ['penyakit' => 'P08', 'gejala' => ['KG001', 'KG006', 'KG020', 'KG026', 'KG034', 'KG038'], 'solusi' => 'KS008'],
            // A09 - Keracunan Pakan
            ['penyakit' => 'P09', 'gejala' => ['KG001', 'KG006', 'KG030', 'KG035', 'KG039', 'KG040'], 'solusi' => 'KS009'],
            // A10 - Diare Akut
            ['penyakit' => 'P10', 'gejala' => ['KG001', 'KG036', 'KG041', 'KG042', 'KG043'], 'solusi' => 'KS010'],
        ];

        foreach ($aturan as $item) {
            $penyakitId = $getPenyakitId($item['penyakit']);
            $solusiId = $getSolusiId($item['solusi']);

            foreach ($item['gejala'] as $kodeGejala) {
                Aturan::create([
                    'penyakit_id' => $penyakitId,
                    'gejala_id' => $getGejalaId($kodeGejala),
                    'solusi_id' => $solusiId,
                ]);
            }
        }
    }
}
