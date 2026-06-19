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

html{
    height:100%;
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
    flex-shrink:0;
    height:100vh;
    position:sticky;
    top:0;
    background:linear-gradient(180deg,#0f172a,#1e3a8a);
    color:white;
    display:flex;
    flex-direction:column;
    transition:transform .3s ease, width .3s ease, min-width .3s ease;
    z-index:1001;
    box-shadow:4px 0 20px rgba(0,0,0,.15);
    overflow:hidden;
}

.sidebar.collapsed{
    width:0;
    min-width:0;
    transform:none;
}

.sidebar.collapsed{
    transform:translateX(-100%);
}

.sidebar-header{
    padding:24px 20px 18px;
    border-bottom:1px solid rgba(255,255,255,.1);
    flex-shrink:0;
    text-align:center;
}

.sidebar-logo{
    margin-bottom:14px;
}

.logo-icon{
    width:56px;
    height:56px;
    border-radius:50%;
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    border:2px solid rgba(255,255,255,.18);
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto;
    box-shadow:0 4px 16px rgba(37,99,235,.3);
    transition:box-shadow .3s;
}

.logo-icon svg{
    width:28px;
    height:28px;
    color:white;
}

.sidebar-brand h2{
    font-size:17px;
    font-weight:800;
    color:white;
    margin-bottom:3px;
    letter-spacing:.3px;
}

.sidebar-brand .brand-sub{
    font-size:10.5px;
    color:#93c5fd;
    line-height:1.4;
    margin-bottom:10px;
    font-weight:500;
}

.sidebar-brand .brand-method{
    display:inline-block;
    padding:2px 10px;
    background:linear-gradient(135deg,rgba(37,99,235,.2),rgba(99,102,241,.15));
    border:1px solid rgba(99,102,241,.2);
    border-radius:999px;
    font-size:9px;
    color:#a5b4fc;
    font-weight:600;
    letter-spacing:.5px;
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
    position:relative;
}

.sidebar-menu a:hover{
    background:rgba(255,255,255,.08);
    color:white;
}

.sidebar-menu a.active{
    background:rgba(37,99,235,.2);
    color:white;
    font-weight:600;
}

.sidebar-menu a.active::before{
    content:'';
    position:absolute;
    left:0;
    top:50%;
    transform:translateY(-50%);
    width:3px;
    height:18px;
    background:#60a5fa;
    border-radius:0 2px 2px 0;
}

.sidebar-menu a .icon{
    width:20px;
    height:20px;
    flex-shrink:0;
    display:flex;
    align-items:center;
    justify-content:center;
}

.sidebar-menu a .icon svg{
    width:18px;
    height:18px;
    stroke:currentColor;
    fill:none;
    stroke-width:2;
    stroke-linecap:round;
    stroke-linejoin:round;
}

.sidebar-user{
    padding:14px 16px;
    border-top:1px solid rgba(255,255,255,.08);
    flex-shrink:0;
}

.sidebar-user .user-info{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:12px;
}

.sidebar-user .user-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    background:rgba(255,255,255,.12);
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    font-size:15px;
    flex-shrink:0;
    color:white;
}

.sidebar-user .user-detail{
    min-width:0;
}

.sidebar-user .user-detail strong{
    display:block;
    font-size:13px;
    font-weight:600;
    color:white;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
    line-height:1.3;
}

.sidebar-user .user-detail small{
    font-size:10.5px;
    color:#94a3b8;
    text-transform:capitalize;
}

.logout-btn{
    width:100%;
    height:50px;
    border:none;
    cursor:pointer;
    border-radius:10px;
    background:rgba(255,255,255,.08);
    color:#e2e8f0;
    font-weight:600;
    font-size:13px;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    transition:all .2s;
}

.logout-btn:hover{
    background:rgba(255,255,255,.15);
    color:white;
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
    min-width:0;
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
    color:white;
}

