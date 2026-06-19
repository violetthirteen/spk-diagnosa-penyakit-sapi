<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $penyakit = Penyakit::when($search, fn ($q, $s) => $q
            ->where('kode_penyakit', 'like', "%{$s}%")
            ->orWhere('nama_penyakit', 'like', "%{$s}%")
            ->orWhere('deskripsi', 'like', "%{$s}%")
        )->paginate(10);

        return view('penyakit.index', compact('penyakit', 'search'));
    }

    public function create()
    {
        return view('penyakit.create');
    }

    public function store(Request $request)
    {
        Penyakit::create([
            'kode_penyakit' => $request->kode_penyakit,
            'nama_penyakit' => $request->nama_penyakit,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/penyakit')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id);

        return view('penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, $id)
    {
        $penyakit = Penyakit::findOrFail($id);

        $penyakit->update([
            'kode_penyakit' => $request->kode_penyakit,
            'nama_penyakit' => $request->nama_penyakit,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect('/penyakit')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $penyakit = Penyakit::findOrFail($id);

        $penyakit->delete();

        return redirect('/penyakit')->with('success', 'Data berhasil dihapus');
    }
}
