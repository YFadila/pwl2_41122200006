<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KataWarga</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .sidebar { background: #1A1A18; min-height: 100vh; width: 240px; position: fixed; left: 0; top: 0; }
        .main-content { margin-left: 240px; min-height: 100vh; background: #F5F2ED; }
        .brand { font-family: 'DM Serif Display', serif; }
        h1, h2, h3 { font-family: 'DM Serif Display', serif; }

        .notif-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,0.35);
            z-index: 998; opacity: 0; pointer-events: none;
            transition: opacity .3s ease;
        }
        .notif-overlay.active { opacity: 1; pointer-events: auto; }

        .notif-panel {
            position: fixed; top: 0; right: 0; bottom: 0;
            width: 380px; max-width: 100vw;
            background: #fff; z-index: 999;
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4,0,.2,1);
            display: flex; flex-direction: column;
            box-shadow: -4px 0 24px rgba(0,0,0,0.12);
        }
        .notif-panel.active { transform: translateX(0); }

        .notif-panel-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px 16px; border-bottom: 1px solid #f0ebe4;
            flex-shrink: 0;
        }
        .notif-panel-header h3 { font-size: 1.1rem; margin: 0; color: #1a1a18; }
        .notif-panel-close {
            background: none; border: none; cursor: pointer;
            color: #9ca3af; padding: 4px; border-radius: 6px; transition: all .2s;
        }
        .notif-panel-close:hover { background: #f3f4f6; color: #374151; }

        .notif-tabs {
            display: flex; border-bottom: 1px solid #f0ebe4; flex-shrink: 0;
        }
        .notif-tab {
            flex: 1; padding: 10px 0; font-size: 13px; font-weight: 400;
            color: #8A8A7A; background: none; border: none;
            border-bottom: 2px solid transparent; cursor: pointer;
            transition: all .15s; font-family: 'DM Sans', sans-serif;
        }
        .notif-tab.active { color: #1A1A18; font-weight: 500; border-bottom-color: #1A1A18; }

        .notif-panel-actions {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 24px; border-bottom: 1px solid #f0ebe4; flex-shrink: 0;
        }
        .notif-unread-label { font-size: 12px; color: #9ca3af; }
        .notif-mark-read-btn {
            background: none; border: none; cursor: pointer;
            font-size: 12px; color: #ea580c; font-weight: 500;
            padding: 4px 10px; border-radius: 6px; transition: all .2s;
            font-family: 'DM Sans', sans-serif;
        }
        .notif-mark-read-btn:hover { background: #fff7ed; }
        .notif-mark-read-btn:disabled { color: #d1d5db; cursor: default; background: none; }

        .notif-panel-list { flex: 1; overflow-y: auto; }

        .notif-item {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px 24px; border-bottom: 1px solid #f5f2ed;
            cursor: pointer; text-decoration: none; color: inherit;
            transition: background .15s;
        }
        .notif-item:hover { background: #fafaf8; }
        .notif-item.unread { background: #fff7ed; }
        .notif-item.unread:hover { background: #ffedd5; }

        .notif-item-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: #F0EDE8; display: flex; align-items: center;
            justify-content: center; flex-shrink: 0; font-size: 11px;
            font-weight: 600; color: #4A4A42;
        }
        .notif-item-avatar.new { background: rgba(212,98,26,0.15); color: #D4621A; }

        .notif-dot {
            width: 7px; height: 7px; border-radius: 50%;
            background: #ea580c; flex-shrink: 0; margin-top: 6px;
            transition: background .2s;
        }
        .notif-dot.read { background: transparent; }

        .notif-item-body { flex: 1; min-width: 0; }
        .notif-item-pesan {
            font-size: 13px; color: #4A4A42; line-height: 1.45; margin: 0 0 4px;
        }
        .notif-item.unread .notif-item-pesan { color: #1A1A18; font-weight: 500; }
        .notif-item-waktu { font-size: 11px; color: #9ca3af; margin: 0; }

        .notif-item-arrow {
            color: #d1d5db; margin-top: 2px; flex-shrink: 0; transition: color .2s;
        }
        .notif-item:hover .notif-item-arrow { color: #ea580c; }

        .notif-type-badge {
            display: inline-block; font-size: 10px; font-weight: 500;
            padding: 1px 7px; border-radius: 10px; margin-top: 5px;
        }
        .notif-type-laporan { background: #FEF3CD; color: #92740E; }
        .notif-type-status  { background: #D1FAE5; color: #1A5C38; }
        .notif-type-komentar { background: #DBEAFE; color: #1E4A8A; }

        .notif-empty {
            display: flex; flex-direction: column; align-items: center;
            justify-content: center; height: 200px;
            color: #9ca3af; text-align: center; padding: 40px;
            gap: 12px;
        }
        .notif-empty p { font-size: 13px; margin: 0; }

        .notif-loading {
            display: flex; align-items: center; justify-content: center; padding: 40px;
        }
        .notif-loading .spinner {
            width: 22px; height: 22px; border: 2.5px solid #f0ebe4;
            border-top-color: #ea580c; border-radius: 50%;
            animation: notif-spin .7s linear infinite;
        }
        @keyframes notif-spin { to { transform: rotate(360deg); } }

        .notif-item.marking {
            opacity: 0.5; pointer-events: none; transition: opacity .2s;
        }
        .profile-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.38);
            z-index: 998; opacity: 0; pointer-events: none;
            transition: opacity .32s ease;
        }
        .profile-overlay.active { opacity: 1; pointer-events: auto; }

        .profile-panel {
            position: fixed; top: 0; left: 0; bottom: 0; 
            width: 420px; max-width: 100vw; 
            background: #fff; z-index: 999;
            transform: translateX(-100%);
            transition: transform .36s cubic-bezier(.4,0,.2,1);
            display: flex; flex-direction: column;
            box-shadow: 4px 0 28px rgba(0,0,0,0.10);
            border-right: 1px solid #f0ebe4;
        }
        .profile-panel.active { transform: translateX(0); }

        .pp-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 22px 26px 18px; border-bottom: 1px solid #f0ebe4; flex-shrink: 0;
        }
        .pp-header-left { display: flex; align-items: center; gap: 14px; }
        .pp-avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: #ea580c; display: flex; align-items: center;
            justify-content: center; color: #fff; font-size: 15px; font-weight: 600; flex-shrink: 0;
        }
        .pp-title { font-family: 'DM Serif Display', serif; font-size: 1.15rem; color: #1a1a18; }
        .pp-subtitle { font-size: 11px; color: #9ca3af; margin-top: 1px; }
        .pp-close {
            background: none; border: none; cursor: pointer;
            color: #9ca3af; padding: 6px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center; transition: all .18s;
        }
        .pp-close:hover { background: #f3f4f6; color: #374151; }

        .pp-tabs {
            display: flex; border-bottom: 1px solid #f0ebe4; flex-shrink: 0; padding: 0 26px;
        }
        .pp-tab {
            font-size: 13px; font-weight: 400; color: #8a8a7a;
            background: none; border: none; border-bottom: 2px solid transparent;
            padding: 11px 0; margin-right: 20px; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all .15s;
        }
        .pp-tab.active { color: #1a1a18; font-weight: 500; border-bottom-color: #1a1a18; }
        .pp-tab.tab-danger { color: #8a8a7a; }
        .pp-tab.tab-danger.active { color: #dc2626; border-bottom-color: #dc2626; }
        .pp-tab.tab-danger:hover { color: #dc2626; }

        .pp-body { flex: 1; overflow-y: auto; padding: 26px; }
        .pp-inner { display: none; }
        .pp-inner.active { display: block; }

        .pp-field { margin-bottom: 18px; }
        .pp-label { display: block; font-size: 12px; font-weight: 500; color: #6b7280; margin-bottom: 6px; letter-spacing: .02em; }
        .pp-input {
            width: 100%; padding: 9px 13px; font-size: 14px;
            border: 1px solid #e5e7eb; border-radius: 8px;
            color: #1a1a18; font-family: 'DM Sans', sans-serif;
            background: #fafafa; outline: none; transition: border-color .15s, background .15s;
        }
        .pp-input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        .pp-field-error {
            display: block;
            font-size: 12px;
            color: #ef4444;
            margin-top: 4px;
        }
        .pp-input:focus { border-color: #ea580c; background: #fff; box-shadow: 0 0 0 3px rgba(234,88,12,.08); }

        .pp-section-title { font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .07em; color: #9ca3af; margin-bottom: 14px; margin-top: 4px; }
        .pp-divider { border: none; border-top: 1px solid #f0ebe4; margin: 20px 0; }

        .pp-btn-row { display: flex; gap: 10px; margin-top: 24px; }
        .pp-btn {
            flex: 1; padding: 10px 0; border-radius: 8px; font-size: 13px;
            font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif;
            border: 1px solid #e5e7eb; background: #fff; color: #4a4a42; transition: all .15s;
        }
        .pp-btn:hover { background: #f9fafb; border-color: #d1d5db; }
        .pp-btn.pp-btn-primary { background: #ea580c; border-color: #ea580c; color: #fff; }
        .pp-btn.pp-btn-primary:hover { background: #c2410c; border-color: #c2410c; }
        .pp-btn.pp-btn-danger { background: #dc2626; border-color: #dc2626; color: #fff; }
        .pp-btn.pp-btn-danger:hover { background: #b91c1c; border-color: #b91c1c; }

        .pp-alert {
            background: #fff7ed; border: 1px solid #fed7aa;
            border-radius: 8px; padding: 12px 14px; font-size: 13px;
            color: #9a3412; display: flex; gap: 10px; align-items: flex-start; margin-bottom: 18px;
        }
        .pp-alert-danger { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
        .pp-alert svg { flex-shrink: 0; margin-top: 1px; }
    </style>
</head>
<body>
<div class="flex">

    {{-- SIDEBAR --}}
    <aside class="sidebar flex flex-col p-5">

        <div class="brand text-2xl text-white mb-8">
            Kata<span style="color:#E8A87C;">Warga</span>
        </div>

        <div class="text-xs text-gray-500 uppercase tracking-widest mb-3">Menu</div>

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded text-sm mb-1
            {{ request()->routeIs('dashboard') ? 'bg-orange-600 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <i data-lucide="layout-dashboard" style="width:18px;height:18px;opacity:0.8;flex-shrink:0;"></i>
            Dashboard
        </a>

        <a href="{{ route('laporan.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded text-sm mb-1
            {{ request()->routeIs('laporan.*') ? 'bg-orange-600 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <i data-lucide="file-text" style="width:18px;height:18px;opacity:0.8;flex-shrink:0;"></i>
            Laporan
        </a>

        @php $unread = auth()->user()->notifikasis()->where('dibaca', false)->count(); @endphp
        <button onclick="toggleNotifPanel()"
            class="flex items-center gap-3 px-3 py-2 rounded text-sm mb-1 w-full text-left
            {{ request()->routeIs('notifikasi.*') ? 'bg-orange-600 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <i data-lucide="bell" style="width:18px;height:18px;opacity:0.8;flex-shrink:0;"></i>
            Notifikasi
            <span id="notifBadgeSidebar"
                class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 {{ $unread > 0 ? '' : 'hidden' }}">
                {{ $unread }}
            </span>
        </button>

        <div class="mt-auto">
            <div class="border-t border-gray-700 pt-4">
                
                <button type="button" onclick="toggleProfilePanel()" class="flex items-center gap-3 px-2 py-2 -mx-2 mb-2 rounded w-full text-left hover:bg-gray-800 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="truncate">
                        <div class="text-white text-sm font-medium truncate">{{ auth()->user()->name }}</div>
                        <div class="text-gray-500 text-xs truncate">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                </button>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded text-sm text-gray-400 hover:text-white hover:bg-gray-800 w-full">
                        <i data-lucide="log-out" style="width:18px;height:18px;opacity:0.8;flex-shrink:0;"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content flex-1 p-8">
        @isset($header)
        <div class="mb-6">{{ $header }}</div>
        @endisset
        {{ $slot }}
    </main>

</div>

<div class="notif-overlay" id="notifOverlay" onclick="toggleNotifPanel()"></div>

<div class="notif-panel" id="notifPanel">

    {{-- Header --}}
    <div class="notif-panel-header">
        <h3>
            Notifikasi
            <span id="notifCountBadge"
                style="background:#FEE2E2;color:#DC2626;font-size:11px;padding:1px 8px;border-radius:12px;font-family:'DM Sans',sans-serif;font-weight:500;margin-left:6px;vertical-align:middle;display:none;">
            </span>
        </h3>
        <button class="notif-panel-close" onclick="toggleNotifPanel()" title="Tutup">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 6 6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- Tabs --}}
    <div class="notif-tabs">
        <button class="notif-tab active" id="tabSemua" onclick="switchNotifTab('semua')">Semua</button>
        <button class="notif-tab" id="tabBelum" onclick="switchNotifTab('belum')">Belum dibaca</button>
    </div>

    {{-- Actions --}}
    <div class="notif-panel-actions">
        <span class="notif-unread-label" id="notifUnreadLabel"></span>
        <button class="notif-mark-read-btn" id="notifMarkReadBtn" onclick="markAllAsRead()" disabled>
            Tandai semua dibaca
        </button>
    </div>

    {{-- List --}}
    <div class="notif-panel-list" id="notifList">
        <div class="notif-loading"><div class="spinner"></div></div>
    </div>

</div>
<div class="profile-overlay" id="profileOverlay" onclick="toggleProfilePanel()"></div>

<div class="profile-panel" id="profilePanel">
    <div class="pp-header">
        <div class="pp-header-left">
            <div class="pp-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
            <div>
                <div class="pp-title">{{ auth()->user()->name }}</div>
                <div class="pp-subtitle">{{ auth()->user()->email }} · {{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <button class="pp-close" onclick="toggleProfilePanel()" title="Tutup">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M18 6 6 18M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div class="pp-tabs">
        <button class="pp-tab active" onclick="switchPpTab('profil', this)">Profil</button>
        <button class="pp-tab" onclick="switchPpTab('password', this)">Password</button>
        <button class="pp-tab tab-danger" onclick="switchPpTab('hapus', this)">Hapus Akun</button>
    </div>

    <div class="pp-body">

        <div class="pp-inner active" id="ppInnerProfil">
            @if (session('status') === 'profile-updated')
                <div class="pp-alert" style="background: #d1fae5; border-color: #10b981; color: #065f46;">
                    <i data-lucide="check-circle" style="width:16px; height:16px;"></i>
                    <span>Profil berhasil diperbarui!</span>
                </div>
            @endif
            <p class="pp-section-title">Informasi Akun</p>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PATCH')
                <div class="pp-field">
                    <label class="pp-label">Nama Lengkap</label>
                    <input class="pp-input" type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
                </div>
                <div class="pp-field">
                    <label class="pp-label">Alamat Email</label>
                    <input class="pp-input" type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                </div>
                <div class="pp-btn-row">
                    <button type="button" class="pp-btn" onclick="toggleProfilePanel()">Batal</button>
                    <button type="submit" class="pp-btn pp-btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>

        <div class="pp-inner" id="ppInnerPassword">
            @if (session('status') === 'password-updated')
                <div class="pp-alert" style="background: #d1fae5; border-color: #10b981; color: #065f46;">
                    <i data-lucide="check-circle" style="width:16px; height:16px;"></i>
                    <span>Password berhasil diubah!</span>
                </div>
            @endif
            <p class="pp-section-title">Ubah Password</p>
            <div class="pp-alert">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                </svg>
                <span>Password baru minimal 8 karakter.</span>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf @method('PUT')
                <div class="pp-field">
                    <label class="pp-label">Password Saat Ini</label>
                    <input class="pp-input {{ $errors->updatePassword->has('current_password') ? 'pp-input-error' : '' }}"
                        type="password" name="current_password">
                    @error('current_password', 'updatePassword')
                        <span class="pp-field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="pp-field">
                    <label class="pp-label">Password Baru</label>
                    <input class="pp-input {{ $errors->updatePassword->has('password') ? 'pp-input-error' : '' }}"
                        type="password" name="password">
                    @error('password', 'updatePassword')
                        <span class="pp-field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="pp-field">
                    <label class="pp-label">Konfirmasi Password Baru</label>
                    <input class="pp-input {{ $errors->updatePassword->has('password_confirmation') ? 'pp-input-error' : '' }}"
                        type="password" name="password_confirmation">
                    @error('password_confirmation', 'updatePassword')
                        <span class="pp-field-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="pp-btn-row">
                    <button type="button" class="pp-btn" onclick="toggleProfilePanel()">Batal</button>
                    <button type="submit" class="pp-btn pp-btn-primary">Perbarui Password</button>
                </div>
            </form>
        </div>

        <div class="pp-inner" id="ppInnerHapus">
            <p class="pp-section-title">Hapus Akun</p>
            <div class="pp-alert pp-alert-danger">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <path d="M12 9v4M12 17h.01"/>
                </svg>
                <span>Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.</span>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf @method('DELETE')
                <div class="pp-field">
                    <label class="pp-label">Konfirmasi dengan Password</label>
                    <input class="pp-input" type="password" name="password" placeholder="Masukkan password Anda">
                </div>
                <div class="pp-btn-row">
                    <button type="button" class="pp-btn" onclick="toggleProfilePanel()">Batal</button>
                    <button type="submit" class="pp-btn pp-btn-danger">Hapus Akun Saya</button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
(function () {
    const panel       = document.getElementById('notifPanel');
    const overlay     = document.getElementById('notifOverlay');
    const list        = document.getElementById('notifList');
    const badge       = document.getElementById('notifBadgeSidebar');
    const countBadge  = document.getElementById('notifCountBadge');
    const label       = document.getElementById('notifUnreadLabel');
    const markBtn     = document.getElementById('notifMarkReadBtn');
    const csrfToken   = document.querySelector('meta[name="csrf-token"]').content;

    let isOpen        = false;
    let allItems      = [];
    let activeTab     = 'semua';

    window.toggleNotifPanel = function () {
        isOpen = !isOpen;
        panel.classList.toggle('active', isOpen);
        overlay.classList.toggle('active', isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
        if (isOpen) fetchNotifications();
    };

    window.switchNotifTab = function (tab) {
        activeTab = tab;
        document.getElementById('tabSemua').classList.toggle('active', tab === 'semua');
        document.getElementById('tabBelum').classList.toggle('active', tab === 'belum');
        renderList();
    };

    function fetchNotifications() {
        list.innerHTML = '<div class="notif-loading"><div class="spinner"></div></div>';

        fetch("{{ route('notifikasi.json') }}", {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            allItems = data.notifikasis || [];
            updateBadge(data.unread || 0);
            renderList();
        })
        .catch(() => {
            list.innerHTML = `
                <div class="notif-empty">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" opacity="0.4">
                        <circle cx="12" cy="12" r="10"/><path d="M12 8v4M12 16h.01"/>
                    </svg>
                    <p>Gagal memuat notifikasi</p>
                </div>`;
        });
    }

    function renderList() {
        const items = activeTab === 'belum'
            ? allItems.filter(n => !n.dibaca)
            : allItems;

        if (!items.length) {
            const msg = activeTab === 'belum'
                ? 'Semua notifikasi sudah dibaca'
                : 'Belum ada notifikasi';
            list.innerHTML = `
                <div class="notif-empty">
                    <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" opacity="0.35">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                    </svg>
                    <p>${msg}</p>
                </div>`;
            return;
        }

        list.innerHTML = items.map(n => {
            const typeClass = getTypeClass(n.pesan);
            const typeLabel = getTypeLabel(n.pesan);
            const initials  = getInitials(n.pesan);

            return `
            <div class="notif-item ${n.dibaca ? '' : 'unread'}"
                 id="notif-item-${n.id}"
                 onclick="handleNotifClick(event, ${n.id}, '${escHtml(n.url)}', ${n.dibaca})">
                <div class="notif-item-avatar ${n.dibaca ? '' : 'new'}">${initials}</div>
                <div class="notif-item-body">
                    <p class="notif-item-pesan">${escHtml(n.pesan)}</p>
                    <p class="notif-item-waktu">${escHtml(n.waktu)}</p>
                    ${typeLabel ? `<span class="notif-type-badge ${typeClass}">${typeLabel}</span>` : ''}
                </div>
                <div class="notif-dot ${n.dibaca ? 'read' : ''}" id="notif-dot-${n.id}"></div>
            </div>`;
        }).join('');
    }

    window.handleNotifClick = function (e, id, url, sudahDibaca) {
        e.preventDefault();

        const item = document.getElementById('notif-item-' + id);

        if (sudahDibaca) {
            window.location.href = url;
            return;
        }

        if (item) {
            item.classList.add('marking');
        }

        fetch(`{{ url('/notifikasi') }}/${id}/baca`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ id: id })
        })
        .then(r => r.json())
        .then(data => {
            const notif = allItems.find(n => n.id === id);
            if (notif) notif.dibaca = true;

            const newUnread = allItems.filter(n => !n.dibaca).length;
            updateBadge(newUnread);

            window.location.href = url;
        })
        .catch(() => {
            window.location.href = url;
        });
    };

    window.markAllAsRead = function () {
        markBtn.disabled = true;

        fetch("{{ route('notifikasi.markRead') }}", {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(() => {
            allItems.forEach(n => n.dibaca = true);
            updateBadge(0);
            renderList();
        })
        .catch(() => { markBtn.disabled = false; });
    };

    function updateBadge(count) {
        if (count > 0) {
            badge.textContent = count;
            badge.classList.remove('hidden');
            countBadge.textContent = count + ' baru';
            countBadge.style.display = 'inline';
            label.textContent = count + ' belum dibaca';
            markBtn.disabled = false;
        } else {
            badge.classList.add('hidden');
            countBadge.style.display = 'none';
            label.textContent = 'Semua sudah dibaca';
            markBtn.disabled = true;
        }
    }

    function getTypeClass(pesan) {
        const p = pesan.toLowerCase();
        if (p.includes('laporan baru') || p.includes('laporan masuk')) return 'notif-type-laporan';
        if (p.includes('status') || p.includes('diproses') || p.includes('selesai')) return 'notif-type-status';
        if (p.includes('komentar') || p.includes('balas')) return 'notif-type-komentar';
        return 'notif-type-laporan';
    }

    function getTypeLabel(pesan) {
        const p = pesan.toLowerCase();
        if (p.includes('laporan baru') || p.includes('laporan masuk')) return 'Laporan baru';
        if (p.includes('status') || p.includes('diproses')) return 'Update status';
        if (p.includes('selesai')) return 'Selesai';
        if (p.includes('komentar') || p.includes('balas')) return 'Komentar';
        return 'Notifikasi';
    }

    function getInitials(pesan) {
        const match = pesan.match(/dari\s+([A-Za-z]+)/i);
        if (match) {
            return match[1].substring(0, 2).toUpperCase();
        }
        return '##';
    }

    function escHtml(str) {
        if (!str) return '';
        const d = document.createElement('div');
        d.textContent = str;
        return d.innerHTML;
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && isOpen) toggleNotifPanel();
    });
})();
</script>
<script>
(function () {
    const panel = document.getElementById('profilePanel');
    const overlay = document.getElementById('profileOverlay');
    let isOpen = false;

    window.toggleProfilePanel = function () {
        isOpen = !isOpen;
        panel.classList.toggle('active', isOpen);
        overlay.classList.toggle('active', isOpen);
        document.body.style.overflow = isOpen ? 'hidden' : '';
    };

    window.switchPpTab = function (name, btn) {
        if (!btn) {
            const tabs = document.querySelectorAll('.pp-tab');
            if (name === 'profil')   btn = tabs[0];
            if (name === 'password') btn = tabs[1];
            if (name === 'hapus')    btn = tabs[2];
        }

        document.querySelectorAll('.pp-inner').forEach(p => p.classList.remove('active'));
        document.querySelectorAll('.pp-tab').forEach(b => b.classList.remove('active'));

        const key = name.charAt(0).toUpperCase() + name.slice(1);
        const targetInner = document.getElementById('ppInner' + key);
        if (targetInner) targetInner.classList.add('active');
        if (btn) btn.classList.add('active');
    };

    @if (session('status') === 'profile-updated')
        toggleProfilePanel();
        switchPpTab('profil');

    @elseif (session('status') === 'password-updated')
        toggleProfilePanel();
        switchPpTab('password');

    @elseif ($errors->updatePassword->any())
        toggleProfilePanel();
        switchPpTab('password');

    @elseif ($errors->userDeletion->any())
        toggleProfilePanel();
        switchPpTab('hapus');

    @elseif ($errors->any())
        toggleProfilePanel();
        switchPpTab('profil');
    @endif

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape' && isOpen) toggleProfilePanel();
    });
})();
</script>
<script>lucide.createIcons();</script>
</body>
</html>