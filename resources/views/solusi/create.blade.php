@extends('layouts.app')

@section('title-section', 'Tambah Solusi')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Tambah Data Solusi</h1>
            <div class="subtitle">Masukkan data solusi baru</div>
        </div>
        <a href="/solusi" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/solusi" method="POST">
            @csrf

            <div class="form-group">
                <label>Kode Solusi</label>
                <input type="text" name="kode_solusi" class="form-control" placeholder="KS001" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Solusi</label>
                <textarea name="deskripsi_solusi" class="form-control" placeholder="Deskripsi solusi..." required></textarea>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#059669;color:white;">Simpan</button>
                <a href="/solusi" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
