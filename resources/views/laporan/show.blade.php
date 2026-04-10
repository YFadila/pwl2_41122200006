<x-sidebar-layout>
    <x-slot name="header">
        <a href="{{ route('laporan.index') }}" style="font-size:13px; color:#8A8A7A; text-decoration:none; display:inline-flex; align-items:center; gap:6px; margin-bottom:8px;">
            ← Kembali ke Daftar Laporan
        </a>
        <div style="font-family:'DM Serif Display',serif; font-size:26px; color:#1A1A18;">Detail Laporan</div>
    </x-slot>

    @if(session('success'))
        <div style="background:#D1FAE5; color:#1A5C38; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:13px;">{{ session('success') }}</div>
    @endif

    <div style="display:grid; grid-template-columns:1fr 320px; gap:24px; align-items:start;">

        {{-- Main Detail --}}
        <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; overflow:hidden;">

            {{-- Foto --}}
            @if($laporan->foto)
                <img src="{{ Storage::url($laporan->foto) }}" style="width:100%; height:220px; object-fit:cover;">
            @else
                <div style="width:100%; height:220px; background:linear-gradient(135deg,#D8D4CC,#E8E4DC); display:flex; align-items:center; justify-content:center; font-size:48px; opacity:0.3;">🖼</div>
            @endif

            <div style="padding:28px 32px;">

                {{-- Meta Top --}}
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">
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
                    <span style="display:inline-flex; align-items:center; padding:6px 14px; border-radius:20px; font-size:12px; font-weight:600; {{ $badgeStyle }}">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>

                {{-- Judul --}}
                <div style="font-family:'DM Serif Display',serif; font-size:24px; color:#1A1A18; margin-bottom:8px; line-height:1.3;">
                    {{ $laporan->judul }}
                </div>

                {{-- Author --}}
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px; padding-bottom:20px; border-bottom:1.5px solid #F0EDE8;">
                    <div style="width:36px; height:36px; border-radius:50%; background:linear-gradient(135deg,#D4621A,#E8A87C); display:flex; align-items:center; justify-content:center; font-size:13px; font-weight:700; color:#fff; flex-shrink:0;">
                        {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-size:13px; font-weight:500; color:#4A4A42;">{{ $laporan->user->name }}</div>
                        <div style="font-size:12px; color:#8A8A7A;">Dilaporkan pada {{ $laporan->created_at->format('d F Y') }}</div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div style="font-size:14px; color:#4A4A42; line-height:1.7; margin-bottom:28px;">
                    {{ $laporan->deskripsi }}
                </div>

                {{-- Lokasi & Peta --}}
                <div style="margin-bottom:24px;">
                    <div style="font-size:12px; color:#8A8A7A; margin-bottom:8px;">📍 {{ $laporan->lokasi }}</div>
                    @if($laporan->latitude && $laporan->longitude)
                        <div id="map-detail" style="height:200px; border-radius:8px; border:1.5px solid #D8D4CC;"></div>
                    @endif
                </div>

                {{-- Update Status (Admin Only) --}}
                @if(auth()->user()->isAdmin())
                <div style="margin-bottom:28px; padding:16px; background:#F8F6F2; border-radius:10px; border:1.5px solid #D8D4CC;">
                    <div style="font-size:12px; font-weight:600; color:#4A4A42; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px;">Update Status</div>
                    <form action="{{ route('laporan.update', $laporan) }}" method="POST" style="display:flex; gap:10px; align-items:center;">
                        @csrf
                        @method('PUT')
                        <select name="status" style="padding:9px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; background:#fff; color:#1A1A18; outline:none;">
                            <option value="pending" @selected($laporan->status == 'pending')>Pending</option>
                            <option value="diproses" @selected($laporan->status == 'diproses')>Diproses</option>
                            <option value="selesai" @selected($laporan->status == 'selesai')>Selesai</option>
                        </select>
                        <button type="submit" style="padding:9px 20px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                            Simpan
                        </button>
                    </form>
                </div>
                @endif

                {{-- Komentar --}}
                <div>
                    <div style="font-family:'DM Serif Display',serif; font-size:18px; color:#1A1A18; margin-bottom:18px; display:flex; align-items:center; gap:10px;">
                        Diskusi
                        <span style="background:#1A1A18; color:#fff; font-size:11px; font-family:'DM Sans',sans-serif; font-weight:600; padding:2px 8px; border-radius:20px;">
                            {{ $laporan->komentars->count() }} komentar
                        </span>
                    </div>

                    {{-- Input Komentar --}}
                    <form action="{{ route('komentar.store', $laporan->id) }}" method="POST" style="display:flex; gap:12px; margin-bottom:22px; align-items:flex-start;">
                        @csrf
                        <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#D4621A,#E8A87C); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#fff; flex-shrink:0; margin-top:4px;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div style="flex:1;">
                            <textarea name="isi" rows="3" required placeholder="Tulis komentar atau tanggapan..."
                                style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:10px; font-family:'DM Sans',sans-serif; font-size:13px; background:#FAFAF8; color:#1A1A18; outline:none; resize:none; line-height:1.5; box-sizing:border-box;"></textarea>
                            <div style="text-align:right; margin-top:8px;">
                                <button type="submit" style="padding:8px 20px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:12px; font-weight:600; cursor:pointer;">
                                    Kirim Komentar
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- List Komentar --}}
                    @forelse($laporan->komentars as $komentar)
                    <div style="display:flex; gap:12px; margin-bottom:18px; padding-bottom:18px; border-bottom:1px solid #F0EDE8;" id="komentar-{{ $komentar->id }}">
                        <div style="width:32px; height:32px; border-radius:50%; background:linear-gradient(135deg,#7C9EB2,#5A7A8E); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; color:#fff; flex-shrink:0;">
                            {{ strtoupper(substr($komentar->user->name, 0, 2)) }}
                        </div>
                        <div style="flex:1;">
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:6px;">
                                <span style="font-size:13px; font-weight:600; color:#1A1A18;">{{ $komentar->user->name }}</span>
                                <span style="font-size:11px; color:#8A8A7A;">{{ $komentar->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div style="font-size:13px; color:#4A4A42; line-height:1.5; margin-bottom:8px;">{{ $komentar->isi }}</div>

                            <button onclick="toggleReply({{ $komentar->id }})" style="font-size:12px; color:#D4621A; background:none; border:none; cursor:pointer; font-family:'DM Sans',sans-serif; font-weight:500;">
                                ↩ Balas
                            </button>

                            {{-- Form Reply --}}
                            <div id="reply-form-{{ $komentar->id }}" style="display:none; margin-top:12px; padding-left:20px; border-left:2px solid #F0EDE8;">
                                <form action="{{ route('komentar.store', $laporan->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $komentar->id }}">
                                    <textarea name="isi" rows="2" required placeholder="Tulis balasan..."
                                        style="width:100%; padding:9px 12px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; background:#FAFAF8; outline:none; resize:none; box-sizing:border-box;"></textarea>
                                    <div style="display:flex; gap:8px; margin-top:8px;">
                                        <button type="submit" style="padding:6px 16px; background:#D4621A; color:#fff; border:none; border-radius:6px; font-family:'DM Sans',sans-serif; font-size:12px; font-weight:600; cursor:pointer;">Kirim</button>
                                        <button type="button" onclick="toggleReply({{ $komentar->id }})" style="padding:6px 16px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:6px; font-family:'DM Sans',sans-serif; font-size:12px; cursor:pointer;">Batal</button>
                                    </div>
                                </form>
                            </div>

                            {{-- Balasan --}}
                            @foreach($komentar->replies as $reply)
                            <div style="margin-top:12px; padding-left:20px; border-left:2px solid rgba(212,98,26,0.2);">
                                <div style="display:flex; align-items:center; gap:8px; margin-bottom:4px;">
                                    <div style="width:24px; height:24px; border-radius:50%; background:linear-gradient(135deg,#D4621A,#E8A87C); display:flex; align-items:center; justify-content:center; font-size:9px; font-weight:700; color:#fff;">
                                        {{ strtoupper(substr($reply->user->name, 0, 2)) }}
                                    </div>
                                    <span style="font-size:12px; font-weight:600; color:#1A1A18;">{{ $reply->user->name }}</span>
                                    <span style="font-size:11px; color:#8A8A7A;">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                <div style="font-size:13px; color:#4A4A42; line-height:1.5;">{{ $reply->isi }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    <div style="text-align:center; padding:32px; color:#8A8A7A; font-size:13px;">Belum ada komentar</div>
                    @endforelse
                </div>

            </div>
        </div>

        {{-- Sidebar Info --}}
        <div>
            {{-- Info Laporan --}}
            <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:22px 24px; margin-bottom:16px;">
                <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#8A8A7A; margin-bottom:16px;">Informasi Laporan</div>
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; font-size:13px;">
                    <span style="color:#8A8A7A;">Status</span>
                    @php $bs = match($laporan->status) { 'pending' => 'background:#FEF3CD;color:#92740E;', 'diproses' => 'background:#DBEAFE;color:#1E4A8A;', default => 'background:#D1FAE5;color:#1A5C38;' }; @endphp
                    <span style="padding:6px 14px; border-radius:20px; font-size:12px; font-weight:600; {{ $bs }}">{{ ucfirst($laporan->status) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:12px; font-size:13px;">
                    <span style="color:#8A8A7A;">Kategori</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->kategori }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:12px; font-size:13px;">
                    <span style="color:#8A8A7A;">Pelapor</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->user->name }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:12px; font-size:13px;">
                    <span style="color:#8A8A7A;">Tanggal</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->created_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:13px;">
                    <span style="color:#8A8A7A;">Komentar</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->komentars->count() }}</span>
                </div>
            </div>

            {{-- Timeline --}}
            <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:22px 24px;">
                <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#8A8A7A; margin-bottom:16px;">Timeline Status</div>
                <div style="position:relative; padding-left:16px;">
                    <div style="position:absolute; left:5px; top:6px; bottom:6px; width:1.5px; background:#D8D4CC;"></div>

                    <div style="position:relative; margin-bottom:14px; font-size:12.5px; color:#8A8A7A;">
                        <div style="position:absolute; left:-14px; top:4px; width:8px; height:8px; border-radius:50%; background:{{ in_array($laporan->status, ['diproses','selesai']) ? '#2D7A4F' : '#D8D4CC' }}; border:2px solid #F5F2ED;"></div>
                        <strong style="display:block; color:#1A1A18; font-size:12px; margin-bottom:2px;">Laporan Diterima</strong>
                        {{ $laporan->created_at->format('d M Y, H:i') }}
                    </div>

                    <div style="position:relative; margin-bottom:14px; font-size:12.5px; color:#8A8A7A;">
                        <div style="position:absolute; left:-14px; top:4px; width:8px; height:8px; border-radius:50%; background:{{ in_array($laporan->status, ['diproses','selesai']) ? '#D4621A' : '#D8D4CC' }}; border:2px solid #F5F2ED;"></div>
                        <strong style="display:block; color:#1A1A18; font-size:12px; margin-bottom:2px;">Sedang Diproses</strong>
                        {{ $laporan->status == 'diproses' || $laporan->status == 'selesai' ? $laporan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                    </div>

                    <div style="position:relative; font-size:12.5px; color:#8A8A7A;">
                        <div style="position:absolute; left:-14px; top:4px; width:8px; height:8px; border-radius:50%; background:{{ $laporan->status == 'selesai' ? '#2D7A4F' : '#D8D4CC' }}; border:2px solid #F5F2ED;"></div>
                        <strong style="display:block; color:#1A1A18; font-size:12px; margin-bottom:2px;">Selesai</strong>
                        {{ $laporan->status == 'selesai' ? $laporan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet Map Detail --}}
    @if($laporan->latitude && $laporan->longitude)
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map-detail').setView([{{ $laporan->latitude }}, {{ $laporan->longitude }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([{{ $laporan->latitude }}, {{ $laporan->longitude }}]).addTo(map).bindPopup("{{ $laporan->judul }}").openPopup();
    </script>
    @endif

    <script>
    function toggleReply(id) {
        const form = document.getElementById('reply-form-' + id);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }
    </script>

</x-sidebar-layout>