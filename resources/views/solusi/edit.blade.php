@extends('layouts.app')

@section('title-section', 'Edit Solusi')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Edit Data Solusi</h1>
            <div class="subtitle">Ubah data solusi</div>
        </div>
        <a href="/solusi" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/solusi/{{ $solusi->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Kode Solusi</label>
                <input type="text" name="kode_solusi" class="form-control" value="{{ $solusi->kode_solusi }}" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Solusi</label>
                <textarea name="deskripsi_solusi" class="form-control" required>{{ $solusi->deskripsi_solusi }}</textarea>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#f59e0b;color:white;">Update</button>
                <a href="/solusi" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
