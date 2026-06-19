<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', config('app.name', 'SPK Diagnosa Penyakit Sapi'))</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Figtree',sans-serif;
}

body{
    min-height:100vh;
    background:linear-gradient(180deg,#eef5ff 0%,#dbeafe 40%,#bfdbfe 100%);
    color:#1e293b;
    overflow-x:hidden;
}

body::before{
    content:'';
    position:fixed;
    width:400px;
    height:400px;
    top:-150px;
    right:-150px;
    background:#60a5fa;
    border-radius:50%;
    filter:blur(180px);
    opacity:.12;
    z-index:-1;
}

body::after{
    content:'';
    position:fixed;
    width:350px;
    height:350px;
    bottom:-100px;
    left:-100px;
    background:#93c5fd;
    border-radius:50%;
    filter:blur(150px);
    opacity:.12;
    z-index:-1;
}

/* ================= SIDEBAR ================= */

.sidebar{
    width:260px;
    position:fixed;
    top:0;
    left:0;
    height:100vh;
    background:linear-gradient(180deg,#0f172a,#1e3a8a);
    color:white;
    display:flex;
    flex-direction:column;
    transition:transform .3s ease;
    z-index:1001;
    box-shadow:4px 0 20px rgba(0,0,0,.15);
}

.sidebar.collapsed{
    transform:translateX(-100%);
}

.sidebar-header{
    padding:24px 20px;
    border-bottom:1px solid rgba(255,255,255,.1);
    flex-shrink:0;
}

.sidebar-header h2{
    font-size:20px;
    font-weight:800;
    display:flex;
    align-items:center;
    gap:8px;
}

.sidebar-header p{
    margin-top:4px;
    font-size:12px;
    color:#93c5fd;
    letter-spacing:.5px;
    text-transform:uppercase;
    font-weight:600;
}

.sidebar-menu{
    flex:1;
    padding:16px 12px;
    overflow-y:auto;
}

.sidebar-menu .menu-label{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#64748b;
    padding:16px 12px 6px;
    font-weight:700;
}

.sidebar-menu a{
    display:flex;
    align-items:center;
    gap:10px;
    text-decoration:none;
    color:#cbd5e1;
    padding:10px 14px;
    margin-bottom:2px;
    border-radius:10px;
    font-weight:500;
    font-size:14px;
    transition:all .2s;
}

.sidebar-menu a:hover{
    background:rgba(255,255,255,.1);
    color:white;
}

.sidebar-menu a.active{
    background:rgba(255,255,255,.15);
    color:white;
    font-weight:600;
}

.sidebar-menu a .icon{
    width:20px;
    text-align:center;
    font-size:16px;
    flex-shrink:0;
}

.sidebar-user{
    padding:16px 20px;
    border-top:1px solid rgba(255,255,255,.1);
    flex-shrink:0;
}

.sidebar-user .user-info{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:10px;
}

.sidebar-user .user-avatar{
    width:36px;
    height:36px;
    border-radius:50%;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:14px;
    flex-shrink:0;
}

.sidebar-user .user-detail{
    min-width:0;
}

.sidebar-user .user-detail strong{
    display:block;
    font-size:14px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

.sidebar-user .user-detail small{
    font-size:11px;
    color:#93c5fd;
    text-transform:capitalize;
}

.logout-btn{
    width:100%;
    border:none;
    cursor:pointer;
    padding:9px;
    border-radius:8px;
    background:rgba(255,255,255,.12);
    color:white;
    font-weight:600;
    font-size:13px;
    transition:all .2s;
}

.logout-btn:hover{
    background:rgba(255,255,255,.2);
}

/* ================= OVERLAY ================= */

.overlay{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.4);
    backdrop-filter:blur(3px);
    z-index:1000;
    opacity:0;
    visibility:hidden;
    transition:all .3s;
}

.overlay.show{
    opacity:1;
    visibility:visible;
}

/* ================= MAIN ================= */

.layout{
    display:flex;
    min-height:100vh;
}

.main-wrapper{
    flex:1;
    display:flex;
    flex-direction:column;
    min-height:100vh;
    margin-left:260px;
    transition:margin-left .3s ease;
}

.sidebar.collapsed ~ .main-wrapper,
.sidebar.collapsed + .main-wrapper{
    margin-left:0;
}

.main-content{
    flex:1;
    padding:28px 32px;
    width:100%;
}

/* ================= TOPBAR ================= */

.topbar{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:24px;
}

.menu-toggle{
    width:42px;
    height:42px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    background:#1e3a8a;
    color:white;
    font-size:20px;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:all .2s;
    flex-shrink:0;
}

.menu-toggle:hover{
    background:#2563eb;
}

.topbar-title{
    font-size:22px;
    font-weight:700;
    color:#0f172a;
}

/* ================= GLASS CARD ================= */

.glass-card{
    background:rgba(255,255,255,.85);
    backdrop-filter:blur(12px);
    border-radius:20px;
    border:1px solid rgba(255,255,255,.7);
    padding:28px;
    box-shadow:0 8px 30px rgba(15,23,42,.06);
}

/* ================= ALERTS ================= */

.alert{
    padding:14px 18px;
    border-radius:12px;
    margin-bottom:20px;
    font-weight:600;
    font-size:14px;
}

.alert-success{
    background:#dcfce7;
    border:1px solid #86efac;
    color:#166534;
}

.alert-error{
    background:#fef2f2;
    border:1px solid #fca5a5;
    color:#991b1b;
}

.alert-info{
    background:#dbeafe;
    border:1px solid #93c5fd;
    color:#1e40af;
}

/* ================= TABLE ================= */

.table-container{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

thead th{
    background:#1e3a8a;
    color:white;
    padding:12px 14px;
    text-align:left;
    font-size:13px;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:.5px;
    white-space:nowrap;
}

thead th:first-child{
    border-radius:10px 0 0 0;
}

thead th:last-child{
    border-radius:0 10px 0 0;
}

tbody td{
    padding:12px 14px;
    border-bottom:1px solid #e2e8f0;
    font-size:14px;
}

tbody tr:hover{
    background:#f1f5f9;
}

tbody tr:last-child td{
    border-bottom:none;
}

/* ================= BUTTONS ================= */

.btn{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:10px 18px;
    border:none;
    border-radius:10px;
    font-weight:600;
    font-size:14px;
    cursor:pointer;
    text-decoration:none;
    transition:all .2s;
}

.btn-primary{
    background:#2563eb;
    color:white;
}

.btn-primary:hover{
    background:#1d4ed8;
    transform:translateY(-1px);
}

.btn-warning{
    background:#f59e0b;
    color:white;
}

.btn-warning:hover{
    background:#d97706;
}

.btn-danger{
    background:#ef4444;
    color:white;
}

.btn-danger:hover{
    background:#dc2626;
}

.btn-sm{
    padding:6px 12px;
    font-size:13px;
    border-radius:8px;
}

.btn-outline{
    background:transparent;
    border:1.5px solid #2563eb;
    color:#2563eb;
}

.btn-outline:hover{
    background:#2563eb;
    color:white;
}

/* ================= FORM ================= */

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:600;
    font-size:14px;
    color:#334155;
}

.form-control{
    width:100%;
    padding:11px 14px;
    border:1.5px solid #cbd5e1;
    border-radius:10px;
    outline:none;
    font-size:14px;
    transition:all .2s;
    background:white;
}

.form-control:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,.12);
}

