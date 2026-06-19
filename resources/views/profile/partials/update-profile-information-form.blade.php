<section>
    <header>
        <h2 style="font-size:18px;font-weight:700;color:#0f172a;margin-bottom:4px;">
            Informasi Profil
        </h2>
        <p style="color:#64748b;font-size:14px;margin-bottom:20px;">
            Update informasi profil dan email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

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

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top:8px;">
                    <p style="font-size:13px;color:#64748b;">
                        Email Anda belum terverifikasi.
                        <button form="send-verification" style="background:none;border:none;color:#2563eb;font-weight:600;cursor:pointer;text-decoration:underline;font-size:13px;">
                            Klik untuk kirim ulang verifikasi
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p style="margin-top:6px;font-size:13px;color:#15803d;font-weight:600;">
                            Tautan verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div style="display:flex;align-items:center;gap:12px;margin-top:20px;">
            <button type="submit" class="btn btn-primary">Simpan</button>

            @if (session('status') === 'profile-updated')
                <span style="font-size:14px;color:#15803d;font-weight:600;">Tersimpan.</span>
            @endif
        </div>
    </form>
</section>
