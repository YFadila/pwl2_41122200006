<x-sidebar-layout>
    <x-slot name="header">
        {{-- Header: Judul + Search + CTA --}}
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <div>
                <h3 class="text-2xl font-bold text-gray-900" style="font-family:'DM Serif Display',serif;">
                    Daftar Laporan
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Semua laporan yang masuk dari warga</p>
            </div>

            <div class="flex items-center gap-2.5">
                {{-- Search (expand on click) --}}
                <div id="search-wrapper" class="relative flex items-center">
                    <form method="GET" action="{{ route('laporan.index') }}" id="search-form">
                        @foreach(request()->except('search') as $k => $v)
                            @if($v)<input type="hidden" name="{{ $k }}" value="{{ $v }}">@endif
                        @endforeach

                        <input type="text" name="search" id="search-input"
                            value="{{ request('search') }}"
                            placeholder="Cari laporan..."
                            class="transition-all duration-200 ease-in-out rounded-lg border border-transparent bg-white text-sm text-gray-800 outline-none pr-9 placeholder-gray-400"
                            style="
                                width: {{ request('search') ? '220px' : '0px' }};
                                opacity: {{ request('search') ? '1' : '0' }};
                                padding: {{ request('search') ? '8px 36px 8px 14px' : '8px 0' }};
                                border-color: {{ request('search') ? '#D8D4CC' : 'transparent' }};
                            ">

                        <button type="submit" id="search-btn"
                            class="absolute right-1.5 top-1/2 -translate-y-1/2 p-1.5 rounded-md bg-stone-100 border border-stone-200 text-stone-600 hover:bg-stone-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- CTA --}}
                <a href="{{ route('laporan.create') }}"
                    class="flex items-center gap-1.5 px-4 py-2 rounded-lg bg-[#D4621A] hover:bg-[#B8511A] text-white text-sm font-semibold whitespace-nowrap transition-colors"
                    style="font-family:'DM Sans',sans-serif;">
                    + Buat Laporan
                </a>
            </div>
        </div>
    </x-slot>

    {{-- Filter Row --}}
    <div class="sticky top-0 z-10 bg-[#F7F5F0] -mx-px mb-5 px-0 py-2.5 border-b border-stone-200">
        <form method="GET" action="{{ route('laporan.index') }}" id="filter-form">
            @if(request('search'))
                <input type="hidden" name="search" value="{{ request('search') }}">
            @endif

            <div class="flex items-center gap-2 flex-wrap">

                {{-- Chip: Status --}}
                @php $hasStatus = (bool) request('status'); @endphp
                <div class="relative">
                    <select name="status" onchange="document.getElementById('filter-form').submit()"
                        class="appearance-none cursor-pointer outline-none text-xs font-medium rounded-full pl-3.5 pr-8 py-1.5 border transition-colors
                               {{ $hasStatus ? 'border-[#D4621A] bg-[#FFF5EF] text-[#D4621A] font-semibold' : 'border-stone-300 bg-white text-stone-600' }}"
                        style="font-family:'DM Sans',sans-serif;">
                        <option value="">Semua Status</option>
                        <option value="pending"  @selected(request('status') == 'pending')>Pending</option>
                        <option value="diproses" @selected(request('status') == 'diproses')>Diproses</option>
                        <option value="selesai"  @selected(request('status') == 'selesai')>Selesai</option>
                    </select>
                    <span class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px]
                                 {{ $hasStatus ? 'text-[#D4621A]' : 'text-stone-400' }}">▾</span>
                </div>

                {{-- Chip: Kategori --}}
                @php $hasKategori = (bool) request('kategori'); @endphp
                <div class="relative">
                    <select name="kategori" onchange="document.getElementById('filter-form').submit()"
                        class="appearance-none cursor-pointer outline-none text-xs font-medium rounded-full pl-3.5 pr-8 py-1.5 border transition-colors
                               {{ $hasKategori ? 'border-[#D4621A] bg-[#FFF5EF] text-[#D4621A] font-semibold' : 'border-stone-300 bg-white text-stone-600' }}"
                        style="font-family:'DM Sans',sans-serif;">
                        <option value="">Semua Kategori</option>
                        <option value="Infrastruktur & Jalan" @selected(request('kategori') == 'Infrastruktur & Jalan')>Infrastruktur & Jalan</option>
                        <option value="Sampah & Kebersihan"   @selected(request('kategori') == 'Sampah & Kebersihan')>Sampah & Kebersihan</option>
                        <option value="Air & Drainase"        @selected(request('kategori') == 'Air & Drainase')>Air & Drainase</option>
                        <option value="Fasilitas Umum"        @selected(request('kategori') == 'Fasilitas Umum')>Fasilitas Umum</option>
                        <option value="Lainnya"               @selected(request('kategori') == 'Lainnya')>Lainnya</option>
                    </select>
                    <span class="pointer-events-none absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px]
                                 {{ $hasKategori ? 'text-[#D4621A]' : 'text-stone-400' }}">▾</span>
                </div>

                {{-- Toggle Pill: Laporan Saya --}}
                @php $milikSaya = (bool) request('milik_saya'); @endphp
                <label class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border cursor-pointer select-none transition-colors
                              {{ $milikSaya ? 'border-[#D4621A] bg-[#FFF5EF] text-[#D4621A] font-semibold' : 'border-stone-300 bg-white text-stone-600' }}"
                    style="font-family:'DM Sans',sans-serif; font-size:12.5px;">
                    {{-- Mini toggle switch --}}
                    <span class="relative inline-block w-6 h-3.5 flex-shrink-0">
                        <span class="block w-full h-full rounded-full transition-colors
                                     {{ $milikSaya ? 'bg-[#D4621A]' : 'bg-stone-300' }}"></span>
                        <span class="absolute top-0.5 w-2.5 h-2.5 rounded-full bg-white shadow transition-all
                                     {{ $milikSaya ? 'left-[13px]' : 'left-0.5' }}"></span>
                    </span>
                    Laporan Saya
                    <input type="checkbox" name="milik_saya" value="1"
                        {{ $milikSaya ? 'checked' : '' }}
                        onchange="document.getElementById('filter-form').submit()"
                        class="absolute opacity-0 w-0 h-0">
                </label>

                {{-- Badge jumlah filter aktif --}}
                @php
                    $activeFilters = collect(['status', 'kategori', 'milik_saya'])
                        ->filter(fn($k) => request($k))->count();
                @endphp
                @if($activeFilters > 0)
                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-[#D4621A]/10 text-[#D4621A] text-xs font-semibold"
                    title="{{ $activeFilters }} filter aktif">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none"
                        stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                    </svg>
                    {{ $activeFilters }} aktif
                </span>
                @endif

                <div class="flex-1"></div>

                {{-- Reset filter --}}
                @if(request('status') || request('kategori') || request('milik_saya') || request('search'))
                <a href="{{ route('laporan.index') }}"
                    class="text-xs text-stone-400 hover:text-[#D4621A] px-1.5 py-1 rounded transition-colors"
                    style="font-family:'DM Sans',sans-serif;">
                    Reset filter
                </a>
                @endif

            </div>
        </form>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div class="bg-emerald-50 text-emerald-800 px-4 py-3 rounded-lg mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- Grid Laporan --}}
    <div class="grid grid-cols-2 gap-4">
        @forelse($laporans as $laporan)

        @php
            $badgeClass = match($laporan->status) {
                'pending'  => 'bg-amber-50 text-amber-700',
                'diproses' => 'bg-blue-50 text-blue-700',
                default    => 'bg-emerald-50 text-emerald-700',
            };
        @endphp

        <div class="bg-white rounded-xl border border-stone-200 p-5 cursor-pointer transition-all duration-200
                    hover:-translate-y-0.5 hover:shadow-lg hover:border-[#E8A87C]"
            onclick="window.location='{{ route('laporan.show', $laporan) }}'">

            {{-- Card Top --}}
            <div class="flex items-start justify-between mb-2.5">
                <span class="text-[10px] font-semibold tracking-widest uppercase text-[#D4621A] bg-[#D4621A]/8 px-2.5 py-1 rounded-full">
                    {{ $laporan->kategori }}
                </span>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold {{ $badgeClass }}">
                    {{ ucfirst($laporan->status) }}
                </span>
            </div>

            {{-- Title & Desc --}}
            <div class="text-base text-gray-900 mb-1.5 leading-snug" style="font-family:'DM Serif Display',serif;">
                {{ $laporan->judul }}
            </div>
            <p class="text-xs text-stone-400 leading-relaxed mb-4 line-clamp-2">
                {{ $laporan->deskripsi }}
            </p>

            {{-- Card Footer --}}
            <div class="flex items-center justify-between pt-3.5 border-t border-stone-100">
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[9px] font-bold text-white"
                        style="background:linear-gradient(135deg,#D4621A,#E8A87C)">
                        {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="text-xs font-medium text-stone-700">{{ $laporan->user->name }}</div>
                        <div class="text-[11px] text-stone-400">{{ $laporan->created_at->format('d M Y') }}</div>
                    </div>
                </div>

                <div class="flex items-center gap-2.5">
                    <span class="flex items-center gap-1 text-[11px] text-stone-400">
                        💬 {{ $laporan->komentars->count() }}
                    </span>

                    @if(auth()->user()->isAdmin())
                    <form action="{{ route('laporan.destroy', $laporan) }}" method="POST"
                        onclick="event.stopPropagation()"
                        onsubmit="return confirm('Hapus laporan ini?')"
                        class="inline">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="p-1.5 rounded-md text-stone-400 hover:text-red-600 hover:bg-red-50 transition-colors cursor-pointer"
                            title="Hapus laporan">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                <path d="M10 11v6M14 11v6"/>
                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                            </svg>
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        @empty
        <div class="col-span-2 text-center py-12 text-stone-400 text-sm">
            Belum ada laporan
        </div>
        @endforelse
    </div>

</x-sidebar-layout>

<script>
(function () {
    const wrapper = document.getElementById('search-wrapper');
    const btn     = document.getElementById('search-btn');
    const input   = document.getElementById('search-input');
    if (!btn || !input) return;

    const open = () => {
        input.style.width       = '220px';
        input.style.opacity     = '1';
        input.style.padding     = '8px 36px 8px 14px';
        input.style.borderColor = '#D8D4CC';
        input.dataset.open      = 'true';
        input.focus();
    };

    const close = () => {
        input.style.width       = '0px';
        input.style.opacity     = '0';
        input.style.padding     = '8px 0';
        input.style.borderColor = 'transparent';
        input.dataset.open      = 'false';
    };

    if (input.value.trim()) { input.dataset.open = 'true'; }

    btn.addEventListener('click', (e) => {
        if (input.dataset.open !== 'true') { e.preventDefault(); open(); }
    });

    document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target) && !input.value.trim()) close();
    });
})();
</script>