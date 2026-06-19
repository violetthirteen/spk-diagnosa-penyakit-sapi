<?php

namespace App\Http\Controllers;

use App\Models\Solusi;
use Illuminate\Http\Request;

class SolusiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $solusi = Solusi::when($search, fn ($q, $s) => $q
            ->where('kode_solusi', 'like', "%{$s}%")
            ->orWhere('deskripsi_solusi', 'like', "%{$s}%")
        )->paginate(10);

        return view('solusi.index', compact('solusi', 'search'));
    }

    public function show(string $id)
    {
        $solusi = Solusi::findOrFail($id);

        return redirect('/solusi');
    }

    public function create()
    {
        return view('solusi.create');
    }

    public function store(Request $request)
    {
        Solusi::create([
            'kode_solusi' => $request->kode_solusi,
            'deskripsi_solusi' => $request->deskripsi_solusi,
        ]);

        return redirect('/solusi')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $solusi = Solusi::findOrFail($id);

        return view('solusi.edit', compact('solusi'));
    }

    public function update(Request $request, string $id)
    {
        $solusi = Solusi::findOrFail($id);

        $solusi->update([
            'kode_solusi' => $request->kode_solusi,
            'deskripsi_solusi' => $request->deskripsi_solusi,
        ]);

        return redirect('/solusi')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $solusi = Solusi::findOrFail($id);

        $solusi->delete();

        return redirect('/solusi')->with('success', 'Data berhasil dihapus');
    }
}
