@extends('layouts.app')

@section('title-section', 'Dashboard')

@section('content')

@php
    $firstName = explode(' ', Auth::user()->name)[0];
    $edukasi = [
        [
            'icon' => '🧹',
            'title' => 'Kebersihan Kandang',
            'desc' => 'Kandang yang bersih membantu mencegah penyebaran penyakit pada sapi. Bersihkan kotoran secara rutin dan pastikan sirkulasi udara berjalan baik.',
        ],
        [
            'icon' => '🌾',
            'title' => 'Pakan Berkualitas',
            'desc' => 'Berikan pakan hijauan berkualitas dan konsentrat seimbang. Pakan yang baik mendukung pertumbuhan, produksi susu, dan daya tahan tubuh sapi.',
        ],
        [
            'icon' => '🏥',
            'title' => 'Pemeriksaan Rutin',
            'desc' => 'Lakukan pemeriksaan kesehatan ternak secara berkala untuk mendeteksi gejala awal penyakit sebelum berkembang menjadi parah.',
        ],
        [
            'icon' => '💉',
            'title' => 'Vaksinasi Rutin',
            'desc' => 'Vaksinasi berkala melindungi sapi dari berbagai penyakit berbahaya. Ikuti jadwal vaksinasi yang dianjurkan oleh dinas peternakan.',
        ],
        [
            'icon' => '💧',
            'title' => 'Air Bersih',
            'desc' => 'Pastikan ketersediaan air bersih dan segar setiap saat. Kualitas air minum sangat mempengaruhi kesehatan dan produktivitas sapi.',
        ],
    ];
@endphp

<style>

.d-hero {
    display: flex;
    align-items: center;
    gap: 40px;
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
    border-radius: 24px;
    padding: 48px 52px;
    margin-bottom: 48px;
    position: relative;
    overflow: hidden;
}

.d-hero::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: rgba(255,255,255,.04);
    border-radius: 50%;
    top: -200px;
    right: -100px;
}

.d-hero::after {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,.04);
    border-radius: 50%;
    bottom: -120px;
    left: 200px;
}

.d-hero-content {
    flex: 1;
    position: relative;
    z-index: 1;
    min-width: 0;
}

.d-hero-greeting {
    font-size: 32px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.2;
}

.d-hero-greeting span {
    color: #93c5fd;
}

.d-hero-desc {
    color: #bfdbfe;
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 24px;
    max-width: 520px;
}

.d-hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    background: #fff;
    color: #1e3a8a;
    font-weight: 700;
    font-size: 15px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    text-decoration: none;
    transition: all .25s ease;
    box-shadow: 0 4px 16px rgba(0,0,0,.15);
}

.d-hero-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,.2);
    color: #1e3a8a;
}

.d-hero-illustration {
    flex-shrink: 0;
    width: 220px;
    height: 220px;
    background: rgba(255,255,255,.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    z-index: 1;
    font-size: 80px;
    border: 3px solid rgba(255,255,255,.2);
    overflow: hidden;
}

.d-hero-illustration img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

/* Section headers */
.d-section {
    margin-bottom: 48px;
}

.d-section-header {
    text-align: center;
    margin-bottom: 32px;
}

.d-section-label {
    display: inline-block;
    padding: 4px 14px;
    background: #dbeafe;
    color: #1d4ed8;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
    margin-bottom: 10px;
}

.d-section-title {
    font-size: 28px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 8px;
}

.d-section-subtitle {
    font-size: 15px;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Tentang Sistem */
.d-about-card {
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,.7);
    padding: 36px 40px;
    box-shadow: 0 4px 20px rgba(15,23,42,.05);
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.d-about-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.d-about-card p {
    color: #475569;
    font-size: 15px;
    line-height: 1.8;
    max-width: 680px;
    margin: 0 auto;
}

/* Disease grid */
.d-grid-5 {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 20px;
}

.d-penyakit-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    transition: all .25s ease;
    box-shadow: 0 2px 8px rgba(15,23,42,.04);
}

.d-penyakit-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(15,23,42,.08);
    border-color: #bfdbfe;
}

