<x-sidebar-layout>
    <x-slot name="header">
        <div style="font-family:'DM Serif Display',serif; font-size:26px; color:#1A1A18; line-height:1.2;">Dashboard</div>
        <div style="color:#8A8A7A; font-size:13px; margin-top:4px;">Selamat datang kembali, {{ auth()->user()->name }} 👋</div>
    </x-slot>

    {{-- STATISTIK --}}
    <div style="margin-bottom:32px;">
        <div style="font-family:'DM Serif Display',serif; font-size:18px; color:#1A1A18; margin-bottom:16px;">Statistik</div>
        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px;">

            {{-- Total --}}
            <div style="background:#fff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
                onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#1A1A18;"></div>
                <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Total Laporan</div>
                <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#1A1A18; margin-bottom:6px;">{{ $total }}</div>
                <div style="font-size:11px; color:#8A8A7A;">Semua laporan masuk</div>
            </div>

            {{-- Pending --}}
            <div style="background:#fff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
                onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#C9A227;"></div>
                <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Pending</div>
                <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#C9A227; margin-bottom:6px;">{{ $pending }}</div>
                <div style="font-size:11px; color:#8A8A7A;">Menunggu tindakan</div>
            </div>

            {{-- Diproses --}}
            <div style="background:#fff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
                onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#2A5BA8;"></div>
                <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Diproses</div>
                <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#2A5BA8; margin-bottom:6px;">{{ $diproses }}</div>
                <div style="font-size:11px; color:#8A8A7A;">Sedang ditangani</div>
            </div>

            {{-- Selesai --}}
            <div style="background:#fff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
                onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
                onmouseout="this.style.transform='';this.style.boxShadow=''">
                <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#2D7A4F;"></div>
                <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Selesai</div>
                <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#2D7A4F; margin-bottom:6px;">{{ $selesai }}</div>
                <div style="font-size:11px; color:#8A8A7A;">Laporan dituntaskan</div>
            </div>
        </div>
    </div>

    {{-- DAFTAR LAPORAN --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
        <div style="font-family:'DM Serif Display',serif; font-size:18px; color:#1A1A18;">
            {{ auth()->user()->isAdmin() ? 'Semua Laporan Terbaru' : 'Laporan Saya' }}
        </div>
        <div style="display:flex; gap:10px; align-items:center;">
            {{-- Tombol Buat Laporan Khusus Warga --}}
            @if(!auth()->user()->isAdmin())
            <a href="{{ route('laporan.create') }}"
                style="padding:7px 16px; background:#D4621A; color:#fff; border-radius:7px; font-family:'DM Sans',sans-serif; font-size:12px; font-weight:600; text-decoration:none;">
                + Buat Laporan
            </a>
            @endif
            
            <a href="{{ route('laporan.index') }}"
                style="padding:7px 16px; border:1.5px solid #D4621A; background:transparent; color:#D4621A; border-radius:7px; font-family:'DM Sans',sans-serif; font-size:12px; font-weight:600; text-decoration:none;"
                onmouseover="this.style.background='#D4621A';this.style.color='#fff'"
                onmouseout="this.style.background='transparent';this.style.color='#D4621A'">
                Lihat Semua →
            </a>
        </div>
    </div>

    @php 
        $daftarLaporan = auth()->user()->isAdmin() ? $terbaru : $myLaporan; 
    @endphp

    @if($daftarLaporan->isEmpty())
        <div style="background:#fff; border-radius:12px; border:1.5px solid #D8D4CC; padding:48px; text-align:center;">
            <div style="font-size:32px; margin-bottom:12px; opacity:0.3;">📋</div>
            <div style="font-size:14px; color:#8A8A7A; margin-bottom:16px;">Belum ada laporan yang tersedia</div>
            @if(!auth()->user()->isAdmin())
            <a href="{{ route('laporan.create') }}"
                style="padding:10px 24px; background:#D4621A; color:#fff; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; text-decoration:none;">
                Buat Laporan Pertama
            </a>
            @endif
        </div>
    @else
        <div style="display:flex; flex-direction:column; gap:12px;">
            @foreach($daftarLaporan as $laporan)
                @php
                    $badgeStyle = match($laporan->status) {
                        'pending'  => 'background:#FEF3CD; color:#92740E;',
                        'diproses' => 'background:#DBEAFE; color:#1E4A8A;',
                        default    => 'background:#D1FAE5; color:#1A5C38;',
                    };
                    $dotColor = match($laporan->status) {
                        'pending'  => '#C9A227',
                        'diproses' => '#2A5BA8',
                        default    => '#2D7A4F',
                    };
                @endphp

                <div style="background:#fff; border-radius:12px; border:1.5px solid #D8D4CC; padding:18px 22px; display:flex; justify-content:space-between; align-items:center; transition:all 0.2s; cursor:pointer;"
                    onmouseover="this.style.borderColor='#E8A87C';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.06)'"
                    onmouseout="this.style.borderColor='#D8D4CC';this.style.boxShadow=''"
                    onclick="window.location='{{ route('laporan.show', $laporan) }}'">

                    {{-- Info Laporan --}}
                    <div style="flex:1; min-width:0;">
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                            <span style="font-size:10px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#D4621A; background:rgba(212,98,26,0.08); padding:2px 8px; border-radius:20px;">
                                {{ $laporan->kategori }}
                            </span>
                            <span style="display:inline-flex; align-items:center; gap:4px; padding:2px 8px; border-radius:20px; font-size:11px; font-weight:600; {{ $badgeStyle }}">
                                <span style="width:5px; height:5px; border-radius:50%; background:{{ $dotColor }}; display:inline-block;"></span>
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </div>
                        <div style="font-family:'DM Serif Display',serif; font-size:15px; color:#1A1A18; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:480px;">
                            {{ $laporan->judul }}
                        </div>
                        <div style="font-size:12px; color:#8A8A7A;">
                            📍 {{ $laporan->lokasi }} · {{ $laporan->created_at->format('d M Y') }}
                        </div>
                    </div>

                    {{-- Meta & Aksi --}}
                    <div style="display:flex; align-items:center; gap:16px; margin-left:16px; flex-shrink:0;">
                        <div style="text-align:center;">
                            <div style="font-size:16px; font-weight:700; color:#1A1A18;">{{ $laporan->komentars->count() }}</div>
                            <div style="font-size:10px; color:#8A8A7A;">💬 Komentar</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-sidebar-layout>