<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Laporan Hasil Diagnosa - {{ $diagnosa->penyakit }}</title>
<style>
*{margin:0;padding:0;font-family:DejaVu Sans,sans-serif;}
body{color:#1e293b;padding:30px 20px;max-width:700px;margin:0 auto;font-size:12px;line-height:1.6;}
table{width:100%;border-collapse:collapse;}
.progress-bg{background-color:#e2e8f0;height:8px;width:100%;}
.progress-fill{height:8px;background-color:{{ $persen < 50 ? '#f59e0b' : '#2563eb' }};width:{{ min($persen, 100) }}%;}
.solusi-item{border:1px solid #e2e8f0;padding:10px 12px;color:#475569;font-size:12px;line-height:1.5;margin-bottom:6px;}
.section-title{font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;border-bottom:2px solid #2563eb;padding-bottom:6px;margin-bottom:10px;}
.box-card{border:1px solid #2563eb;padding:14px;}
.info-box{border:1px solid #e0e7ff;padding:14px;font-size:12px;color:#475569;line-height:1.7;}
.footer{background-color:#f8fafc;border:1px solid #e2e8f0;padding:14px 28px;text-align:center;color:#94a3b8;font-size:10px;}
.warning-box{background-color:#fffbeb;border-left:4px solid #f59e0b;padding:10px 28px;text-align:center;color:#92400e;font-weight:600;font-size:11px;}
</style>
</head>
<body>

<div style="background-color:#2563eb;padding:24px 28px;text-align:center;">
    <h1 style="font-size:18px;font-weight:800;color:#ffffff;margin:0 0 4px 0;">
        LAPORAN HASIL DIAGNOSA
    </h1>
    <p style="color:#bfdbfe;font-size:12px;font-weight:500;margin:0;">
        Sistem Pakar Diagnosa Penyakit Pada Sapi
    </p>
</div>

<div style="background-color:#ffffff;border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;padding:16px 28px;">
    <table>
        <tr>
            <td style="color:#64748b;width:50%;padding:3px 0;">Diagnosa Dilakukan Oleh</td>
            <td style="color:#1e293b;font-weight:600;padding:3px 0;">{{ $diagnosa->user->name ?? 'User #' . $diagnosa->user_id }}</td>
        </tr>
        <tr>
            <td style="color:#64748b;padding:3px 0;">Tanggal Diagnosa</td>
            <td style="color:#1e293b;font-weight:600;padding:3px 0;">{{ \Carbon\Carbon::parse($diagnosa->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</td>
        </tr>
    </table>
</div>

@if($persen < 50)
<div class="warning-box">
    Hasil diagnosa belum cukup kuat ({{ number_format($persen, 2) }}%). Disarankan melakukan diagnosa ulang dengan gejala yang lebih spesifik.
</div>
@endif

<div style="background-color:#ffffff;border-left:1px solid #e2e8f0;border-right:1px solid #e2e8f0;padding:20px 28px;">

    <div style="margin-bottom:20px;">
        <div class="section-title">
            Hasil Analisis Penyakit
        </div>

        <div class="box-card">

            <table style="margin-bottom:8px;">
                <tr>
                    <td style="padding:0;vertical-align:top;">
                        <div style="font-size:10px;font-weight:700;text-transform:uppercase;color:#2563eb;margin-bottom:2px;">
                            Diagnosis Utama
                        </div>
                        <div style="font-size:14px;font-weight:700;color:#0f172a;">
                            {{ $diagnosa->penyakit }}
                        </div>
                    </td>
                    <td style="padding:0;text-align:right;vertical-align:top;">
                        <div style="font-size:18px;font-weight:800;color:{{ $persen < 50 ? '#f59e0b' : '#2563eb' }};">
                            {{ number_format($persen, 2) }}%
                        </div>
                    </td>
                </tr>
            </table>

            <div class="progress-bg">
                <div class="progress-fill"></div>
            </div>

        </div>
    </div>

    @if($penyakit && $penyakit->deskripsi)
    <div style="margin-bottom:20px;">
        <div class="section-title" style="border-bottom-color:#f59e0b;">
            Tentang {{ $diagnosa->penyakit }}
        </div>
        <p style="color:#475569;font-size:12px;line-height:1.7;text-align:justify;margin:0;">
            {{ $penyakit->deskripsi }}
        </p>
    </div>
    @endif

    @if($solusi->isNotEmpty())
    <div style="margin-bottom:20px;">
        <div class="section-title" style="border-bottom-color:#059669;">
            Solusi Penanganan
        </div>
        @foreach($solusi as $solusiItem)
        <div class="solusi-item">
            {{ $solusiItem->deskripsi_solusi }}
        </div>
        @endforeach
    </div>
    @endif

    <div>
        <div class="section-title" style="border-bottom-color:#6366f1;">
            Kesimpulan
        </div>
        <div class="info-box">
            @if($persen < 50)
            Berdasarkan gejala yang dipilih, sistem mendeteksi kemungkinan
            <strong style="color:#1e293b;">{{ $diagnosa->penyakit }}</strong>
            dengan tingkat keyakinan
            <strong style="color:#1e293b;">{{ number_format($persen, 2) }}%</strong>.
            Namun, hasil ini belum cukup kuat untuk dijadikan kesimpulan akhir.
            Disarankan untuk berkonsultasi dengan dokter hewan dan melakukan
            diagnosa ulang dengan gejala yang lebih lengkap dan spesifik.
            @else
            Berdasarkan gejala yang dipilih, sistem mendeteksi bahwa sapi
            terindikasi menderita
            <strong style="color:#1e293b;">{{ $diagnosa->penyakit }}</strong>
            dengan tingkat keyakinan
            <strong style="color:#1e293b;">{{ number_format($persen, 2) }}%</strong>.
            Disarankan untuk segera melakukan penanganan sesuai solusi yang
            telah diberikan dan berkonsultasi dengan dokter hewan untuk
            penanganan lebih lanjut.
            @endif
        </div>
    </div>

</div>

<div class="footer">
    Sistem Pakar Diagnosa Penyakit Pada Sapi - Universitas Al-Khairiyah<br>
    Dokumen ini dihasilkan secara otomatis oleh sistem pada {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y H:i') }} WIB
</div>

</body>
</html>
