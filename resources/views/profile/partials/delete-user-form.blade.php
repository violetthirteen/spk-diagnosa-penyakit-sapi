<section>
    <header>
        <h2 style="font-size:18px;font-weight:700;color:#dc2626;margin-bottom:4px;">
            Hapus Akun
        </h2>
        <p style="color:#64748b;font-size:14px;margin-bottom:20px;">
            Setelah akun dihapus, semua data akan terhapus secara permanen. Harap unduh data yang ingin disimpan sebelumnya.
        </p>
    </header>

    <button type="button" class="btn btn-danger"
        onclick="document.getElementById('delete-confirm-modal').style.display='flex'">
        Hapus Akun
    </button>

    <div id="delete-confirm-modal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);backdrop-filter:blur(4px);z-index:9999;align-items:center;justify-content:center;"
         onclick="if(event.target===this)this.style.display='none'">
        <div style="background:white;border-radius:20px;padding:30px;max-width:450px;width:90%;box-shadow:0 20px 60px rgba(0,0,0,.2);">
            <h3 style="font-size:18px;font-weight:700;color:#0f172a;margin-bottom:8px;">Yakin ingin menghapus akun?</h3>
            <p style="color:#64748b;font-size:14px;margin-bottom:20px;">
                Masukkan password Anda untuk konfirmasi penghapusan akun.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="form-group">
                    <label for="password-delete">Password</label>
                    <input id="password-delete" name="password" type="password" class="form-control" placeholder="Masukkan password">
                    @error('password', 'userDeletion')
                        <div style="color:#dc2626;font-size:13px;margin-top:4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="display:flex;gap:10px;justify-content:flex-end;margin-top:20px;">
                    <button type="button" class="btn btn-outline" onclick="document.getElementById('delete-confirm-modal').style.display='none'">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</section>
