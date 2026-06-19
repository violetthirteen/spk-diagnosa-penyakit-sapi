@extends('layouts.app')

@section('title-section', 'Edit Gejala')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Edit Data Gejala</h1>
            <div class="subtitle">Ubah data gejala</div>
        </div>
        <a href="/gejala" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/gejala/{{ $gejala->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kode Gejala</label>
                <input type="text" name="kode_gejala" class="form-control" value="{{ $gejala->kode_gejala }}" required>
            </div>

            <div class="form-group">
                <label>Nama Gejala</label>
                <input type="text" name="nama_gejala" class="form-control" value="{{ $gejala->nama_gejala }}" required>
            </div>

            <div class="form-group">
                <label>Nilai CF Pakar (0 - 1)</label>
                <input type="number" step="0.1" min="0" max="1" name="cf_pakar" class="form-control" value="{{ $gejala->cf_pakar }}" required>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#f59e0b;color:white;">Update</button>
                <a href="/gejala" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
