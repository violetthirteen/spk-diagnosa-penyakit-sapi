@extends('layouts.app')

@section('title-section', 'Data Gejala')

@section('content')

<div class="page-header">
    <div>
        <h1>Data Gejala</h1>
        <div class="subtitle">Kelola data gejala penyakit sapi</div>
    </div>
    <a href="/gejala/create" class="btn btn-primary">+ Tambah Gejala</a>
</div>

<div class="glass-card" style="padding:20px;">

    <form method="GET" action="/gejala" style="margin-bottom:16px;">
        <div style="display:flex;gap:10px;max-width:400px;">
            <input type="text" name="search" class="form-control" placeholder="Cari gejala..." value="{{ $search ?? '' }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if($search)
                <a href="/gejala" class="btn btn-outline">Reset</a>
            @endif
        </div>
    </form>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Gejala</th>
                    <th>CF Pakar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gejala as $item)
                <tr>
                    <td>{{ $loop->iteration + ($gejala->currentPage() - 1) * $gejala->perPage() }}</td>
                    <td><span class="badge badge-primary">{{ $item->kode_gejala }}</span></td>
                    <td>{{ $item->nama_gejala }}</td>
                    <td><span class="badge badge-success">{{ $item->cf_pakar }}</span></td>
                    <td>
                        <a href="/gejala/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                        <form action="/gejala/{{ $item->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:30px;color:#64748b;">
                        Belum ada data gejala
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($gejala->hasPages())
    <div style="margin-top:16px;">
        {{ $gejala->links() }}
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