textarea.form-control{
    resize:vertical;
    min-height:100px;
}

select.form-control{
    appearance:auto;
}

/* ================= BADGE ================= */

.badge{
    display:inline-block;
    padding:4px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.badge-primary{
    background:#dbeafe;
    color:#1d4ed8;
}

.badge-success{
    background:#dcfce7;
    color:#15803d;
}

.badge-warning{
    background:#fef3c7;
    color:#b45309;
}

/* ================= CARD STATS ================= */

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:16px;
    margin-bottom:24px;
}

.stat-card{
    background:rgba(255,255,255,.8);
    backdrop-filter:blur(8px);
    border-radius:16px;
    padding:20px;
    border:1px solid rgba(255,255,255,.6);
    transition:all .2s;
}

.stat-card:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 25px rgba(0,0,0,.06);
}

.stat-card .stat-icon{
    font-size:28px;
    margin-bottom:8px;
}

.stat-card .stat-label{
    font-size:13px;
    color:#64748b;
    font-weight:500;
}

.stat-card .stat-value{
    font-size:28px;
    font-weight:800;
    color:#0f172a;
    margin-top:2px;
}

/* ================= PAGE HEADER ================= */

.page-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
    gap:12px;
}

.page-header h1{
    font-size:22px;
    font-weight:700;
    color:#0f172a;
}

