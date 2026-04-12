<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — KataWarga</title>
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
                Bergabung dan jadilah bagian dari gerakan warga peduli lingkungan.
            </p>
        </div>

        {{-- Ilustrasi SVG: proses daftar & laporan pertama --}}
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <svg viewBox="0 0 340 280" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; max-width:340px;">

                {{-- Step 1: Buat akun --}}
                <rect x="30" y="30" width="130" height="72" rx="10" fill="#242422" stroke="rgba(255,255,255,0.07)" stroke-width="1"/>
                <rect x="30" y="30" width="130" height="24" rx="10" fill="rgba(212,98,26,0.12)"/>
                <rect x="30" y="42" width="130" height="12" fill="rgba(212,98,26,0.12)"/>
                {{-- Step number --}}
                <circle cx="46" cy="42" r="8" fill="#D4621A"/>
                <text x="46" y="46" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="9" font-weight="600" fill="white">1</text>
                <rect x="60" y="38" width="60" height="4" rx="2" fill="rgba(255,255,255,0.4)"/>
                <rect x="60" y="45" width="40" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                {{-- Form fields --}}
                <rect x="42" y="62" width="106" height="6" rx="3" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/>
                <rect x="42" y="73" width="106" height="6" rx="3" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/>
                <rect x="42" y="84" width="106" height="6" rx="3" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.08)" stroke-width="0.5"/>

                {{-- Panah step 1 → 2 --}}
                <path d="M165 66 L185 66" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-dasharray="3 2"/>
                <path d="M182 63 L186 66 L182 69" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                {{-- Step 2: Tulis laporan --}}
                <rect x="188" y="30" width="130" height="72" rx="10" fill="#242422" stroke="rgba(255,255,255,0.07)" stroke-width="1"/>
                <rect x="188" y="30" width="130" height="24" rx="10" fill="rgba(212,98,26,0.10)"/>
                <rect x="188" y="42" width="130" height="12" fill="rgba(212,98,26,0.10)"/>
                <circle cx="204" cy="42" r="8" fill="rgba(212,98,26,0.5)"/>
                <text x="204" y="46" text-anchor="middle" font-family="DM Sans, sans-serif" font-size="9" font-weight="600" fill="white">2</text>
                <rect x="218" y="38" width="70" height="4" rx="2" fill="rgba(255,255,255,0.25)"/>
                <rect x="218" y="45" width="48" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>
                {{-- Ikon peta kecil --}}
                <rect x="200" y="62" width="50" height="34" rx="4" fill="rgba(255,255,255,0.04)" stroke="rgba(255,255,255,0.07)" stroke-width="0.5"/>
                <path d="M218 72a4 4 0 0 1 4 4c0 3-4 7-4 7s-4-4-4-7a4 4 0 0 1 4-4z" fill="rgba(212,98,26,0.5)"/>
                <circle cx="218" cy="76" r="1.2" fill="rgba(255,255,255,0.5)"/>
                {{-- Textarea --}}
                <rect x="256" y="62" width="50" height="34" rx="4" fill="rgba(255,255,255,0.04)" stroke="rgba(255,255,255,0.07)" stroke-width="0.5"/>
                <rect x="260" y="67" width="42" height="3" rx="1.5" fill="rgba(255,255,255,0.08)"/>
                <rect x="260" y="73" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>
                <rect x="260" y="79" width="40" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>
                <rect x="260" y="85" width="28" height="3" rx="1.5" fill="rgba(255,255,255,0.04)"/>

                {{-- Panah step 2 → 3 --}}
                <path d="M253 140 L253 160" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-dasharray="3 2"/>
                <path d="M250 157 L253 161 L256 157" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                {{-- Step 3: Laporan diterima --}}
                <rect x="140" y="165" width="228" height="80" rx="10" fill="#242422" stroke="rgba(45,122,79,0.3)" stroke-width="1"/>
                <rect x="140" y="165" width="228" height="26" rx="10" fill="rgba(45,122,79,0.1)"/>
                <rect x="140" y="179" width="228" height="12" fill="rgba(45,122,79,0.1)"/>
                {{-- Ikon centang --}}
                <circle cx="157" cy="178" r="8" fill="rgba(45,122,79,0.3)"/>
                <path d="M153 178l3 3 6-6" stroke="#5DCAA5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="170" y="174" width="90" height="4" rx="2" fill="rgba(255,255,255,0.4)"/>
                <rect x="170" y="181" width="60" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                {{-- Badge status --}}
                <rect x="330" y="172" width="28" height="12" rx="6" fill="rgba(45,122,79,0.25)"/>
                <rect x="334" y="175" width="20" height="5" rx="2" fill="#5DCAA5" opacity="0.6"/>
                {{-- Detail --}}
                <rect x="152" y="200" width="200" height="3" rx="1.5" fill="rgba(255,255,255,0.07)"/>
                <rect x="152" y="208" width="170" height="3" rx="1.5" fill="rgba(255,255,255,0.05)"/>
                {{-- Footer --}}
                <circle cx="162" cy="228" r="6" fill="rgba(212,98,26,0.3)"/>
                <rect x="173" y="224" width="60" height="3" rx="1.5" fill="rgba(255,255,255,0.15)"/>
                <rect x="173" y="231" width="44" height="3" rx="1.5" fill="rgba(255,255,255,0.08)"/>

                {{-- Dekorasi kiri bawah --}}
                <rect x="30" y="130" width="90" height="110" rx="10" fill="#1E1E1C" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>
                <circle cx="75" cy="158" r="18" fill="rgba(212,98,26,0.1)" stroke="rgba(212,98,26,0.2)" stroke-width="1"/>
                <path d="M75 152a5 5 0 0 1 5 5c0 3.5-5 8-5 8s-5-4.5-5-8a5 5 0 0 1 5-5z" fill="rgba(212,98,26,0.6)"/>
                <circle cx="75" cy="157" r="1.5" fill="rgba(255,255,255,0.5)"/>
                <rect x="42" y="182" width="66" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>
                <rect x="48" y="189" width="54" height="3" rx="1.5" fill="rgba(255,255,255,0.07)"/>
                <rect x="42" y="208" width="66" height="8" rx="4" fill="rgba(212,98,26,0.3)"/>
                <rect x="52" y="210" width="46" height="4" rx="2" fill="#E8A87C" opacity="0.5"/>

                {{-- Titik dekoratif --}}
                <circle cx="20" cy="100" r="2" fill="#D4621A" opacity="0.25"/>
                <circle cx="326" cy="150" r="2" fill="#D4621A" opacity="0.2"/>
                <circle cx="14" cy="240" r="1.5" fill="rgba(255,255,255,0.08)"/>
            </svg>
        </div>

        {{-- Bottom: 3 fitur --}}
        <div class="relative z-10 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Daftar gratis, tidak perlu verifikasi yang rumit</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Laporan kamu langsung masuk ke sistem petugas</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Pantau perkembangan laporan kapan saja</span>
            </div>
        </div>
    </div>

    {{-- Kanan: Form Register --}}
    <div class="flex items-center justify-center px-12 py-12" style="background:#F5F2ED;">
        <div class="w-full max-w-sm">

            <h2 class="brand text-3xl text-gray-800 mb-1">Buat Akun</h2>
            <p class="text-gray-400 text-sm mb-8">Isi data di bawah untuk mendaftar</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama --}}
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500 @error('name') border-red-400 @enderror"
                        placeholder="Nama lengkap kamu">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
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
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500"
                        placeholder="Ulangi password">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg text-white text-sm font-medium transition"
                    style="background:#D4621A;">
                    Daftar Sekarang
                </button>

                <p class="text-center text-sm text-gray-400 mt-6">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:underline font-medium">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>