.d-penyakit-img {
    width: 100%;
    height: 140px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: #93c5fd;
    overflow: hidden;
}

.d-penyakit-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.d-penyakit-body {
    padding: 16px 16px 18px;
}

.d-penyakit-name {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
}

.d-penyakit-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.6;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Edukasi grid */
.d-edukasi-grid {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.d-edukasi-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.d-edukasi-row.row-2 {
    grid-template-columns: 1fr auto 1fr;
    align-items: stretch;
}

.d-edukasi-card {
    background: rgba(255,255,255,.85);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,.7);
    padding: 28px 24px;
    box-shadow: 0 4px 20px rgba(15,23,42,.04);
    transition: all .25s ease;
}

.d-edukasi-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(15,23,42,.07);
}

.d-edukasi-icon {
    font-size: 32px;
    margin-bottom: 12px;
}

.d-edukasi-title {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
}

.d-edukasi-desc {
    font-size: 14px;
    color: #64748b;
    line-height: 1.7;
}

/* Edukasi center cow card */
.d-edukasi-center {
    background: #fff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 20px rgba(15,23,42,.05);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 24px 20px;
    transition: all .25s ease;
    width: 200px;
}

.d-edukasi-center:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(15,23,42,.1);
    border-color: #bfdbfe;
}

.d-edukasi-center-img {
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 60px;
    border-radius: 50%;
    background: #f0f4ff;
    overflow: hidden;
    margin-bottom: 10px;
}

.d-edukasi-center-img img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.d-edukasi-center-caption {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    text-align: center;
    line-height: 1.4;
}

/* Fakta grid */
.d-fakta-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

.d-fakta-card {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    padding: 20px 18px;
    box-shadow: 0 2px 10px rgba(15,23,42,.04);
    transition: all .25s ease;
}

.d-fakta-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(15,23,42,.07);
    border-color: #bfdbfe;
}

.d-fakta-icon {
    flex-shrink: 0;
    width: 40px;
    height: 40px;
    background: #f0f4ff;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.d-fakta-body {
    min-width: 0;
}

.d-fakta-title {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 4px;
}

.d-fakta-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.6;
}

/* CTA */
.d-cta {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
    border-radius: 24px;
    padding: 60px 40px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.d-cta::before {
    content: '';
    position: absolute;
    width: 400px;
    height: 400px;
    background: rgba(255,255,255,.03);
    border-radius: 50%;
    top: -150px;
    left: -80px;
}

.d-cta::after {
    content: '';
    position: absolute;
    width: 300px;
    height: 300px;
    background: rgba(255,255,255,.03);
    border-radius: 50%;
    bottom: -100px;
    right: -50px;
}

.d-cta-content {
    position: relative;
    z-index: 1;
}

.d-cta-title {
    font-size: 30px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
}

.d-cta-desc {
    color: #bfdbfe;
    font-size: 15px;
    line-height: 1.7;
    max-width: 560px;
    margin: 0 auto 28px;
}

.d-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 16px 40px;
    background: #fff;
    color: #1e3a8a;
    font-weight: 700;
    font-size: 16px;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    text-decoration: none;
    transition: all .25s ease;
    box-shadow: 0 4px 16px rgba(0,0,0,.15);
}

.d-cta-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 28px rgba(0,0,0,.2);
    color: #1e3a8a;
}

