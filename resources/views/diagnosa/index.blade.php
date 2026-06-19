@extends('layouts.app')

@section('title-section', 'Diagnosa')

@section('content')

<div class="page-header">
    <div>
        <h1>Diagnosa Penyakit Sapi</h1>
        <div class="subtitle">Pilih gejala yang dialami sapi dan tingkat keyakinan Anda</div>
    </div>
</div>

<div class="glass-card">

    <form action="/diagnosa" method="POST">

        @csrf

        @if($gejala->count() > 0)

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width:40px;text-align:center;">No</th>
                        <th>Gejala</th>
                        <th style="width:220px;text-align:center;">Tingkat Keyakinan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gejala as $item)
                    <tr>
                        <td style="text-align:center;">
                            <input type="checkbox" name="gejala[]" value="{{ $item->id }}" id="gejala_{{ $item->id }}">
                        </td>
                        <td>
                            <label for="gejala_{{ $item->id }}" style="cursor:pointer;">
                                <span class="badge badge-primary">{{ $item->kode_gejala }}</span>
                                {{ $item->nama_gejala }}
                            </label>
                        </td>
                        <td style="text-align:center;">
                            <select name="cf_user[{{ $item->id }}]" class="form-control" style="width:200px;margin:0 auto;">
                                <option value="0">-- Pilih Keyakinan --</option>
                                <option value="0.2">Sedikit Yakin (0.2)</option>
                                <option value="0.4">Cukup Yakin (0.4)</option>
                                <option value="0.6">Yakin (0.6)</option>
                                <option value="0.8">Sangat Yakin (0.8)</option>
                                <option value="1.0">Pasti (1.0)</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top:24px;text-align:center;">
            <button type="submit" class="btn btn-primary" style="padding:12px 40px;font-size:15px;">
                Diagnosa
            </button>
        </div>

        @else

        <div class="empty-state">
            <div class="icon">!</div>
            <h3>Belum Ada Gejala</h3>
            <p>Data gejala belum tersedia. Silakan hubungi admin.</p>
        </div>

        @endif

    </form>

</div>

@endsection
