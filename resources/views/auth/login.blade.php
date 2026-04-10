<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — LaporWarga</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .brand { font-family: 'DM Serif Display', serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="min-h-screen grid grid-cols-2">

    {{-- Kiri: Branding --}}
    <div class="flex flex-col justify-center px-16 py-12 relative overflow-hidden" style="background:#1A1A18;">

        {{-- Dekorasi lingkaran --}}
        <div class="absolute -top-20 -right-20 w-72 h-72 rounded-full" style="background: radial-gradient(circle, rgba(212,98,26,0.15) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-16 -left-16 w-60 h-60 rounded-full" style="background: radial-gradient(circle, rgba(212,98,26,0.08) 0%, transparent 70%);"></div>

        <div class="brand text-5xl text-white mb-3 relative z-10">
            Kata<span style="color:#E8A87C;">Warga</span>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed max-w-xs mb-10 relative z-10">
            Ini deskripsi singkat.
        </p>

        <div class="relative z-10 space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-orange-500 flex-shrink-0"></div>
                <span class="text-gray-400 text-sm">Ini poin 1.</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-orange-500 flex-shrink-0"></div>
                <span class="text-gray-400 text-sm">Ini poin 2.</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-2 h-2 rounded-full bg-orange-500 flex-shrink-0"></div>
                <span class="text-gray-400 text-sm">Ini poin 3.</span>
            </div>
        </div>
    </div>

    {{-- Kanan: Form Login --}}
    <div class="flex items-center justify-center px-12 py-12" style="background:#F5F2ED;">
        <div class="w-full max-w-sm">

            <h2 class="brand text-3xl text-gray-800 mb-1">Selamat Datang</h2>
            <p class="text-gray-400 text-sm mb-8">Masuk ke akun kamu untuk melanjutkan</p>

            {{-- Session Status --}}
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