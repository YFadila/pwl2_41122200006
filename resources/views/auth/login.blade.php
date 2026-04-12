<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — KataWarga</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .brand { font-family: 'DM Serif Display', serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="min-h-screen grid grid-cols-2">

    {{-- Kiri: Branding + Ilustrasi --}}
    <div class="flex flex-col justify-between px-16 py-12 relative overflow-hidden" style="background:#1A1A18;">

        {{-- Dekorasi lingkaran --}}
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full" style="background: radial-gradient(circle, rgba(212,98,26,0.12) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-16 -left-16 w-60 h-60 rounded-full" style="background: radial-gradient(circle, rgba(212,98,26,0.07) 0%, transparent 70%);"></div>

        {{-- Brand --}}
        <div class="relative z-10">
            <div class="brand text-4xl text-white mb-2">
                Kata<span style="color:#E8A87C;">Warga</span>
            </div>
            <p class="text-sm leading-relaxed max-w-xs" style="color:rgba(255,255,255,0.45);">
                Laporkan masalah lingkunganmu, pantau penanganannya secara transparan.
            </p>
        </div>

        {{-- Ilustrasi SVG --}}
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <svg viewBox="0 0 340 280" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; max-width:340px;">

                {{-- Kartu laporan utama --}}
                <rect x="40" y="40" width="200" height="130" rx="12" fill="#2A2A28" stroke="rgba(212,98,26,0.3)" stroke-width="1"/>
                {{-- Header kartu --}}
                <rect x="40" y="40" width="200" height="36" rx="12" fill="#D4621A" opacity="0.15"/>
                <rect x="40" y="64" width="200" height="12" fill="#D4621A" opacity="0.15"/>
                {{-- Ikon pin --}}
                <circle cx="64" cy="58" r="8" fill="rgba(212,98,26,0.2)"/>
                <path d="M64 54a3 3 0 0 1 3 3c0 2.1-3 5-3 5s-3-2.9-3-5a3 3 0 0 1 3-3z" fill="#E8A87C"/>
                <circle cx="64" cy="57" r="1" fill="#1A1A18"/>
                {{-- Judul laporan --}}
                <rect x="80" y="53" width="90" height="5" rx="2.5" fill="rgba(255,255,255,0.6)"/>
                <rect x="80" y="62" width="60" height="4" rx="2" fill="rgba(255,255,255,0.2)"/>
                {{-- Badge status --}}
                <rect x="208" y="52" width="22" height="12" rx="6" fill="rgba(212,98,26,0.3)"/>
                <rect x="211" y="55" width="16" height="5" rx="2" fill="#E8A87C" opacity="0.7"/>

                {{-- Konten kartu --}}
                <rect x="56" y="84" width="168" height="4" rx="2" fill="rgba(255,255,255,0.12)"/>
                <rect x="56" y="93" width="140" height="4" rx="2" fill="rgba(255,255,255,0.08)"/>
                <rect x="56" y="102" width="155" height="4" rx="2" fill="rgba(255,255,255,0.08)"/>

                {{-- Divider --}}
                <line x1="56" y1="116" x2="224" y2="116" stroke="rgba(255,255,255,0.06)" stroke-width="1"/>

                {{-- Footer kartu: avatar + tanggal --}}
                <circle cx="68" cy="128" r="7" fill="#D4621A" opacity="0.4"/>
                <rect x="80" y="124" width="50" height="4" rx="2" fill="rgba(255,255,255,0.2)"/>
                <rect x="80" y="131" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>
                <rect x="180" y="124" width="36" height="10" rx="5" fill="rgba(45,122,79,0.3)"/>
                <rect x="185" y="127" width="26" height="4" rx="2" fill="#5DCAA5" opacity="0.7"/>

                {{-- Kartu kecil kedua (di belakang, sedikit rotasi) --}}
                <g transform="translate(180, 100) rotate(8) translate(-60,-40)">
                    <rect width="140" height="90" rx="10" fill="#242422" stroke="rgba(255,255,255,0.06)" stroke-width="1"/>
                    <rect y="0" width="140" height="28" rx="10" fill="rgba(212,98,26,0.08)"/>
                    <rect x="12" y="10" width="70" height="4" rx="2" fill="rgba(255,255,255,0.15)"/>
                    <rect x="12" y="38" width="116" height="3" rx="1.5" fill="rgba(255,255,255,0.07)"/>
                    <rect x="12" y="46" width="90" height="3" rx="1.5" fill="rgba(255,255,255,0.05)"/>
                </g>

                {{-- Kartu kecil ketiga --}}
                <g transform="translate(20, 140) rotate(-5) translate(-30,-30)">
                    <rect width="120" height="80" rx="10" fill="#222220" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>
                    <rect y="0" width="120" height="24" rx="10" fill="rgba(212,98,26,0.06)"/>
                    <rect x="10" y="8" width="60" height="4" rx="2" fill="rgba(255,255,255,0.1)"/>
                    <rect x="10" y="34" width="100" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>
                </g>

                {{-- Timeline vertikal di kanan bawah --}}
                <line x1="278" y1="80" x2="278" y2="220" stroke="rgba(212,98,26,0.2)" stroke-width="1.5" stroke-dasharray="4 3"/>
                <circle cx="278" cy="85" r="5" fill="#D4621A"/>
                <rect x="288" y="82" width="36" height="6" rx="3" fill="rgba(255,255,255,0.12)"/>
                <circle cx="278" cy="130" r="5" fill="#D4621A" opacity="0.6"/>
                <rect x="288" y="127" width="28" height="6" rx="3" fill="rgba(255,255,255,0.08)"/>
                <circle cx="278" cy="175" r="5" fill="rgba(255,255,255,0.15)" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"/>
                <rect x="288" y="172" width="22" height="6" rx="3" fill="rgba(255,255,255,0.05)"/>

                {{-- Notifikasi kecil --}}
                <rect x="56" y="190" width="160" height="34" rx="8" fill="#2A2A28" stroke="rgba(212,98,26,0.25)" stroke-width="1"/>
                <circle cx="72" cy="207" r="6" fill="rgba(45,122,79,0.3)"/>
                <path d="M69 207l2 2 4-4" stroke="#5DCAA5" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="83" y="202" width="80" height="4" rx="2" fill="rgba(255,255,255,0.3)"/>
                <rect x="83" y="210" width="56" height="3" rx="1.5" fill="rgba(255,255,255,0.12)"/>
                <rect x="188" y="200" width="20" height="14" rx="4" fill="rgba(212,98,26,0.15)"/>
                <rect x="192" y="204" width="12" height="3" rx="1.5" fill="#E8A87C" opacity="0.5"/>
                <rect x="192" y="209" width="8" height="3" rx="1.5" fill="#E8A87C" opacity="0.3"/>

                {{-- Titik dekoratif --}}
                <circle cx="30" cy="200" r="2" fill="#D4621A" opacity="0.3"/>
                <circle cx="22" cy="215" r="1.5" fill="#D4621A" opacity="0.2"/>
                <circle cx="260" cy="240" r="2.5" fill="#D4621A" opacity="0.25"/>
                <circle cx="310" cy="60" r="2" fill="rgba(255,255,255,0.1)"/>
            </svg>
        </div>

        {{-- Bottom: 3 fitur singkat --}}
        <div class="relative z-10 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Laporan langsung sampai ke petugas terkait</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Pantau status penanganan secara real-time</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Transparan dan bisa diikuti seluruh warga</span>
            </div>
        </div>
    </div>

    {{-- Kanan: Form Login --}}
    <div class="flex items-center justify-center px-12 py-12" style="background:#F5F2ED;">
        <div class="w-full max-w-sm">

            <h2 class="brand text-3xl text-gray-800 mb-1">Selamat Datang</h2>
            <p class="text-gray-400 text-sm mb-8">Masuk ke akun kamu untuk melanjutkan</p>

            @if (session('status'))
                <div class="bg-green-100 text-green-700 text-sm p-3 rounded mb-4">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500 @error('email') border-red-400 @enderror"
                        placeholder="email@contoh.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500 @error('password') border-red-400 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember & Forgot --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-gray-500">
                        <input type="checkbox" name="remember" class="rounded border-gray-300">
                        Ingat saya
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-orange-500 hover:underline">Lupa password?</a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg text-white text-sm font-medium transition"
                    style="background:#D4621A;">
                    Masuk
                </button>

                <p class="text-center text-sm text-gray-400 mt-6">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-orange-500 hover:underline font-medium">Daftar sekarang</a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>