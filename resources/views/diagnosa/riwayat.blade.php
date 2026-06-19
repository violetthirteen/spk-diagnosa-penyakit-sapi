@extends('layouts.app')

@section('title-section', 'Riwayat Diagnosa')

@section('content')

<div class="page-header">
    <div>
        <h1>Riwayat Diagnosa</h1>
        <div class="subtitle">Riwayat hasil diagnosa yang telah dilakukan</div>
    </div>
    <a href="/diagnosa" class="btn btn-primary">+ Diagnosa Baru</a>
</div>

<div class="glass-card" style="padding:0;overflow:hidden;">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width:50px;">No</th>
                    @if(Auth::user()->role == 'admin')
                    <th>Pengguna</th>
                    @endif
                    <th>Penyakit</th>
                    <th style="width:100px;">Hasil</th>
                    <th style="width:140px;">Tanggal</th>
                    <th style="width:140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $item)
                @php
                    $persen = min(round($item->nilai_cf * 100, 2), 100);
                    $badgeClass = $persen >= 70 ? 'badge-success' : ($persen >= 40 ? 'badge-warning' : 'badge-warning');
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if(Auth::user()->role == 'admin')
                    <td>{{ $item->user->name ?? 'User #' . $item->user_id }}</td>
                    @endif
                    <td>{{ $item->penyakit }}</td>
                    <td>
                        <span class="badge {{ $badgeClass }}">{{ number_format($persen, 2) }}%</span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="/riwayat-diagnosa/{{ $item->id }}" class="btn btn-primary btn-sm">Detail</a>
                        <a href="/riwayat-diagnosa/{{ $item->id }}/pdf" class="btn btn-outline btn-sm" target="_blank" style="border-color:#64748b;color:#64748b;font-size:12px;">PDF</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="{{ Auth::user()->role == 'admin' ? 6 : 5 }}" style="text-align:center;padding:40px;color:#64748b;">
                        <div style="width:50px;height:50px;background:#f1f5f9;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;font-size:24px;color:#94a3b8;">!</div>
                        <div style="font-weight:600;color:#334155;margin-bottom:4px;">Belum Ada Riwayat</div>
                        <div style="font-size:14px;">Anda belum melakukan diagnosa apapun.</div>
                        <a href="/diagnosa" class="btn btn-primary" style="margin-top:12px;">Mulai Diagnosa</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
