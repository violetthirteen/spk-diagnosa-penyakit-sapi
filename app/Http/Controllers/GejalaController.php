<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $gejala = Gejala::when($search, fn ($q, $s) => $q->where('kode_gejala', 'like', "%{$s}%")->orWhere('nama_gejala', 'like', "%{$s}%"))
            ->paginate(10);

        return view('gejala.index', compact('gejala', 'search'));
    }

    public function create()
    {
        return view('gejala.create');
    }

    public function store(Request $request)
    {
        Gejala::create([
            'kode_gejala' => $request->kode_gejala,
            'nama_gejala' => $request->nama_gejala,
            'cf_pakar' => $request->cf_pakar,
        ]);

        return redirect('/gejala')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $gejala = Gejala::findOrFail($id);

        return view('gejala.edit', compact('gejala'));
    }

    public function update(Request $request, string $id)
    {
        $gejala = Gejala::findOrFail($id);

        $gejala->update([
            'kode_gejala' => $request->kode_gejala,
            'nama_gejala' => $request->nama_gejala,
            'cf_pakar' => $request->cf_pakar,
        ]);

        return redirect('/gejala')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $gejala = Gejala::findOrFail($id);

        $gejala->delete();

        return redirect('/gejala')->with('success', 'Data berhasil dihapus');
    }
}
