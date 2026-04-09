<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaporWarga</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .sidebar { background: #1A1A18; min-height: 100vh; width: 240px; position: fixed; left: 0; top: 0; }
        .main-content { margin-left: 240px; min-height: 100vh; background: #F5F2ED; }
        .brand { font-family: 'DM Serif Display', serif; }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex">

    {{-- SIDEBAR --}}
    <aside class="sidebar flex flex-col p-5">

        {{-- Logo --}}
        <div class="brand text-2xl text-white mb-8">
            Kata<span style="color:#E8A87C;">Warga</span>
        </div>

        {{-- Menu --}}
        <div class="text-xs text-gray-500 uppercase tracking-widest mb-3">Menu</div>

        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-3 px-3 py-2 rounded text-sm mb-1
            {{ request()->routeIs('dashboard') ? 'bg-orange-600 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
                <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
            </svg>
            Dashboard
        </a>

        <a href="{{ route('laporan.index') }}"
            class="flex items-center gap-3 px-3 py-2 rounded text-sm mb-1
            {{ request()->routeIs('laporan.*') ? 'bg-orange-600 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
            </svg>
            Laporan
        </a>

        {{-- Bottom User Info --}}
        <div class="mt-auto">
            <div class="border-t border-gray-700 pt-4">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="text-white text-sm font-medium">{{ auth()->user()->name }}</div>
                        <div class="text-gray-500 text-xs">{{ ucfirst(auth()->user()->role) }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-3 py-2 rounded text-sm text-gray-400 hover:text-white hover:bg-gray-800 w-full">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main-content flex-1 p-8">

        {{-- Header --}}
        @isset($header)
        <div class="mb-6">
            {{ $header }}
        </div>
        @endisset

        {{-- Content --}}
        {{ $slot }}

    </main>

</div>

</body>
</html>