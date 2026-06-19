@extends('layouts.app')

@section('title-section', 'Data Aturan')

@section('content')

<div class="page-header">
    <div>
        <h1>Data Aturan</h1>
        <div class="subtitle">Kelola aturan diagnosa (relasi penyakit, gejala, solusi)</div>
    </div>
    <a href="/aturan/create" class="btn btn-primary">+ Tambah Aturan</a>
</div>

<div class="glass-card" style="padding:20px;">

    <form method="GET" action="/aturan" style="margin-bottom:16px;">
        <div style="display:flex;gap:10px;max-width:400px;">
            <input type="text" name="search" class="form-control" placeholder="Cari aturan..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if($search)
                <a href="/aturan" class="btn btn-outline">Reset</a>
            @endif
        </div>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penyakit</th>
                    <th>Gejala</th>
                    <th>Solusi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aturan as $item)
                <tr>
                    <td>{{ $loop->iteration + ($aturan->currentPage() - 1) * $aturan->perPage() }}</td>
                    <td>{{ $item->penyakit->nama_penyakit ?? '-' }}</td>
                    <td>{{ $item->gejala->nama_gejala ?? '-' }}</td>
                    <td>{{ Str::limit($item->solusi->deskripsi_solusi ?? '-', 40) }}</td>
                    <td>
                        <a href="/aturan/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/aturan/{{ $item->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:30px;color:#64748b;">
                        Belum ada data aturan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($aturan->hasPages())
    <div style="margin-top:16px;">
        {{ $aturan->links() }}
    </div>
    @endif

</div>

<style>
    table tbody tr:nth-child(even) { background: #f8fafc; }
    table tbody tr:hover { background: #f1f5f9; }
    .pagination { display:flex;gap:4px;justify-content:center;list-style:none;padding:0; }
    .pagination li a, .pagination li span { padding:6px 12px;border:1px solid #e2e8f0;border-radius:6px;color:#334155;font-size:13px;text-decoration:none; }
    .pagination li.active span { background:#2563eb;color:white;border-color:#2563eb; }
    .pagination li.disabled span { color:#94a3b8;cursor:not-allowed; }
</style>

@endsection
