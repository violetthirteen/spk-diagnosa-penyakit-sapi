@extends('layouts.app')

@section('title-section', 'Tambah Penyakit')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Tambah Data Penyakit</h1>
            <div class="subtitle">Masukkan data penyakit baru</div>
        </div>
        <a href="/penyakit" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/penyakit" method="POST">
            @csrf

            <div class="form-group">
                <label>Kode Penyakit</label>
                <input type="text" name="kode_penyakit" class="form-control" placeholder="P01" required>
            </div>

            <div class="form-group">
                <label>Nama Penyakit</label>
                <input type="text" name="nama_penyakit" class="form-control" placeholder="Antraks" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi penyakit..."></textarea>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#059669;color:white;">Simpan</button>
                <a href="/penyakit" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