.page-header .subtitle{
    font-size:14px;
    color:#64748b;
    margin-top:2px;
}

/* ================= CHECKBOX LIST ================= */

.checkbox-list{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
    gap:10px;
}

.checkbox-item{
    display:flex;
    align-items:center;
    gap:10px;
    padding:10px 14px;
    background:rgba(255,255,255,.6);
    border-radius:10px;
    border:1px solid #e2e8f0;
    transition:all .2s;
    cursor:pointer;
}

.checkbox-item:hover{
    background:rgba(255,255,255,.9);
    border-color:#93c5fd;
}

.checkbox-item input[type=checkbox]{
    width:18px;
    height:18px;
    accent-color:#2563eb;
    flex-shrink:0;
}

.checkbox-item .gejala-code{
    font-weight:600;
    color:#2563eb;
    font-size:13px;
    flex-shrink:0;
}

.checkbox-item .gejala-name{
    font-size:14px;
    color:#334155;
}

/* ================= FOOTER ================= */

footer{
    background:linear-gradient(135deg,#0f172a,#1e3a8a);
    border-top:2px solid #3b82f6;
    flex-shrink:0;
}

.footer-container{
    padding:14px 28px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
}

.footer-left{
    display:flex;
    align-items:center;
    gap:10px;
}

.footer-logo{
    width:36px;
    height:36px;
    border-radius:50%;
    object-fit:cover;
}

.footer-text{
    color:white;
    font-size:14px;
}

.footer-text small{
    color:#93c5fd;
    font-size:12px;
}

.copyright{
    color:#94a3b8;
    font-size:13px;
}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .main-wrapper{
        margin-left:0;
    }

    .sidebar{
        transform:translateX(-100%);
    }

    .sidebar.open{
        transform:translateX(0);
    }

    .main-content{
        padding:20px 16px;
    }

    .stats-grid{
        grid-template-columns:repeat(auto-fit,minmax(150px,1fr));
    }

    .checkbox-list{
        grid-template-columns:1fr;
    }

    .topbar-title{
        font-size:18px;
    }

    .footer-container{
        flex-direction:column;
        text-align:center;
    }
}

@media(min-width:769px){

    .sidebar.collapsed{
        transform:translateX(-100%);
    }
}

/* ================= EMPTY STATE ================= */

.empty-state{
    text-align:center;
    padding:40px 20px;
    color:#64748b;
}

.empty-state .icon{
    font-size:48px;
    margin-bottom:12px;
    opacity:.5;
}

.empty-state h3{
    font-size:18px;
    color:#334155;
    margin-bottom:6px;
}

.empty-state p{
    font-size:14px;
}

/* ================= RESULT CARD ================= */

.result-card{
    background:rgba(255,255,255,.8);
    border-radius:16px;
    padding:24px;
    border:1px solid rgba(255,255,255,.6);
    margin-bottom:16px;
}

.result-card .rank{
    font-size:13px;
    color:#64748b;
    font-weight:600;
    margin-bottom:4px;
}

.result-card .disease-name{
    font-size:18px;
    font-weight:700;
    color:#0f172a;
    margin-bottom:4px;
}

.result-card .cf-value{
    font-size:24px;
    font-weight:800;
    color:#2563eb;
}

.result-card.highlight{
    border:2px solid #2563eb;
    background:rgba(37,99,235,.06);
}

</style>
</head>
<body>

<div class="overlay" id="overlay"></div>

