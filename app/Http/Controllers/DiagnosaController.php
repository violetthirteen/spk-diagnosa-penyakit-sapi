<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\HasilDiagnosa;
use App\Models\Penyakit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    public function index()
    {
        $gejala = Gejala::all();

        return view('diagnosa.index', compact('gejala'));
    }

    public function proses(Request $request)
    {
        $gejalaDipilih = $request->gejala;

        if (! $gejalaDipilih) {
            return back()->with('error', 'Pilih minimal 1 gejala');
        }

        $cfUser = $request->cf_user;

        $selectedGejala = Gejala::whereIn('id', $gejalaDipilih)->get();

        $aturan = Aturan::with(['penyakit', 'solusi', 'gejala'])
            ->whereIn('gejala_id', $gejalaDipilih)
            ->get();

        if ($aturan->isEmpty()) {
            return back()->with('error', 'Tidak ada aturan yang cocok');
        }

        $grouped = $aturan->groupBy(fn ($item) => $item->penyakit->nama_penyakit);

        $hasil = [];

        foreach ($grouped as $namaPenyakit => $items) {
            $cfCombine = 0;
            $first = true;

            foreach ($items as $item) {
                $cfPakar = $item->gejala->cf_pakar ?? 0;
                $cfUserVal = (float) ($cfUser[$item->gejala_id] ?? 0);

                $cfHe = $cfPakar * $cfUserVal;

                if ($first) {
                    $cfCombine = $cfHe;
                    $first = false;
                } else {
                    $cfCombine = $cfCombine + $cfHe * (1 - $cfCombine);
                }
            }

            $penyakit = $items->first()->penyakit;

            $hasil[$namaPenyakit] = [
                'cf' => $cfCombine,
                'persen' => min(round($cfCombine * 100, 2), 100),
                'solusi' => $items->first()->solusi,
                'deskripsi' => $penyakit->deskripsi,
            ];
        }

        uasort($hasil, fn ($a, $b) => $b['cf'] <=> $a['cf']);

        $topPenyakit = array_key_first($hasil);
        if ($topPenyakit) {
            HasilDiagnosa::create([
                'user_id' => auth()->id(),
                'penyakit' => $topPenyakit,
                'nilai_cf' => $hasil[$topPenyakit]['cf'],
            ]);
        }

        return view('diagnosa.hasil', compact('hasil', 'selectedGejala'));
    }

    public function riwayat()
    {
        $riwayat = HasilDiagnosa::with('user')->latest()->get();

        return view('diagnosa.riwayat', compact('riwayat'));
    }

    public function detail($id)
    {
        $diagnosa = HasilDiagnosa::with('user')->findOrFail($id);

        $penyakit = Penyakit::where('nama_penyakit', $diagnosa->penyakit)->first();

        $solusi = collect();
        if ($penyakit) {
            $solusi = Aturan::where('penyakit_id', $penyakit->id)
                ->with('solusi')
                ->get()
                ->pluck('solusi')
                ->unique('id');
        }

        $persen = min(round($diagnosa->nilai_cf * 100, 2), 100);

        return view('diagnosa.detail', compact('diagnosa', 'penyakit', 'solusi', 'persen'));
    }

    public function downloadPdf($id)
    {
        $diagnosa = HasilDiagnosa::with('user')->findOrFail($id);

        $penyakit = Penyakit::where('nama_penyakit', $diagnosa->penyakit)->first();

        $solusi = collect();
        if ($penyakit) {
            $solusi = Aturan::where('penyakit_id', $penyakit->id)
                ->with('solusi')
                ->get()
                ->pluck('solusi')
                ->unique('id');
        }

        $persen = min(round($diagnosa->nilai_cf * 100, 2), 100);

        $pdf = Pdf::loadView('diagnosa.pdf', compact('diagnosa', 'penyakit', 'solusi', 'persen'));

        return $pdf->stream('laporan-diagnosa-'.$id.'.pdf');
    }
}
