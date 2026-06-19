@extends('layouts.app')

@section('title-section', 'Profil')

@section('content')

<style>

.p-container{
    max-width:1000px;
    margin:0 auto;
}

.p-header{
    background:linear-gradient(135deg,#1e3a8a,#2563eb);
    border-radius:24px;
    padding:36px 40px;
    margin-bottom:28px;
    display:flex;
    align-items:center;
    gap:28px;
    position:relative;
    overflow:hidden;
}

.p-header::before{
    content:'';
    position:absolute;
    width:400px;
    height:400px;
    background:rgba(255,255,255,.04);
    border-radius:50%;
    top:-150px;
    right:-80px;
}

.p-avatar-wrap{
    position:relative;
    flex-shrink:0;
}

.p-avatar{
    width:88px;
    height:88px;
    border-radius:50%;
    border:3px solid rgba(255,255,255,.3);
    object-fit:cover;
    display:flex;
    align-items:center;
    justify-content:center;
    background:rgba(255,255,255,.15);
    font-size:32px;
    font-weight:700;
    color:white;
    overflow:hidden;
    position:relative;
}

.p-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.p-avatar-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.5);
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    opacity:0;
    transition:opacity .25s;
    cursor:pointer;
    color:white;
    font-size:14px;
    font-weight:600;
}

.p-avatar-wrap:hover .p-avatar-overlay{
    opacity:1;
}

.p-header-info{
    position:relative;
    z-index:1;
    min-width:0;
}

.p-header-name{
    font-size:22px;
    font-weight:800;
    color:white;
    margin-bottom:2px;
}

.p-header-email{
    font-size:14px;
    color:#bfdbfe;
    margin-bottom:6px;
}

.p-header-meta{
    display:flex;
    align-items:center;
    gap:10px;
    flex-wrap:wrap;
}

.p-header-role{
    display:inline-block;
    padding:3px 12px;
    background:rgba(255,255,255,.15);
    border-radius:999px;
    font-size:12px;
    font-weight:600;
    color:white;
    text-transform:capitalize;
}

.p-header-joined{
    font-size:12px;
    color:#93c5fd;
}

.p-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
    margin-bottom:28px;
}

.p-card{
    background:#fff;
    border-radius:20px;
    padding:28px;
    box-shadow:0 4px 20px rgba(15,23,42,.05);
    border:1px solid #e2e8f0;
    transition:box-shadow .25s;
}

.p-card:hover{
    box-shadow:0 8px 30px rgba(15,23,42,.08);
}

.p-card-title{
    font-size:16px;
    font-weight:700;
    color:#0f172a;
    margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:2px solid #2563eb;
    display:flex;
    align-items:center;
    gap:8px;
}

.p-card-title .icon{
    color:#2563eb;
}

@media(max-width:768px){
    .p-header{
        flex-direction:column;
        text-align:center;
        padding:28px 24px;
    }
    .p-header-meta{
        justify-content:center;
    }
    .p-grid{
        grid-template-columns:1fr;
    }
}

</style>

<div class="p-container">

    {{-- PROFILE HEADER --}}
    <div class="p-header">
        <div class="p-avatar-wrap">
            <div class="p-avatar" id="avatarDisplay">
                @if($user->photo && file_exists(public_path($user->photo)))
                    <img src="{{ asset($user->photo) . '?v=' . filemtime(public_path($user->photo)) }}" alt="{{ $user->name }}">
                @else
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                @endif
            </div>
            <div class="p-avatar-overlay" id="avatarOverlay">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            </div>
        </div>
        <div class="p-header-info">
            <div class="p-header-name">{{ $user->name }}</div>
            <div class="p-header-email">{{ $user->email }}</div>
            <div class="p-header-meta">
                <span class="p-header-role">{{ $user->role }}</span>
                <span class="p-header-joined">Bergabung {{ $user->created_at->format('d F Y') }}</span>
            </div>
        </div>
    </div>

    {{-- FORM GRID --}}
    <div class="p-grid">

        {{-- CARD 1: INFORMASI AKUN --}}
        <div class="p-card">
            <div class="p-card-title">
                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Informasi Akun
            </div>

            <form method="post" action="{{ route('profile.update', absolute: false) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <input type="file" id="photoInput" name="photo" accept=".jpg,.jpeg,.png,.webp" style="display:none;">

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    @error('name')
                        <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
                    @error('email')
                        <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;align-items:center;gap:12px;margin-top:24px;">
                    <button type="submit" class="btn btn-primary" id="saveProfileBtn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:4px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span style="font-size:14px;color:#15803d;font-weight:600;">Tersimpan.</span>
                    @endif
                </div>
            </form>
        </div>

        {{-- CARD 2: KEAMANAN --}}
        <div class="p-card">
            <div class="p-card-title">
                <svg class="icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Keamanan
            </div>

            <form method="post" action="{{ route('password.update', absolute: false) }}">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password">Password Saat Ini</label>
                    <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
                    @error('current_password', 'updatePassword')
                        <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password Baru</label>
                    <input id="password" name="password" type="password" class="form-control" autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                    @error('password_confirmation', 'updatePassword')
                        <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;align-items:center;gap:12px;margin-top:24px;">
                    <button type="submit" class="btn btn-primary" id="savePasswordBtn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:4px;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <span style="font-size:14px;color:#15803d;font-weight:600;">Tersimpan.</span>
                    @endif
                </div>
            </form>
        </div>

    </div>

</div>

<script>
document.getElementById('avatarOverlay').addEventListener('click', function(){
    document.getElementById('photoInput').click();
});

document.getElementById('photoInput').addEventListener('change', function(e){
    if(this.files && this.files[0]){
        var reader = new FileReader();
        reader.onload = function(ev){
            var display = document.getElementById('avatarDisplay');
            display.innerHTML = '<img src="' + ev.target.result + '" alt="Preview">';
        }
        reader.readAsDataURL(this.files[0]);
    }
});

document.getElementById('saveProfileBtn').addEventListener('click', function(){
    this.innerHTML = 'Menyimpan...';
    this.disabled = true;
    this.form.submit();
});

document.getElementById('savePasswordBtn').addEventListener('click', function(){
    this.innerHTML = 'Menyimpan...';
    this.disabled = true;
    this.form.submit();
});
</script>

@endsection