/* Responsive */
@media(max-width: 1024px) {
    .d-grid-5 {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media(max-width: 768px) {
    .d-hero {
        flex-direction: column-reverse;
        text-align: center;
        padding: 36px 24px;
    }

    .d-hero-desc {
        max-width: 100%;
    }

    .d-hero-greeting {
        font-size: 26px;
    }

    .d-hero-illustration {
        width: 140px;
        height: 140px;
        font-size: 56px;
    }

    .d-section-title {
        font-size: 24px;
    }

    .d-about-card {
        padding: 28px 20px;
    }

    .d-grid-5 {
        grid-template-columns: repeat(2, 1fr);
    }

    .d-fakta-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .d-edukasi-row {
        grid-template-columns: repeat(2, 1fr);
    }

    .d-edukasi-row.row-2 {
        grid-template-columns: 1fr 1fr;
    }

    .d-edukasi-center {
        display: none;
    }

    .d-cta {
        padding: 40px 24px;
    }

    .d-cta-title {
        font-size: 24px;
    }
}

@media(max-width: 480px) {
    .d-grid-5 {
        grid-template-columns: 1fr;
    }

    .d-fakta-grid {
        grid-template-columns: 1fr;
    }

    .d-edukasi-row {
        grid-template-columns: 1fr;
    }

    .d-hero-greeting {
        font-size: 22px;
    }
}
</style>

{{-- HERO --}}
<div class="d-hero">
    <div class="d-hero-content">
        <h1 class="d-hero-greeting">Welcome, <span>{{ $firstName }}</span>!</h1>
        <p class="d-hero-desc">
            Sistem Pakar Diagnosa Penyakit Sapi berbasis Metode Certainty Factor (CF)
            yang membantu proses identifikasi penyakit pada sapi berdasarkan gejala
            yang dipilih pengguna.
        </p>
        <a href="/diagnosa" class="d-hero-btn">
            Mulai Diagnosa
        </a>
    </div>
    <div class="d-hero-illustration">
        @if(file_exists(public_path('images/dashboard/cow-hero.png')))
            <img src="{{ asset('images/dashboard/cow-hero.png') }}" alt="Sapi">
        @else
            🐄
        @endif
    </div>
</div>

{{-- TENTANG SISTEM --}}
<div class="d-section">
    <div class="d-section-header">
        <div class="d-section-label">Informasi</div>
        <h2 class="d-section-title">Tentang Sistem</h2>
    </div>
    <div class="d-about-card">
        <div class="d-about-icon">🐮</div>
        <p>
            Sistem Pakar Diagnosa Penyakit Sapi merupakan aplikasi berbasis
            pengetahuan pakar yang membantu peternak melakukan identifikasi awal
            penyakit pada sapi secara cepat dan mudah.
        </p>
        <br>
        <p>
            Proses diagnosa menggunakan metode Certainty Factor (CF) untuk
            menghasilkan tingkat keyakinan terhadap kemungkinan penyakit
            berdasarkan gejala yang dipilih.
        </p>
    </div>
</div>

{{-- FAKTA --}}
<div class="d-section">
    <div class="d-section-header">
        <div class="d-section-label">Tahukah Anda</div>
        <h2 class="d-section-title">Fakta Menarik Tentang Sapi</h2>
    </div>
    <div class="d-fakta-grid">
        <div class="d-fakta-card">
            <div class="d-fakta-icon">🧠</div>
            <div class="d-fakta-body">
                <div class="d-fakta-title">Daya Ingat Kuat</div>
                <div class="d-fakta-desc">Sapi memiliki kemampuan mengingat lokasi dan individu yang pernah ditemuinya dalam waktu yang cukup lama.</div>
            </div>
        </div>
        <div class="d-fakta-card">
            <div class="d-fakta-icon">🫏</div>
            <div class="d-fakta-body">
                <div class="d-fakta-title">Empat Lambung</div>
                <div class="d-fakta-desc">Sapi merupakan hewan ruminansia yang memiliki empat bagian lambung untuk membantu proses pencernaan.</div>
            </div>
        </div>
        <div class="d-fakta-card">
            <div class="d-fakta-icon">🌿</div>
            <div class="d-fakta-body">
                <div class="d-fakta-title">Kualitas Hidup</div>
                <div class="d-fakta-desc">Kesehatan sapi sangat dipengaruhi oleh kualitas pakan, kebersihan kandang, dan ketersediaan air bersih.</div>
            </div>
        </div>
        <div class="d-fakta-card">
            <div class="d-fakta-icon">🔍</div>
            <div class="d-fakta-body">
                <div class="d-fakta-title">Deteksi Dini</div>
                <div class="d-fakta-desc">Deteksi dini penyakit dapat membantu mengurangi risiko penyebaran penyakit pada ternak lainnya.</div>
            </div>
        </div>
    </div>
</div>

{{-- MENGENAL PENYAKIT --}}
<div class="d-section">
    <div class="d-section-header">
        <div class="d-section-label">Daftar Penyakit</div>
        <h2 class="d-section-title">Mengenal Penyakit Pada Sapi</h2>
        <div class="d-section-subtitle">
            Berikut adalah daftar penyakit yang dapat didiagnosa oleh sistem
        </div>
    </div>
    <div class="d-grid-5">
        @foreach($penyakitList as $index => $item)
        <div class="d-penyakit-card">
            <div class="d-penyakit-img">
                @php $imgPath = 'images/penyakit/penyakit' . ($index + 1) . '.jpg'; @endphp
                @if(file_exists(public_path($imgPath)))
                    <img src="{{ asset($imgPath) }}" alt="{{ $item->nama_penyakit }}">
                @else
                    🐄
                @endif
            </div>
            <div class="d-penyakit-body">
                <div class="d-penyakit-name">{{ $item->nama_penyakit }}</div>
                <div class="d-penyakit-desc">{{ $item->deskripsi }}</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- EDUKASI --}}
