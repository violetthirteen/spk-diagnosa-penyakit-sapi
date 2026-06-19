@extends('layouts.app')

@section('title-section', 'Tambah Gejala')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Tambah Data Gejala</h1>
            <div class="subtitle">Masukkan data gejala baru</div>
        </div>
        <a href="/gejala" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/gejala" method="POST">
            @csrf

            <div class="form-group">
                <label>Kode Gejala</label>
                <input type="text" name="kode_gejala" class="form-control" placeholder="KG001" required>
            </div>

            <div class="form-group">
                <label>Nama Gejala</label>
                <input type="text" name="nama_gejala" class="form-control" placeholder="Demam" required>
            </div>

            <div class="form-group">
                <label>Nilai CF Pakar (0 - 1)</label>
                <input type="number" step="0.1" min="0" max="1" name="cf_pakar" class="form-control" placeholder="0.8" required>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#059669;color:white;">Simpan</button>
                <a href="/gejala" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
