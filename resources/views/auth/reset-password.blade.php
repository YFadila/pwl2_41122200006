<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password — KataWarga</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .brand { font-family: 'DM Serif Display', serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="min-h-screen grid grid-cols-2">

    {{-- Branding + Ilustrasi --}}
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
                Buat password baru yang kuat untuk mengamankan kembali akunmu.
            </p>
        </div>

        {{-- Ilustrasi SVG --}}
        <div class="relative z-10 flex-1 flex items-center justify-center py-8">
            <svg viewBox="0 0 340 280" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%; max-width:320px;">
                <path d="M170 30 L260 68 L260 148 C260 196 170 240 170 240 C170 240 80 196 80 148 L80 68 Z"
                    fill="#242422" stroke="rgba(212,98,26,0.3)" stroke-width="1.5"/>

                <path d="M170 50 L244 82 L244 148 C244 186 170 222 170 222 C170 222 96 186 96 148 L96 82 Z"
                    fill="#1E1E1C" stroke="rgba(212,98,26,0.15)" stroke-width="1"/>

                <rect x="148" y="138" width="44" height="34" rx="6"
                    fill="rgba(212,98,26,0.2)" stroke="#D4621A" stroke-width="1.2"/>
                <path d="M160 138v-10a10 10 0 0 1 20 0v10"
                    stroke="#D4621A" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                <circle cx="170" cy="155" r="4" fill="#E8A87C" opacity="0.8"/>
                <rect x="168.5" y="155" width="3" height="7" rx="1.5" fill="#E8A87C" opacity="0.6"/>

                <circle cx="230" cy="80" r="14" fill="rgba(45,122,79,0.2)" stroke="rgba(45,122,79,0.4)" stroke-width="1"/>
                <path d="M224 80l4 4 8-8" stroke="#5DCAA5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>

                <rect x="60" y="210" width="220" height="50" rx="10"
                    fill="#2A2A28" stroke="rgba(255,255,255,0.07)" stroke-width="1"/>

                <rect x="74" y="220" width="60" height="4" rx="2" fill="rgba(255,255,255,0.2)"/>

                <rect x="74" y="230" width="140" height="20" rx="5"
                    fill="rgba(255,255,255,0.05)" stroke="rgba(212,98,26,0.3)" stroke-width="1"/>
                @for($i = 0; $i < 8; $i++)
                <circle cx="{{ 84 + ($i * 16) }}" cy="240" r="2.5" fill="#E8A87C" opacity="0.5"/>
                @endfor

                <rect x="74" y="254" width="140" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>
                <rect x="74" y="254" width="105" height="3" rx="1.5" fill="#2D7A4F" opacity="0.7"/>
                <rect x="186" y="252" width="28" height="7" rx="3" fill="rgba(45,122,79,0.2)"/>
                <rect x="189" y="254" width="22" height="3" rx="1.5" fill="#5DCAA5" opacity="0.5"/>

                <rect x="14" y="110" width="48" height="72" rx="8"
                    fill="#1E1E1C" stroke="rgba(255,255,255,0.05)" stroke-width="1"/>

                <circle cx="38" cy="128" r="8" fill="rgba(212,98,26,0.15)"/>
                <text x="38" y="132" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="8" fill="#E8A87C" opacity="0.7">8+</text>
                <rect x="20" y="140" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.1)"/>
                <rect x="22" y="146" width="32" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>

                <circle cx="38" cy="163" r="8" fill="rgba(212,98,26,0.15)"/>
                <path d="M34 163h4M38 159v4" stroke="#E8A87C" stroke-width="1.2" stroke-linecap="round" opacity="0.7"/>
                <rect x="20" y="175" width="36" height="3" rx="1.5" fill="rgba(255,255,255,0.06)"/>

                <circle cx="310" cy="100" r="2.5" fill="#D4621A" opacity="0.2"/>
                <circle cx="320" cy="120" r="1.5" fill="#D4621A" opacity="0.15"/>
                <circle cx="28" cy="210" r="2" fill="#D4621A" opacity="0.2"/>
                <circle cx="18" cy="228" r="1.5" fill="rgba(255,255,255,0.06)"/>
            </svg>
        </div>

        {{-- Bottom: tips --}}
        <div class="relative z-10 space-y-3">
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Gunakan minimal 8 karakter</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Kombinasikan huruf besar, kecil, dan angka</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-1.5 h-1.5 rounded-full flex-shrink-0" style="background:#D4621A;"></div>
                <span class="text-xs" style="color:rgba(255,255,255,0.4);">Jangan gunakan password yang sama dengan akun lain</span>
            </div>
        </div>
    </div>

    {{-- Kanan: Form --}}
    <div class="flex items-center justify-center px-12 py-12" style="background:#F5F2ED;">
        <div class="w-full max-w-sm">

            <h2 class="brand text-3xl text-gray-800 mb-1">Reset Password</h2>
            <p class="text-gray-400 text-sm mb-8">Masukkan password baru untuk akunmu.</p>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email --}}
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500 @error('email') border-red-400 @enderror"
                        placeholder="email@contoh.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Password Baru</label>
                    <input type="password" name="password" required id="password-input"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500 @error('password') border-red-400 @enderror"
                        placeholder="Minimal 8 karakter"
                        oninput="checkStrength(this.value)">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    {{-- Password strength indicator --}}
                    <div class="mt-2">
                        <div style="height:3px; background:#E8E4DC; border-radius:2px; overflow:hidden;">
                            <div id="strength-bar" style="height:100%; width:0%; border-radius:2px; transition:all 0.3s;"></div>
                        </div>
                        <p id="strength-label" class="text-xs mt-1" style="color:#8A8A7A;"></p>
                    </div>
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm bg-white focus:outline-none focus:border-orange-500"
                        placeholder="Ulangi password baru">
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-lg text-white text-sm font-medium transition-opacity hover:opacity-90"
                    style="background:#D4621A;">
                    Simpan Password Baru
                </button>

                <p class="text-center text-sm text-gray-400 mt-6">
                    Ingat password?
                    <a href="{{ route('login') }}" class="text-orange-500 hover:underline font-medium">Masuk di sini</a>
                </p>
            </form>
        </div>
    </div>

</div>

<script>
function checkStrength(val) {
    const bar   = document.getElementById('strength-bar');
    const label = document.getElementById('strength-label');
    let strength = 0;
    if (val.length >= 8)               strength++;
    if (/[A-Z]/.test(val))             strength++;
    if (/[0-9]/.test(val))             strength++;
    if (/[^A-Za-z0-9]/.test(val))      strength++;

    const config = [
        { width: '0%',   color: '',        text: '' },
        { width: '25%',  color: '#EF4444', text: 'Lemah' },
        { width: '50%',  color: '#F59E0B', text: 'Cukup' },
        { width: '75%',  color: '#3B82F6', text: 'Kuat' },
        { width: '100%', color: '#10B981', text: 'Sangat kuat' },
    ];

    bar.style.width      = val.length ? config[strength].width : '0%';
    bar.style.background = config[strength].color;
    label.textContent    = val.length ? config[strength].text : '';
    label.style.color    = config[strength].color;
}
</script>

</body>
</html>