<div class="layout">

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">
            <h2>SPK Sapi</h2>
            <p>Forward Chaining</p>
        </div>

        <div class="sidebar-menu">

            <div class="menu-label">Utama</div>

            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <span class="icon"></span> Dashboard
            </a>

            @if(Auth::user()->role == 'admin')

                <div class="menu-label">Master Data</div>

                <a href="/penyakit" class="{{ request()->is('penyakit*') ? 'active' : '' }}">
                    <span class="icon"></span> Data Penyakit
                </a>

                <a href="/gejala" class="{{ request()->is('gejala*') ? 'active' : '' }}">
                    <span class="icon"></span> Data Gejala
                </a>

                <a href="/solusi" class="{{ request()->is('solusi*') ? 'active' : '' }}">
                    <span class="icon"></span> Data Solusi
                </a>

                <a href="/aturan" class="{{ request()->is('aturan*') ? 'active' : '' }}">
                    <span class="icon"></span> Data Aturan
                </a>

                <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">
                    <span class="icon"></span> Data User
                </a>

                <div class="menu-label">Diagnosa</div>

                <a href="/riwayat-diagnosa" class="{{ request()->is('riwayat-diagnosa*') ? 'active' : '' }}">
                    <span class="icon"></span> Riwayat Diagnosa
                </a>

            @else

                <div class="menu-label">Diagnosa</div>

                <a href="/diagnosa" class="{{ request()->is('diagnosa') && !request()->is('diagnosa/*') ? 'active' : '' }}">
                    <span class="icon"></span> Diagnosa
                </a>

                <a href="/riwayat-diagnosa" class="{{ request()->is('riwayat-diagnosa*') ? 'active' : '' }}">
                    <span class="icon"></span> Hasil Diagnosa
                </a>

            @endif

            <div class="menu-label">Akun</div>

            <a href="/profile" class="{{ request()->is('profile*') ? 'active' : '' }}">
                <span class="icon"></span> Profil
            </a>

        </div>

        <div class="sidebar-user">

            <div class="user-info">

                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="user-detail">

                    <strong>{{ Auth::user()->name }}</strong>

                    <small>{{ Auth::user()->role }}</small>

                </div>

            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    Logout
                </button>
            </form>

        </div>

    </aside>

    <div class="main-wrapper">

        <main class="main-content">

            <div class="topbar">

                <button class="menu-toggle" id="toggleBtn">☰</button>

                <div class="topbar-title">
                    @yield('title-section', 'Dashboard')
                </div>

            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

        <footer>

            <div class="footer-container">

                <div class="footer-left">

                    <img src="{{ asset('images/logo-kampus.png') }}" class="footer-logo" alt="Logo">

                    <div class="footer-text">
                        <strong>Universitas Al-Khairiyah</strong>
                        <small>Sistem Pakar Diagnosa Penyakit Sapi</small>
                    </div>

                </div>

                <div class="copyright">
                    © {{ date('Y') }} Daniel Fahmi • 24040060
                </div>

            </div>

        </footer>

    </div>

</div>

<script>

const sidebar = document.getElementById('sidebar');
const overlay = document.getElementById('overlay');
const toggleBtn = document.getElementById('toggleBtn');

function isMobile(){
    return window.innerWidth <= 768;
}

function openSidebar(){
    if(isMobile()){
        sidebar.classList.add('open');
    }else{
        sidebar.classList.remove('collapsed');
    }
    overlay.classList.add('show');
}

function closeSidebar(){
    if(isMobile()){
        sidebar.classList.remove('open');
    }else{
        sidebar.classList.add('collapsed');
    }
    overlay.classList.remove('show');
}

toggleBtn.addEventListener('click', function(e){
    e.stopPropagation();
    const isOpen = isMobile()
        ? sidebar.classList.contains('open')
        : !sidebar.classList.contains('collapsed');
    if(isOpen){
        closeSidebar();
    }else{
        openSidebar();
    }
});

overlay.addEventListener('click', closeSidebar);

document.querySelectorAll('.sidebar-menu a').forEach(function(link){
    link.addEventListener('click', function(){
        if(isMobile()){
            closeSidebar();
        }
    });
});

if(!isMobile()){
    sidebar.classList.add('collapsed');
}

</script>

</body>
</html>
