<x-sidebar-layout>
    <x-slot name="header">
        <div style="font-family:'DM Serif Display',serif; font-size:26px; color:#1A1A18; line-height:1.2;">Dashboard</div>
        <div style="color:#8A8A7A; font-size:13px; margin-top:4px;">Selamat datang kembali, {{ auth()->user()->name }} 👋</div>
    </x-slot>
    
    {{-- Stats Grid --}}
    <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:28px;">

        {{-- Total --}}
        <div style="background:#ffffff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
            onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#1A1A18;"></div>
            <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Total Laporan</div>
            <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#1A1A18; margin-bottom:6px;">{{ $total }}</div>
            <div style="font-size:11px; color:#8A8A7A;">Semua laporan masuk</div>
        </div>

        {{-- Pending --}}
        <div style="background:#ffffff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
            onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#C9A227;"></div>
            <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Pending</div>
            <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#C9A227; margin-bottom:6px;">{{ $pending }}</div>
            <div style="font-size:11px; color:#8A8A7A;">Menunggu tindakan</div>
        </div>

        {{-- Diproses --}}
        <div style="background:#ffffff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
            onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#2A5BA8;"></div>
            <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Diproses</div>
            <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#2A5BA8; margin-bottom:6px;">{{ $diproses }}</div>
            <div style="font-size:11px; color:#8A8A7A;">Sedang ditangani</div>
        </div>

        {{-- Selesai --}}
        <div style="background:#ffffff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; position:relative; overflow:hidden; transition:transform 0.2s;"
            onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
            onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="position:absolute; top:0; left:0; right:0; height:3px; background:#2D7A4F;"></div>
            <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:12px;">Selesai</div>
            <div style="font-family:'DM Serif Display',serif; font-size:38px; line-height:1; color:#2D7A4F; margin-bottom:6px;">{{ $selesai }}</div>
            <div style="font-size:11px; color:#8A8A7A;">Laporan dituntaskan</div>
        </div>

    </div>

    {{-- Laporan Terbaru --}}
    <div>
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <div style="font-family:'DM Serif Display',serif; font-size:18px; color:#1A1A18;">Laporan Terbaru</div>
            <a href="{{ route('laporan.index') }}"
                style="padding:7px 16px; border:1.5px solid #D4621A; background:transparent; color:#D4621A; border-radius:7px; font-family:'DM Sans',sans-serif; font-size:12px; font-weight:600; text-decoration:none; transition:all 0.2s;"
                onmouseover="this.style.background='#D4621A';this.style.color='#fff'"
                onmouseout="this.style.background='transparent';this.style.color='#D4621A'">
                Lihat Semua →
            </a>
        </div>

        <div style="background:#ffffff; border-radius:12px; border:1.5px solid #D8D4CC; overflow:hidden;">
            {{-- Table Head --}}
            <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr; padding:12px 20px; background:#F8F6F2; border-bottom:1.5px solid #D8D4CC; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.7px; color:#8A8A7A;">
                <span>Judul Laporan</span>
                <span>Pelapor</span>
                <span>Status</span>
                <span>Tanggal</span>
            </div>

            {{-- Table Rows --}}
            @forelse($terbaru as $laporan)
            <div style="display:grid; grid-template-columns:2fr 1fr 1fr 1fr; padding:14px 20px; border-bottom:1px solid #F0EDE8; font-size:13px; align-items:center; transition:background 0.15s; cursor:pointer;"
                onmouseover="this.style.background='#FAFAF8'"
                onmouseout="this.style.background=''"
                onclick="window.location='{{ route('laporan.show', $laporan) }}'">
                <span style="font-weight:500; color:#1A1A18;">{{ $laporan->judul }}</span>
                <span style="color:#8A8A7A; font-size:12px;">{{ $laporan->user->name }}</span>
                <span>
                    @php
                        $style = match($laporan->status) {
                            'pending'  => 'background:#FEF3CD; color:#92740E;',
                            'diproses' => 'background:#DBEAFE; color:#1E4A8A;',
                            default    => 'background:#D1FAE5; color:#1A5C38;',
                        };
                        $dot = match($laporan->status) {
                            'pending'  => '#C9A227',
                            'diproses' => '#2A5BA8',
                            default    => '#2D7A4F',
                        };
                    @endphp
                    <span style="display:inline-flex; align-items:center; gap:5px; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600; {{ $style }}">
                        <span style="width:5px; height:5px; border-radius:50%; background:{{ $dot }}; flex-shrink:0; display:inline-block;"></span>
                        {{ ucfirst($laporan->status) }}
                    </span>
                </span>
                <span style="color:#8A8A7A; font-size:12px;">{{ $laporan->created_at->format('d M Y') }}</span>
            </div>
            @empty
            <div style="padding:32px; text-align:center; color:#8A8A7A; font-size:13px;">Belum ada laporan</div>
            @endforelse
        </div>
    </div>

</x-sidebar-layout>