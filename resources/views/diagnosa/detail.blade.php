@extends('layouts.app')

@section('title-section', 'Detail Diagnosa')

@section('content')

@php
    $kurangYakin = $persen < 50;
    $tgl = \Carbon\Carbon::parse($diagnosa->created_at)->setTimezone('Asia/Jakarta');
    $tglDiagnosa = $tgl->format('d/m/Y H:i') . ' WIB';
@endphp

<div style="max-width:780px;margin:0 auto;">

    {{-- HEADER LAPORAN --}}
    <div style="background:linear-gradient(135deg,#1e3a8a,#2563eb);border-radius:16px 16px 0 0;padding:28px 32px;text-align:center;">
        <h1 style="font-size:20px;font-weight:800;color:white;letter-spacing:.3px;">
            LAPORAN HASIL DIAGNOSA
        </h1>
        <p style="color:#93c5fd;font-size:13px;margin-top:4px;font-weight:500;">
            Sistem Pakar Diagnosa Penyakit Pada Sapi
        </p>
    </div>

    {{-- INFO LAPORAN --}}
    <div style="background:white;border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;padding:20px 32px;">
        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <tr>
                <td style="color:#64748b;width:50%;padding:4px 0;">Diagnosa Dilakukan Oleh</td>
                <td style="color:#1e293b;font-weight:600;padding:4px 0;">{{ $diagnosa->user->name ?? 'User #' . $diagnosa->user_id }}</td>
            </tr>
            <tr>
                <td style="color:#64748b;width:50%;padding:4px 0;">Tanggal Diagnosa</td>
                <td style="color:#1e293b;font-weight:600;padding:4px 0;">{{ $tglDiagnosa }}</td>
            </tr>
        </table>
    </div>

    @if($kurangYakin)
    <div style="background:#fffbeb;border-left:1px solid #f59e0b;border-right:1px solid #f59e0b;padding:14px 32px;text-align:center;">
        <p style="color:#92400e;font-weight:600;font-size:13px;">
            Hasil diagnosa belum cukup kuat ({{ number_format($persen, 2) }}%). Disarankan melakukan diagnosa ulang dengan gejala yang lebih spesifik.
        </p>
        <a href="/diagnosa" class="btn btn-warning" style="margin-top:8px;color:white;font-size:13px;padding:8px 16px;">Diagnosa Ulang</a>
    </div>
    @endif

    {{-- BADAN LAPORAN --}}
    <div style="background:white;border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;padding:24px 32px;">

        {{-- HASIL ANALISIS --}}
        <div style="margin-bottom:24px;">
            <div style="font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px;border-bottom:2px solid #2563eb;padding-bottom:8px;">
                Hasil Analisis Penyakit
            </div>

            @php $barColor = $kurangYakin ? '#f59e0b' : '#2563eb'; @endphp

            <div style="padding:16px;background:#f8faff;border-radius:8px;border:1.5px solid {{ $barColor }};">

                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                    <div>
                        <div style="font-size:11px;color:{{ $barColor }};font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px;">
                            Diagnosis Utama
                        </div>
                        <div style="font-weight:700;color:#0f172a;font-size:15px;">
                            {{ $diagnosa->penyakit }}
                        </div>
                    </div>
                    <div style="font-size:20px;font-weight:800;color:{{ $barColor }};">
                        {{ number_format($persen, 2) }}%
                    </div>
                </div>

                <div style="background:#e2e8f0;border-radius:999px;height:8px;overflow:hidden;">
                    <div style="height:100%;width:{{ min($persen, 100) }}%;background:{{ $barColor }};border-radius:999px;"></div>
                </div>

            </div>
        </div>

        {{-- TENTANG PENYAKIT --}}
        @if($penyakit && $penyakit->deskripsi)
        <div style="margin-bottom:24px;">
            <div style="font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px;border-bottom:2px solid #f59e0b;padding-bottom:8px;">
                Tentang {{ $diagnosa->penyakit }}
            </div>
            <p style="color:#475569;font-size:14px;line-height:1.8;text-align:justify;">
                {{ $penyakit->deskripsi }}
            </p>
        </div>
        @endif

        {{-- SOLUSI --}}
        @if($solusi->isNotEmpty())
        <div style="margin-bottom:24px;">
            <div style="font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px;border-bottom:2px solid #059669;padding-bottom:8px;">
                Solusi Penanganan
            </div>

            @foreach($solusi as $solusiItem)
            <div style="display:flex;gap:12px;padding:12px 14px;background:#f8fafc;border-radius:8px;margin-bottom:8px;border:1px solid #e2e8f0;">
                <div style="width:4px;background:#059669;border-radius:2px;flex-shrink:0;"></div>
                <div>
                    <div style="color:#475569;font-size:14px;line-height:1.6;">
                        {{ $solusiItem->deskripsi_solusi }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- KESIMPULAN --}}
        <div>
            <div style="font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;margin-bottom:10px;border-bottom:2px solid #6366f1;padding-bottom:8px;">
                Kesimpulan
            </div>

            <div style="padding:16px;background:#f8faff;border-radius:8px;border:1px solid #e0e7ff;">
                @if($kurangYakin)
                <p style="color:#475569;font-size:14px;line-height:1.7;">
                    Berdasarkan gejala yang dipilih, sistem mendeteksi kemungkinan
                    <strong>{{ $diagnosa->penyakit }}</strong> dengan tingkat keyakinan
                    <strong>{{ number_format($persen, 2) }}%</strong>.
                    Namun, hasil ini belum cukup kuat untuk dijadikan kesimpulan akhir.
                    Disarankan untuk berkonsultasi dengan dokter hewan dan melakukan
                    diagnosa ulang dengan gejala yang lebih lengkap dan spesifik.
                </p>
                @else
                <p style="color:#475569;font-size:14px;line-height:1.7;">
                    Berdasarkan gejala yang dipilih, sistem mendeteksi bahwa sapi
                    terindikasi menderita <strong>{{ $diagnosa->penyakit }}</strong>
                    dengan tingkat keyakinan <strong>{{ number_format($persen, 2) }}%</strong>.
                    Disarankan untuk segera melakukan penanganan sesuai solusi yang
                    telah diberikan dan berkonsultasi dengan dokter hewan untuk
                    penanganan lebih lanjut.
                </p>
                @endif
            </div>
        </div>

    </div>

    {{-- FOOTER LAPORAN --}}
    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:0 0 16px 16px;padding:16px 32px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
        <a href="/riwayat-diagnosa" class="btn btn-outline" style="font-size:13px;padding:8px 16px;">Kembali ke Riwayat</a>
        <a href="/riwayat-diagnosa/{{ $diagnosa->id }}/pdf" target="_blank" style="display:inline-flex;align-items:center;gap:6px;padding:8px 16px;background:#2563eb;color:white;border-radius:8px;font-size:13px;font-weight:600;text-decoration:none;cursor:pointer;border:none;">
            Download PDF
        </a>
    </div>

</div>

<style media="print">
    .sidebar, footer, .topbar, .alert, .menu-toggle, .topbar-title, .page-header, noscript{display:none !important;}
    .main-wrapper{margin-left:0 !important;padding:0 !important;}
    .main-content{padding:0 !important;}
    body{background:white !important;}
    body::before, body::after{display:none !important;}
    .btn-outline{display:none !important;}
    .main-content a[onclick]{display:inline-flex !important;}
    @page{margin:15mm;}
</style>

@endsection
