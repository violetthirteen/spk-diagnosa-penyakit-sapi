<section>
    <header>
        <h2 style="font-size:18px;font-weight:700;color:#0f172a;margin-bottom:4px;">
            Update Password
        </h2>
        <p style="color:#64748b;font-size:14px;margin-bottom:20px;">
            Pastikan akun Anda menggunakan password yang panjang dan acak untuk keamanan.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password', 'updatePassword')
                <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password', 'updatePassword')
                <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Konfirmasi Password Baru</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
                <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display:flex;align-items:center;gap:12px;margin-top:20px;">
            <button type="submit" class="btn btn-primary">Simpan</button>

            @if (session('status') === 'password-updated')
                <span style="font-size:14px;color:#15803d;font-weight:600;">Tersimpan.</span>
            @endif
        </div>
    </form>
</section>
