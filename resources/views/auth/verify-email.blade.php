<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email — KataWarga</title>
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
                Satu langkah lagi untuk mulai menggunakan KataWarga.
            </p>
        </div>

        {{-- Ilustrasi SVG: alur verifikasi email --}}
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <svg viewBox="0 0 340 280" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; max-width:320px;">

                {{-- Amplop utama --}}
                <rect x="60" y="60" width="200" height="130" rx="12"
                    fill="#242422" stroke="rgba(212,98,26,0.3)" stroke-width="1.2"/>

                {{-- Tutup amplop terbuka --}}
                <path d="M60 72 L160 128 L260 72"
                    stroke="rgba(212,98,26,0.35)" stroke-width="1.5" fill="none"
                    stroke-linecap="round" stroke-linejoin="round"/>

                {{-- Flap atas terbuka --}}
                <path d="M60 60 L160 108 L260 60"
                    fill="#2A2A28" stroke="rgba(212,98,26,0.2)" stroke-width="1"/>

                {{-- Konten email di dalam --}}
                <rect x="88" y="110" width="104" height="5" rx="2.5" fill="rgba(255,255,255,0.15)"/>
                <rect x="96" y="120" width="88" height="4"  rx="2"   fill="rgba(255,255,255,0.08)"/>
                <rect x="92" y="129" width="96" height="4"  rx="2"   fill="rgba(255,255,255,0.08)"/>

                {{-- Tombol verifikasi di dalam email --}}
                <rect x="96" y="142" width="88" height="20" rx="6"
                    fill="rgba(212,98,26,0.3)" stroke="rgba(212,98,26,0.4)" stroke-width="0.8"/>
                <rect x="112" y="148" width="56" height="8" rx="3"
                    fill="#E8A87C" opacity="0.55"/>

                {{-- Panah keluar dari amplop ke atas --}}
                <path d="M160 58 L160 36" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-dasharray="3 2"/>
                <path d="M156 39 L160 35 L164 39" stroke="rgba(212,98,26,0.4)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                {{-- Device / inbox penerima --}}
                <rect x="112" y="12" width="96" height="22" rx="6"
                    fill="#2A2A28" stroke="rgba(255,255,255,0.08)" stroke-width="1"/>
                <rect x="120" y="18" width="40" height="4" rx="2" fill="rgba(255,255,255,0.2)"/>
                <rect x="164" y="18" width="14" height="4" rx="2" fill="rgba(212,98,26,0.4)"/>
                <rect x="182" y="18" width="18" height="4" rx="2" fill="rgba(255,255,255,0.08)"/>

                {{-- Centang verifikasi --}}
                <circle cx="252" cy="60" r="18"
                    fill="rgba(45,122,79,0.15)" stroke="rgba(45,122,79,0.4)" stroke-width="1.2"/>
                <path d="M244 60l5 5 10-10"
                    stroke="#5DCAA5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>

                {{-- Step indicators di bawah --}}
                <rect x="60" y="210" width="200" height="50" rx="10"
                    fill="#1E1E1C" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>

                {{-- Step 1: done --}}
                <circle cx="90" cy="227" r="8" fill="rgba(45,122,79,0.25)"/>
                <path d="M86 227l3 3 5-5" stroke="#5DCAA5" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                <rect x="72" y="240" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.12)"/>
                <rect x="76" y="246" width="28" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>

                {{-- Step 2: active --}}
                <circle cx="170" cy="227" r="8" fill="rgba(212,98,26,0.25)" stroke="rgba(212,98,26,0.5)" stroke-width="1"/>
                <rect x="168" y="222" width="2" height="6" rx="1" fill="#E8A87C" opacity="0.8"/>
                <rect x="168" y="230" width="2" height="2" rx="1" fill="#E8A87C" opacity="0.8"/>
                <rect x="152" y="240" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.2)"/>
                <rect x="156" y="246" width="28" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>

                {{-- Step 3: pending --}}
                <circle cx="250" cy="227" r="8" fill="rgba(255,255,255,0.04)" stroke="rgba(255,255,255,0.1)" stroke-width="1"/>
                <rect x="232" y="240" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.07)"/>
                <rect x="236" y="246" width="28" height="3" rx="1.5" fill="rgba(255,255,255,0.04)"/>

                {{-- Garis penghubung steps --}}
                <line x1="100" y1="227" x2="160" y2="227" stroke="rgba(45,122,79,0.3)" stroke-width="1" stroke-dasharray="3 2"/>
                <line x1="180" y1="227" x2="240" y2="227" stroke="rgba(255,255,255,0.06)" stroke-width="1" stroke-dasharray="3 2"/>

                {{-- Titik dekoratif --}}
                <circle cx="42"  cy="160" r="2"   fill="#D4621A" opacity="0.2"/>
                <circle cx="32"  cy="178" r="1.5" fill="#D4621A" opacity="0.15"/>
                <circle cx="308" cy="140" r="2"   fill="#D4621A" opacity="0.2"/>
                <circle cx="318" cy="160" r="1.5" fill="rgba(255,255,255,0.06)"/>
            </svg>
        </div>

        {{-- Bottom: langkah --}}
        <div class="relative z-10 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Cek inbox atau folder spam email kamu</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Klik link verifikasi yang kami kirimkan</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Mulai lapor masalah di lingkungan kamu</span>
            </div>
        </div>
    </div>

    {{-- Kanan: Konten --}}
    <div class="flex items-center justify-center px-12 py-12" style="background:#F5F2ED;">
        <div class="w-full max-w-sm">

            {{-- Icon amplop --}}
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6"
                style="background:rgba(212,98,26,0.1);">
                <svg width="26" height="26" fill="none" stroke="#D4621A" stroke-width="1.5" viewBox="0 0 24 24">
                    <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            <h2 class="brand text-3xl text-gray-800 mb-2">Verifikasi Email</h2>
            <p class="text-gray-400 text-sm mb-8 leading-relaxed">
                Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi alamat email kamu dengan mengklik link yang baru saja kami kirimkan.
            </p>

            {{-- Status sukses --}}
            @if (session('status') == 'verification-link-sent')
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 text-sm p-4 rounded-lg mb-6">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="flex-shrink-0">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" stroke-linecap="round"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Link verifikasi baru telah dikirim ke email kamu.
                </div>
            @endif

            {{-- Tombol kirim ulang --}}
            <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-lg text-white text-sm font-medium transition-opacity hover:opacity-90"
                    style="background:#D4621A;">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            {{-- Tombol logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full py-3 rounded-lg text-sm font-medium border border-gray-200 text-gray-500 bg-white hover:bg-gray-50 transition-colors">
                    Logout
                </button>
            </form>

            <p class="text-center text-xs text-gray-400 mt-6 leading-relaxed">
                Tidak menerima email? Cek folder spam atau
                <span style="color:#D4621A; cursor:pointer;" onclick="this.closest('form') || document.querySelector('form').submit()">
                    kirim ulang
                </span>
                setelah beberapa menit.
            </p>

        </div>
    </div>

</div>

</body>
</html>