<div class="d-section">
    <div class="d-section-header">
        <div class="d-section-label">Tips</div>
        <h2 class="d-section-title">Edukasi Peternakan</h2>
        <div class="d-section-subtitle">
            Informasi umum untuk menjaga kesehatan ternak sapi
        </div>
    </div>
    <div class="d-edukasi-grid">
        <div class="d-edukasi-row">
            @foreach(array_slice($edukasi, 0, 3) as $item)
            <div class="d-edukasi-card">
                <div class="d-edukasi-icon">{{ $item['icon'] }}</div>
                <div class="d-edukasi-title">{{ $item['title'] }}</div>
                <div class="d-edukasi-desc">{{ $item['desc'] }}</div>
            </div>
            @endforeach
        </div>
        <div class="d-edukasi-row row-2">
            <div class="d-edukasi-card">
                <div class="d-edukasi-icon">{{ $edukasi[3]['icon'] }}</div>
                <div class="d-edukasi-title">{{ $edukasi[3]['title'] }}</div>
                <div class="d-edukasi-desc">{{ $edukasi[3]['desc'] }}</div>
            </div>
            <div class="d-edukasi-center">
                <div class="d-edukasi-center-img">
                    @if(file_exists(public_path('images/dashboard/cow-center.png')))
                        <img src="{{ asset('images/dashboard/cow-center.png') }}" alt="Sapi">
                    @else
                        🐄
                    @endif
                </div>
                <div class="d-edukasi-center-caption">
                    Sapi Sehat,<br>Peternakan Hebat
                </div>
            </div>
            <div class="d-edukasi-card">
                <div class="d-edukasi-icon">{{ $edukasi[4]['icon'] }}</div>
                <div class="d-edukasi-title">{{ $edukasi[4]['title'] }}</div>
                <div class="d-edukasi-desc">{{ $edukasi[4]['desc'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="d-cta">
    <div class="d-cta-content">
        <h2 class="d-cta-title">Mulai Diagnosa Sekarang</h2>
        <p class="d-cta-desc">
            Lakukan identifikasi penyakit sapi berdasarkan gejala yang dialami
            dan dapatkan hasil diagnosa dengan metode Certainty Factor.
        </p>
        <a href="/diagnosa" class="d-cta-btn">
            Mulai Diagnosa
        </a>
    </div>
</div>

@endsection
