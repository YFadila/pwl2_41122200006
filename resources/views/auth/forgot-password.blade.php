<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — KataWarga</title>
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

        {{-- Dekorasi --}}
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full" style="background:radial-gradient(circle, rgba(212,98,26,0.12) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-16 -left-16 w-60 h-60 rounded-full" style="background:radial-gradient(circle, rgba(212,98,26,0.07) 0%, transparent 70%);"></div>

        {{-- Brand --}}
        <div class="relative z-10">
            <div class="brand text-4xl text-white mb-2">
                Kata<span style="color:#E8A87C;">Warga</span>
            </div>
            <p class="text-sm leading-relaxed max-w-xs" style="color:rgba(255,255,255,0.45);">
                Kami akan membantu kamu mendapatkan kembali akses ke akunmu.
            </p>
        </div>

        {{-- Ilustrasi SVG: alur reset password --}}
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <svg viewBox="0 0 340 280" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; max-width:320px;">

                {{-- Amplop email --}}
                <rect x="70" y="50" width="200" height="130" rx="12" fill="#242422" stroke="rgba(212,98,26,0.3)" stroke-width="1"/>
                {{-- Tutup amplop --}}
                <path d="M70 62 L170 120 L270 62" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                {{-- Garis konten email --}}
                <rect x="100" y="108" width="140" height="5" rx="2.5" fill="rgba(255,255,255,0.1)"/>
                <rect x="100" y="118" width="110" height="4" rx="2" fill="rgba(255,255,255,0.07)"/>
                <rect x="100" y="128" width="125" height="4" rx="2" fill="rgba(255,255,255,0.07)"/>
                {{-- Tombol di dalam email --}}
                <rect x="108" y="142" width="124" height="22" rx="6" fill="rgba(212,98,26,0.35)"/>
                <rect x="130" y="148" width="80" height="10" rx="3" fill="#E8A87C" opacity="0.6"/>

                {{-- Panah ke bawah --}}
                <path d="M170 184 L170 204" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-dasharray="3 2"/>
                <path d="M166 201 L170 205 L174 201" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                {{-- Card reset password --}}
                <rect x="90" y="208" width="160" height="56" rx="10" fill="#2A2A28" stroke="rgba(45,122,79,0.35)" stroke-width="1"/>
                {{-- Ikon kunci --}}
                <circle cx="120" cy="232" r="10" fill="rgba(45,122,79,0.2)"/>
                <rect x="115" y="232" width="10" height="8" rx="2" stroke="#5DCAA5" stroke-width="1.2" fill="none"/>
                <path d="M118 232v-3a2 2 0 0 1 4 0v3" stroke="#5DCAA5" stroke-width="1.2" fill="none" stroke-linecap="round"/>
                {{-- Teks card --}}
                <rect x="136" y="225" width="96" height="5" rx="2.5" fill="rgba(255,255,255,0.35)"/>
                <rect x="136" y="234" width="70" height="4" rx="2" fill="rgba(255,255,255,0.15)"/>
                {{-- Input password baru --}}
                <rect x="136" y="244" width="96" height="12" rx="4" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/>
                <rect x="141" y="248" width="40" height="4" rx="2" fill="rgba(255,255,255,0.12)"/>
                <rect x="220" y="248" width="6" height="4" rx="1" fill="rgba(212,98,26,0.4)"/>

                {{-- Timer 60 menit di kiri atas --}}
                <rect x="28" y="80" width="32" height="32" rx="8" fill="#242422" stroke="rgba(212,98,26,0.2)" stroke-width="1"/>
                <circle cx="44" cy="96" r="8" stroke="rgba(212,98,26,0.5)" stroke-width="1" fill="none"/>
                <path d="M44 90v6l4 2" stroke="#E8A87C" stroke-width="1.2" stroke-linecap="round" opacity="0.7"/>
                <rect x="32" y="118" width="24" height="4" rx="2" fill="rgba(255,255,255,0.08)"/>
                <rect x="34" y="125" width="20" height="3" rx="1.5" fill="rgba(255,255,255,0.05)"/>

                {{-- Label "60 menit" --}}
                <text x="44" y="140" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="8" fill="rgba(255,255,255,0.2)">60 mnt</text>

                {{-- Ikon spam/inbox di kanan atas --}}
                <rect x="280" y="80" width="32" height="32" rx="8" fill="#242422" stroke="rgba(255,255,255,0.06)" stroke-width="1"/>
                <rect x="286" y="90" width="20" height="14" rx="3" stroke="rgba(255,255,255,0.2)" stroke-width="1" fill="none"/>
                <path d="M286 93 L296 99 L306 93" stroke="rgba(255,255,255,0.15)" stroke-width="1" fill="none"/>
                <text x="296" y="140" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="8" fill="rgba(255,255,255,0.2)">inbox</text>

                {{-- Titik dekoratif --}}
                <circle cx="56" cy="180" r="2" fill="#D4621A" opacity="0.25"/>
                <circle cx="48" cy="195" r="1.5" fill="#D4621A" opacity="0.15"/>
                <circle cx="300" cy="190" r="2" fill="#D4621A" opacity="0.2"/>
                <circle cx="310" cy="210" r="1.5" fill="rgba(255,255,255,0.08)"/>
            </svg>
        </div>

        {{-- Bottom: 3 langkah --}}
        <div class="relative z-10 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Masukkan email yang terdaftar di KataWarga</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Cek inbox atau folder spam email kamu</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Link reset password berlaku selama 60 menit</span>
            </div>
        </div>
    </div>

    {{-- Kanan: Form --}}
    <div class="flex items-center justify-center px-12 py-12" style="background:#F5F2ED;">
        <div class="w-full max-w-sm">

            <h2 class="brand text-3xl text-gray-800 mb-1">Lupa Password?</h2>
            <p class="text-gray-400 text-sm mb-8">Masukkan email kamu dan kami akan mengirimkan link untuk reset password.</p>

            @if (session('status'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm p-4 rounded-lg mb-6">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="flex-shrink-0">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500 @error('email') border-red-400 @enderror"
                        placeholder="email@contoh.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg text-white text-sm font-medium mb-4 transition-opacity hover:opacity-90"
                    style="background:#D4621A;">
                    Kirim Link Reset
                </button>

                <p class="text-center text-sm text-gray-400">
                    Ingat password?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:underline font-medium">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>