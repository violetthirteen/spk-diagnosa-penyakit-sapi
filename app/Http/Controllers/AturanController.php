<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Solusi;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $aturan = Aturan::with(['penyakit', 'gejala', 'solusi'])
            ->when($search, fn ($q, $s) => $q
                ->whereHas('penyakit', fn ($qq) => $qq->where('nama_penyakit', 'like', "%{$s}%"))
                ->orWhereHas('gejala', fn ($qq) => $qq->where('nama_gejala', 'like', "%{$s}%"))
                ->orWhereHas('solusi', fn ($qq) => $qq->where('deskripsi_solusi', 'like', "%{$s}%"))
            )
            ->paginate(10);

        return view('aturan.index', compact('aturan', 'search'));
    }

    public function create()
    {
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        $solusi = Solusi::all();

        return view('aturan.create', compact('penyakit', 'gejala', 'solusi'));
    }

    public function store(Request $request)
    {
        Aturan::create([
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'solusi_id' => $request->solusi_id,
        ]);

        return redirect('/aturan')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $aturan = Aturan::with(['penyakit', 'gejala', 'solusi'])->findOrFail($id);
        $penyakit = Penyakit::all();
        $gejala = Gejala::all();
        $solusi = Solusi::all();

        return view('aturan.edit', compact('aturan', 'penyakit', 'gejala', 'solusi'));
    }

    public function update(Request $request, string $id)
    {
        $aturan = Aturan::findOrFail($id);

        $aturan->update([
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'solusi_id' => $request->solusi_id,
        ]);

        return redirect('/aturan')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $aturan = Aturan::findOrFail($id);

        $aturan->delete();

        return redirect('/aturan')->with('success', 'Data berhasil dihapus');
    }
}