.footer-container{
    max-width:1300px;
    margin:auto;
    padding:18px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.footer-left{
    display:flex;
    align-items:center;
    gap:10px;
}

.footer-left img{
    width:40px;
    height:40px;
}

.footer-left small{
    color:#cbd5e1;
}

/* ================= MOBILE ================= */

@media(max-width:768px){

    .main-wrapper{
        margin-left:0;
        min-height:100vh;
    }

    .sidebar{
        position:fixed;
        top:0;
        left:0;
        height:100vh;
        width:260px;
        min-width:260px;
        transform:translateX(-100%);
        z-index:1001;
    }

    .sidebar.open{
        transform:translateX(0);
    }

    .sidebar.collapsed{
        width:260px;
        min-width:260px;
        transform:translateX(-100%);
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
        gap:10px;
        text-align:center;
    }

    .footer-left{
        flex-direction:column;
        text-align:center;
    }
}

@media(min-width:769px){

    .sidebar.collapsed{
        width:0;
        min-width:0;
        transform:none;
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

/* ================= RESPONSIVE GLOBAL ================= */

/* Tablet */
@media(max-width:1024px){
    .d-grid-5{
        grid-template-columns:repeat(2,1fr);
    }
    .d-fakta-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

/* Mobile large */
@media(max-width:768px){
    .glass-card{
        padding:18px !important;
    }
    .page-header{
        flex-direction:column;
        align-items:flex-start;
    }
    .page-header h1{
        font-size:18px;
    }
    .page-header .subtitle{
        font-size:13px;
    }
    .form-control{
        font-size:16px;
    }
    .btn{
        min-height:44px;
        padding:10px 20px;
    }
    .btn-sm{
        min-height:36px;
        padding:6px 14px;
        font-size:13px;
    }
    .main-content{
        padding:16px !important;
    }
    .pagination li a,.pagination li span{
        padding:8px 10px;
        font-size:12px;
    }
    .stats-grid{
        grid-template-columns:repeat(2,1fr);
        gap:12px;
    }
    .checkbox-list{
        grid-template-columns:1fr;
    }
    thead th,tbody td{
        padding:10px 10px;
        font-size:13px;
        white-space:nowrap;
    }
    .stat-card{
        padding:16px;
    }
    .stat-card .stat-value{
        font-size:22px;
    }
    .topbar-title{
        font-size:16px;
    }
    .menu-toggle{
        width:38px;
        height:38px;
        font-size:18px;
    }
    .table-container form[style*="display:flex"]{
        flex-direction:column;
        max-width:100% !important;
    }
    .table-container form[style*="display:flex"] .form-control{
        width:100% !important;
    }
    .table-container form[style*="display:flex"] .btn{
        width:100%;
    }
    .table-container form[style*="display:flex"] a{
        width:100%;
        text-align:center;
    }
    form[method="GET"] div[style*="display:flex"]{
        flex-direction:column;
        max-width:100% !important;
    }
    form[method="GET"] div[style*="display:flex"] .form-control{
        width:100% !important;
    }
    form[method="GET"] div[style*="display:flex"] .btn,
    form[method="GET"] div[style*="display:flex"] a{
        width:100%;
        text-align:center;
    }
    select.form-control[style*="width:200px"]{
        width:100% !important;
        max-width:100% !important;
    }
    .report-header{
        padding:20px 16px !important;
    }
    .report-header h1{
        font-size:16px !important;
    }
    div[style*="max-width:780px"],
    div[style*="max-width: 780px"]{
        width:100%;
    }
    div[style*="max-width:780px"] > div[style*="padding:"],
    div[style*="max-width: 780px"] > div[style*="padding:"]{
        padding-left:16px !important;
        padding-right:16px !important;
    }
    .d-section{
        margin-bottom:32px;
    }
    .d-section-title{
        font-size:20px;
    }
    .d-section-subtitle{
        font-size:13px;
    }
    .d-about-card{
        padding:24px 16px !important;
    }
    .d-penyakit-body{
        padding:14px 16px 18px;
    }
    .d-penyakit-name{
        font-size:14px;
    }
    .d-edukasi-card{
        padding:20px 16px;
    }
    .d-cta{
        padding:36px 20px !important;
    }
    .d-cta-title{
        font-size:22px;
    }
    .d-cta-desc{
        font-size:14px;
    }
    .d-cta-btn{
        padding:14px 28px;
        font-size:14px;
    }
    .d-hero-btn{
        padding:12px 24px;
        font-size:14px;
    }
    .d-hero-desc{
        font-size:14px;
    }
    div[style*="display:flex"] a[target="_blank"],
    a[href*="riwayat-diagnosa"],
    a[href*="diagnosa"]{
        min-height:44px;
        display:inline-flex;
        align-items:center;
    }
    table tbody td:last-child{
        white-space:nowrap;
    }
    .empty-state{
        padding:24px 12px;
    }
}

/* Mobile small */
@media(max-width:480px){
    .d-grid-5{
        grid-template-columns:1fr;
    }
    .d-fakta-grid{
        grid-template-columns:1fr;
    }
    .d-edukasi-row{
        grid-template-columns:1fr !important;
    }
    .d-edukasi-center{
        display:none !important;
    }
    .stats-grid{
        grid-template-columns:1fr;
    }
    .d-hero{
        padding:28px 16px !important;
    }
    .d-hero-greeting{
        font-size:20px;
    }
    .d-cta{
        padding:28px 16px !important;
    }
    .d-cta-title{
        font-size:20px;
    }
    .d-section-title{
        font-size:18px;
    }
}

</style>

@stack('styles')
</head>
<body>

<div class="overlay" id="overlay"></div>

<div class="layout">

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-header">

            <div class="sidebar-logo">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                </div>
            </div>

            <div class="sidebar-brand">
                <h2>SPK Penyakit Sapi</h2>
                <p class="brand-sub">Sistem Pakar Diagnosa Penyakit Pada Sapi</p>
                <span class="brand-method">Metode CF</span>
            </div>

        </div>

        <div class="sidebar-menu">

            <div class="menu-label">Utama</div>

            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <span class="icon"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg></span> Dashboard
            </a>

            @if(Auth::user()->role == 'admin')

                <div class="menu-label">Master Data</div>

                <a href="/penyakit" class="{{ request()->is('penyakit*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/></svg></span> Data Penyakit
                </a>

                <a href="/gejala" class="{{ request()->is('gejala*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><rect x="8" y="2" width="8" height="4" rx="1"/><path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/><path d="M12 11h4"/><path d="M12 16h4"/><path d="M8 11h.01"/><path d="M8 16h.01"/></svg></span> Data Gejala
                </a>

                <a href="/solusi" class="{{ request()->is('solusi*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M15.09 14c.18-.98.65-1.74 1.41-2.5A4.65 4.65 0 0018 8 6 6 0 006 8c0 1 .23 2.23 1.5 3.5A4.61 4.61 0 018.91 14"/></svg></span> Data Solusi
                </a>

                <a href="/aturan" class="{{ request()->is('aturan*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><line x1="6" y1="3" x2="6" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 01-9 9"/></svg></span> Data Aturan
                </a>

                <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg></span> Data User
                </a>

                <div class="menu-label">Diagnosa</div>

                <a href="/riwayat-diagnosa" class="{{ request()->is('riwayat-diagnosa*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span> Riwayat Diagnosa
                </a>

            @else

                <div class="menu-label">Diagnosa</div>

                <a href="/diagnosa" class="{{ request()->is('diagnosa') && !request()->is('diagnosa/*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M11 2v2"/><path d="M5 2v2"/><path d="M5 3H4a2 2 0 00-2 2v4a6 6 0 006 6"/><path d="M9 15v1a6 6 0 006 6v0a6 6 0 006-6v-2"/><circle cx="17" cy="10" r="2"/><path d="M8 2h6"/></svg></span> Diagnosa
                </a>

                <a href="/riwayat-diagnosa" class="{{ request()->is('riwayat-diagnosa*') ? 'active' : '' }}">
                    <span class="icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg></span> Hasil Diagnosa
                </a>

            @endif

            <div class="menu-label">Akun</div>

            <a href="/profile" class="{{ request()->is('profile*') ? 'active' : '' }}">
                <span class="icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 00-16 0"/></svg></span> Profil
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
                    <svg viewBox="0 0 24 24" width="18" height="18"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
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

                    <img src="{{ asset('images/logo-kampus.png') }}" alt="Logo">

                    <div>
                        <strong>Universitas Al-Khairiyah</strong>
                        <br>
                        <small>Sistem Pakar Diagnosa Penyakit Sapi</small>
                    </div>

                </div>

                <div>
                    &copy; {{ date('Y') }} Daniel Fahmi &bull; 24040060
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
