@extends('layouts.app')

@section('title-section', 'Edit Penyakit')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Edit Data Penyakit</h1>
            <div class="subtitle">Ubah data penyakit</div>
        </div>
        <a href="/penyakit" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/penyakit/{{ $penyakit->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kode Penyakit</label>
                <input type="text" name="kode_penyakit" class="form-control" value="{{ $penyakit->kode_penyakit }}" required>
            </div>

            <div class="form-group">
                <label>Nama Penyakit</label>
                <input type="text" name="nama_penyakit" class="form-control" value="{{ $penyakit->nama_penyakit }}" required>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $penyakit->deskripsi }}</textarea>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#f59e0b;color:white;">Update</button>
                <a href="/penyakit" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
