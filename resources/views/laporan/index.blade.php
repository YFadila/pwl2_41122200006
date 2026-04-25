<x-sidebar-layout>
    <x-slot name="header">
        <h3 class="text-2xl font-bold text-gray-900" style="font-family: 'DM Serif Display', serif;">
            Daftar Laporan
        </h3>
        <div style="color:#8A8A7A; font-size:13px; margin-top:4px;">Semua laporan yang masuk dari warga</div>
    </x-slot>

    {{-- Toolbar --}}
    <div style="display:flex; gap:12px; margin-bottom:22px; align-items:center;">
        <form method="GET" action="{{ route('laporan.index') }}" style="display:flex; gap:12px; flex:1; align-items:center;">

            <div style="flex:1; position:relative;">
                <span style="position:absolute; left:13px; top:50%; transform:translateY(-50%); color:#8A8A7A;">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari laporan..."
                    style="width:100%; padding:10px 14px 10px 38px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13.5px; background:#fff; color:#1A1A18; outline:none;">
            </div>

            <select name="status" style="padding:10px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; background:#fff; color:#4A4A42; outline:none; min-width:140px;">
                <option value="">Semua Status</option>
                <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                <option value="diproses" @selected(request('status') == 'diproses')>Diproses</option>
                <option value="selesai" @selected(request('status') == 'selesai')>Selesai</option>
            </select>

            <select name="kategori" style="padding:10px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; background:#fff; color:#4A4A42; outline:none; min-width:140px;">
                <option value="">Semua Kategori</option>
                <option value="Infrastruktur & Jalan" @selected(request('kategori') == 'Infrastruktur & Jalan')>Infrastruktur & Jalan</option>
                <option value="Sampah & Kebersihan" @selected(request('kategori') == 'Sampah & Kebersihan')>Sampah & Kebersihan</option>
                <option value="Air & Drainase" @selected(request('kategori') == 'Air & Drainase')>Air & Drainase</option>
                <option value="Fasilitas Umum" @selected(request('kategori') == 'Fasilitas Umum')>Fasilitas Umum</option>
                <option value="Lainnya" @selected(request('kategori') == 'Lainnya')>Lainnya</option>
            </select>

            <button type="submit" style="padding:10px 18px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">Filter</button>
            <a href="{{ route('laporan.index') }}" style="padding:10px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-size:13px; color:#4A4A42; text-decoration:none;">Reset</a>
        </form>

        <a href="{{ route('laporan.create') }}" style="padding:10px 20px; background:#D4621A; color:#fff; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; text-decoration:none; white-space:nowrap; display:flex; align-items:center; gap:7px;">
            + Buat Laporan
        </a>
    </div>

    @if(session('success'))
        <div style="background:#D1FAE5; color:#1A5C38; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:13px;">{{ session('success') }}</div>
    @endif

    {{-- Grid Laporan --}}
    <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:16px;">
        @forelse($laporans as $laporan)
        <div style="background:#fff; border-radius:12px; border:1.5px solid #D8D4CC; padding:20px 22px; transition:transform 0.2s, box-shadow 0.2s; cursor:pointer;"
            onclick="window.location='{{ route('laporan.show', $laporan) }}'"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.07)';this.style.borderColor='#E8A87C'"
            onmouseout="this.style.transform='';this.style.boxShadow='';this.style.borderColor='#D8D4CC'">

            {{-- Card Top --}}
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:10px;">
                <span style="font-size:10px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#D4621A; background:rgba(212,98,26,0.08); padding:3px 9px; border-radius:20px;">
                    {{ $laporan->kategori }}
                </span>
                @php
                    $badgeStyle = match($laporan->status) {
                        'pending'  => 'background:#FEF3CD; color:#92740E;',
                        'diproses' => 'background:#DBEAFE; color:#1E4A8A;',
                        default    => 'background:#D1FAE5; color:#1A5C38;',
                    };
                @endphp
                <span style="display:inline-flex; align-items:center; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600; {{ $badgeStyle }}">
                    {{ ucfirst($laporan->status) }}
                </span>
            </div>

            {{-- Title & Desc --}}
            <div style="font-family:'DM Serif Display',serif; font-size:16px; color:#1A1A18; margin-bottom:6px; line-height:1.3;">
                {{ $laporan->judul }}
            </div>
            <div style="font-size:12.5px; color:#8A8A7A; line-height:1.5; margin-bottom:16px; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">
                {{ $laporan->deskripsi }}
            </div>

            {{-- Card Footer --}}
            <div style="display:flex; justify-content:space-between; align-items:center; padding-top:14px; border-top:1px solid #F0EDE8;">
                <div style="display:flex; align-items:center; gap:8px;">
                    <div style="width:24px; height:24px; border-radius:50%; background:linear-gradient(135deg,#D4621A,#E8A87C); display:flex; align-items:center; justify-content:center; font-size:9px; font-weight:700; color:#fff;">
                        {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-size:12px; font-weight:500; color:#4A4A42;">{{ $laporan->user->name }}</div>
                        <div style="font-size:11px; color:#8A8A7A;">{{ $laporan->created_at->format('d M Y') }}</div>
                    </div>
                </div>
                <div style="display:flex; align-items:center; gap:10px;">
                    {{-- Jumlah Komentar --}}
                    <span style="display:flex; align-items:center; gap:4px; font-size:11px; color:#8A8A7A;">
                        💬 {{ $laporan->komentars->count() }}
                    </span>

                    @if(auth()->user()->isAdmin())
                    <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="font-size:12px; color:#dc2626; background:none; border:none; cursor:pointer; font-family:'DM Sans',sans-serif;">Hapus</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:48px; color:#8A8A7A; font-size:14px;">
            Belum ada laporan
        </div>
        @endforelse
    </div>

</x-sidebar-layout>