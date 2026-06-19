@extends('layouts.app')

@section('title-section', 'Tambah Aturan')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Tambah Aturan</h1>
            <div class="subtitle">Buat aturan relasi penyakit, gejala, dan solusi</div>
        </div>
        <a href="/aturan" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/aturan" method="POST">
            @csrf

            <div class="form-group">
                <label>Penyakit</label>
                <select name="penyakit_id" class="form-control" required>
                    <option value="">-- Pilih Penyakit --</option>
                    @foreach($penyakit as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->kode_penyakit }} - {{ $item->nama_penyakit }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Gejala</label>
                <select name="gejala_id" class="form-control" required>
                    <option value="">-- Pilih Gejala --</option>
                    @foreach($gejala as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->kode_gejala }} - {{ $item->nama_gejala }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Solusi</label>
                <select name="solusi_id" class="form-control" required>
                    <option value="">-- Pilih Solusi --</option>
                    @foreach($solusi as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->kode_solusi }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#059669;color:white;">Simpan</button>
                <a href="/aturan" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
