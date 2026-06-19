@extends('layouts.app')

@section('title-section', 'Edit Aturan')

@section('content')

<div style="max-width:700px;margin:0 auto;">

    <div class="page-header" style="padding:0;margin-bottom:16px;">
        <div>
            <h1>Edit Aturan</h1>
            <div class="subtitle">Ubah aturan relasi penyakit, gejala, dan solusi</div>
        </div>
        <a href="/aturan" class="btn btn-outline">Kembali</a>
    </div>

    <div class="glass-card">

        <form action="/aturan/{{ $aturan->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Penyakit</label>
                <select name="penyakit_id" class="form-control" required>
                    <option value="">-- Pilih Penyakit --</option>
                    @foreach($penyakit as $item)
                    <option value="{{ $item->id }}" {{ $aturan->penyakit_id == $item->id ? 'selected' : '' }}>
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
                    <option value="{{ $item->id }}" {{ $aturan->gejala_id == $item->id ? 'selected' : '' }}>
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
                    <option value="{{ $item->id }}" {{ $aturan->solusi_id == $item->id ? 'selected' : '' }}>
                        {{ $item->kode_solusi }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div style="display:flex;gap:10px;margin-top:24px;">
                <button type="submit" class="btn" style="background:#f59e0b;color:white;">Update</button>
                <a href="/aturan" class="btn btn-outline">Batal</a>
            </div>

        </form>

    </div>

</div>

@endsection
