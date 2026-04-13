<x-sidebar-layout>
    <x-slot name="header">
        <a href="{{ route('dashboard') }}"
            class="inline-flex items-center gap-2 px-3 py-1.5 mb-5 text-[13px] font-medium text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Dashboard
        </a>
        <div style="font-family:'DM Serif Display',serif; font-size:26px; color:#1A1A18;">Profil Saya</div>
        <div style="color:#8A8A7A; font-size:13px; margin-top:4px;">Kelola informasi akun dan keamanan</div>
    </x-slot>

    <div style="max-width:560px;">

        {{-- Header Profil --}}
        <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:24px 28px; margin-bottom:20px; display:flex; align-items:center; gap:16px;">
            <div style="width:52px; height:52px; border-radius:50%; background:#D4621A; display:flex; align-items:center; justify-content:center; font-size:18px; font-weight:700; color:#fff; flex-shrink:0;">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            <div>
                <div style="font-size:16px; font-weight:600; color:#1A1A18;">{{ $user->name }}</div>
                <div style="font-size:13px; color:#8A8A7A; margin-top:2px;">{{ $user->email }}</div>
                <div style="display:inline-block; margin-top:6px; font-size:11px; font-weight:500; padding:2px 10px; border-radius:20px;
                    {{ $user->role === 'admin' ? 'background:#DBEAFE; color:#1E4A8A;' : 'background:#F0EDE8; color:#4A4A42;' }}">
                    {{ ucfirst($user->role) }}
                </div>
            </div>
        </div>

        {{-- Card dengan Tab --}}
        <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; overflow:hidden;">

            {{-- Tab Bar --}}
            <div style="display:flex; border-bottom:1.5px solid #D8D4CC;">
                <button onclick="switchTab('profil', this)"
                    id="tab-profil"
                    style="flex:1; padding:13px 0; font-size:13px; font-weight:500; color:#1A1A18; background:none; border:none; border-bottom:2px solid #1A1A18; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.15s;">
                    Informasi Profil
                </button>
                <button onclick="switchTab('password', this)"
                    id="tab-password"
                    style="flex:1; padding:13px 0; font-size:13px; font-weight:400; color:#8A8A7A; background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.15s;">
                    Ubah Password
                </button>
                <button onclick="switchTab('hapus', this)"
                    id="tab-hapus"
                    style="flex:1; padding:13px 0; font-size:13px; font-weight:400; color:#8A8A7A; background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.15s;">
                    Hapus Akun
                </button>
            </div>

            {{-- Tab: Informasi Profil --}}
            <div id="panel-profil" class="profil-panel" style="padding:28px 32px;">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div style="margin-bottom:18px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#D4621A';this.style.boxShadow='0 0 0 3px rgba(212,98,26,0.1)'"
                            onblur="this.style.borderColor='#D8D4CC';this.style.boxShadow=''">
                        @error('name') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#D4621A';this.style.boxShadow='0 0 0 3px rgba(212,98,26,0.1)'"
                            onblur="this.style.borderColor='#D8D4CC';this.style.boxShadow=''">
                        @error('email') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="display:flex; align-items:center; gap:14px; padding-top:4px; border-top:1.5px solid #F0EDE8;">
                        <button type="submit"
                            style="padding:10px 24px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;"
                            onmouseover="this.style.background='#BF5515'" onmouseout="this.style.background='#D4621A'">
                            Simpan Perubahan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <span style="font-size:13px; color:#2D7A4F; display:flex; align-items:center; gap:5px;">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7l4 4 6-6" stroke="#2D7A4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Berhasil disimpan
                            </span>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tab: Ubah Password --}}
            <div id="panel-password" class="profil-panel" style="display:none; padding:28px 32px;">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div style="margin-bottom:18px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Password Saat Ini</label>
                        <input type="password" name="current_password" autocomplete="current-password"
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#D4621A'" onblur="this.style.borderColor='#D8D4CC'">
                        @error('current_password', 'updatePassword') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom:18px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Password Baru</label>
                        <input type="password" name="password" autocomplete="new-password"
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#D4621A'" onblur="this.style.borderColor='#D8D4CC'">
                        @error('password', 'updatePassword') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" autocomplete="new-password"
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#D4621A'" onblur="this.style.borderColor='#D8D4CC'">
                    </div>

                    <div style="display:flex; align-items:center; gap:14px; padding-top:4px; border-top:1.5px solid #F0EDE8;">
                        <button type="submit"
                            style="padding:10px 24px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;"
                            onmouseover="this.style.background='#BF5515'" onmouseout="this.style.background='#D4621A'">
                            Simpan Password
                        </button>
                        @if (session('status') === 'password-updated')
                            <span style="font-size:13px; color:#2D7A4F; display:flex; align-items:center; gap:5px;">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7l4 4 6-6" stroke="#2D7A4F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                Password berhasil diperbarui
                            </span>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Tab: Hapus Akun --}}
            <div id="panel-hapus" class="profil-panel" style="display:none; padding:28px 32px;">
                <div style="background:#FEF2F2; border:1.5px solid #FCA5A5; border-radius:10px; padding:16px 18px; margin-bottom:24px; display:flex; gap:12px; align-items:flex-start;">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" style="flex-shrink:0; margin-top:1px;">
                        <path d="M9 1.5L1.5 15h15L9 1.5z" stroke="#DC2626" stroke-width="1.3" fill="none" stroke-linejoin="round"/>
                        <path d="M9 7v4M9 12.5v.5" stroke="#DC2626" stroke-width="1.3" stroke-linecap="round"/>
                    </svg>
                    <div>
                        <div style="font-size:13px; font-weight:600; color:#DC2626; margin-bottom:4px;">Tindakan ini tidak dapat dibatalkan</div>
                        <div style="font-size:13px; color:#6B7280; line-height:1.6;">Setelah akun dihapus, semua data termasuk laporan yang pernah dibuat akan dihapus secara permanen.</div>
                    </div>
                </div>

                <button type="button" onclick="document.getElementById('modal-hapus').style.display='flex'"
                    style="padding:10px 24px; background:#DC2626; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;"
                    onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#DC2626'">
                    Hapus Akun Saya
                </button>
            </div>

        </div>
    </div>

    {{-- Modal Hapus Akun --}}
    <div id="modal-hapus" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:999; align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:14px; padding:32px; max-width:420px; width:90%;">
            <div style="font-family:'DM Serif Display',serif; font-size:20px; color:#1A1A18; margin-bottom:8px;">Hapus Akun?</div>
            <p style="font-size:13px; color:#8A8A7A; line-height:1.6; margin-bottom:20px;">
                Setelah akun dihapus, semua data akan dihapus secara permanen. Masukkan password untuk konfirmasi.
            </p>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div style="margin-bottom:16px;">
                    <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; text-transform:uppercase; letter-spacing:0.5px;">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                        style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; outline:none; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#DC2626'" onblur="this.style.borderColor='#D8D4CC'">
                    @error('password', 'userDeletion') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                </div>
                <div style="display:flex; gap:10px; justify-content:flex-end;">
                    <button type="button" onclick="document.getElementById('modal-hapus').style.display='none'"
                        style="padding:9px 20px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; cursor:pointer;">
                        Batal
                    </button>
                    <button type="submit"
                        style="padding:9px 20px; background:#DC2626; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                        Ya, Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function switchTab(name, btn) {
        document.querySelectorAll('.profil-panel').forEach(p => p.style.display = 'none');
        document.querySelectorAll('#tab-profil, #tab-password, #tab-hapus').forEach(b => {
            b.style.color = '#8A8A7A';
            b.style.fontWeight = '400';
            b.style.borderBottom = '2px solid transparent';
        });
        document.getElementById('panel-' + name).style.display = 'block';
        btn.style.color = name === 'hapus' ? '#DC2626' : '#1A1A18';
        btn.style.fontWeight = '500';
        btn.style.borderBottom = '2px solid ' + (name === 'hapus' ? '#DC2626' : '#1A1A18');
    }

    @if ($errors->updatePassword->any())
        switchTab('password', document.getElementById('tab-password'));
    @endif

    @if (session('status') === 'password-updated')
        switchTab('password', document.getElementById('tab-password'));
    @endif

    @if ($errors->userDeletion->any())
        document.getElementById('modal-hapus').style.display = 'flex';
    @endif
    </script>

</x-sidebar-layout>