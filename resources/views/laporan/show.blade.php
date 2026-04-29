<x-sidebar-layout>
    <x-slot name="header">
        <a href="{{ route('laporan.index') }}"
            class="inline-flex items-center gap-2 px-3 py-1.5 mb-5 text-[13px] font-medium text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-50 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Daftar Laporan
        </a>
        <h3 class="text-2xl font-bold text-gray-900" style="font-family: 'DM Serif Display', serif;">
            Detail Laporan
        </h3>
    </x-slot>

    @if(session('success'))
        <div style="background:#D1FAE5; color:#1A5C38; padding:12px 16px; border-radius:8px; margin-bottom:16px; font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- LIGHTBOX CONTAINER (Hidden by default) --}}
    <div id="lightbox" style="display:none; position:fixed; z-index:9999; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); align-items:center; justify-content:center; backdrop-filter: blur(4px);">
        <button onclick="closeLightbox()" style="position:absolute; top:20px; right:30px; background:none; border:none; color:white; font-size:36px; font-weight:bold; cursor:pointer; padding:10px;">&times;</button>
        <img id="lightbox-img" src="" style="max-width:90%; max-height:90vh; border-radius:8px; object-fit:contain; box-shadow: 0 4px 20px rgba(0,0,0,0.5);">
    </div>

    <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; overflow:hidden;">

        {{-- Foto --}}
        @if($laporan->foto)
            <img src="{{ Storage::url($laporan->foto) }}" 
                 onclick="openLightbox('{{ Storage::url($laporan->foto) }}')"
                 style="width:100%; height:260px; object-fit:cover; cursor:zoom-in; transition: opacity 0.2s;"
                 onmouseover="this.style.opacity=0.9"
                 onmouseout="this.style.opacity=1"
                 title="Klik untuk memperbesar">
        @else
            <div style="width:100%; height:200px; background:#F0EDE8; display:flex; align-items:center; justify-content:center;">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="6" y="10" width="36" height="28" rx="4" stroke="#C0BCB4" stroke-width="2" fill="none"/>
                    <circle cx="17" cy="20" r="4" stroke="#C0BCB4" stroke-width="2" fill="none"/>
                    <path d="M6 32 L16 22 L24 30 L32 22 L42 32" stroke="#C0BCB4" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        @endif

        <div style="padding:24px 28px;">

            {{-- Badge & Status --}}
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <span style="font-size:10px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#D4621A; background:rgba(212,98,26,0.08); padding:3px 10px; border-radius:20px;">
                    {{ $laporan->kategori }}
                </span>
                @php
                    $badgeStyle = match($laporan->status) {
                        'pending'  => 'background:#FEF3CD; color:#92740E;',
                        'diproses' => 'background:#DBEAFE; color:#1E4A8A;',
                        default    => 'background:#D1FAE5; color:#1A5C38;',
                    };
                @endphp
                <span style="padding:5px 14px; border-radius:20px; font-size:12px; font-weight:600; {{ $badgeStyle }}">
                    {{ ucfirst($laporan->status) }}
                </span>
            </div>

            {{-- Judul --}}
            <div style="font-family:'DM Serif Display',serif; font-size:22px; color:#1A1A18; margin-bottom:10px; line-height:1.3;">
                {{ $laporan->judul }}
            </div>

            {{-- Author --}}
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px; padding-bottom:20px; border-bottom:1.5px solid #F0EDE8;">
                <div style="width:34px; height:34px; border-radius:50%; background:#D4621A; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:700; color:#fff; flex-shrink:0;">
                    {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                </div>
                <div>
                    <div style="font-size:13px; font-weight:500; color:#4A4A42;">{{ $laporan->user->name }}</div>
                    <div style="font-size:12px; color:#8A8A7A;">Dilaporkan pada {{ $laporan->created_at->format('d F Y') }}</div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div style="font-size:14px; color:#4A4A42; line-height:1.7; margin-bottom:24px;">
                {{ $laporan->deskripsi }}
            </div>

            {{-- Lokasi --}}
            <div style="display:flex; gap:8px; align-items:flex-start; margin-bottom:12px;">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0; margin-top:2px;">
                    <path d="M8 1.5a4.5 4.5 0 0 1 4.5 4.5C12.5 9.5 8 14.5 8 14.5S3.5 9.5 3.5 6A4.5 4.5 0 0 1 8 1.5z" stroke="#8A8A7A" stroke-width="1.2" fill="none"/>
                    <circle cx="8" cy="6" r="1.5" fill="#8A8A7A"/>
                </svg>
                <span style="font-size:13px; color:#8A8A7A; line-height:1.5;">{{ $laporan->lokasi }}</span>
            </div>

            {{-- Peta --}}
            @if($laporan->latitude && $laporan->longitude)
                <div id="map-detail" style="height:200px; border-radius:8px; border:1.5px solid #D8D4CC; margin-bottom:24px;"></div>
            @endif

            {{-- Tab Bar --}}
            <div style="display:flex; border-bottom:1.5px solid #D8D4CC; margin-bottom:0;">
                <button onclick="window.switchTab('info', this)"
                    class="lap-tab lap-tab-active"
                    style="flex:1; padding:11px 0; font-size:13px; font-weight:500; color:#1A1A18; background:none; border:none; border-bottom:2px solid #1A1A18; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.15s;">
                    Info Laporan
                </button>
                <button onclick="window.switchTab('timeline', this)"
                    class="lap-tab"
                    style="flex:1; padding:11px 0; font-size:13px; font-weight:400; color:#8A8A7A; background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.15s;">
                    Timeline
                </button>
                <button onclick="window.switchTab('diskusi', this)"
                    class="lap-tab"
                    style="flex:1; padding:11px 0; font-size:13px; font-weight:400; color:#8A8A7A; background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; font-family:'DM Sans',sans-serif; transition:all 0.15s;">
                    Diskusi
                    <span style="display:inline-block; background:#1A1A18; color:#fff; font-size:10px; font-weight:600; padding:1px 7px; border-radius:20px; margin-left:5px;">
                        {{ $laporan->total_komentars }}
                    </span>
                </button>
            </div>

            {{-- Tab: Info Laporan --}}
            <div id="tab-info" class="lap-panel" style="padding-top:18px;">

                <div style="display:flex; justify-content:space-between; align-items:center; padding:10px 0; border-bottom:1px solid #F0EDE8; font-size:13px;">
                    <span style="color:#8A8A7A;">Status</span>
                    <span style="padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600; {{ $badgeStyle }}">{{ ucfirst($laporan->status) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #F0EDE8; font-size:13px;">
                    <span style="color:#8A8A7A;">Kategori</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->kategori }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #F0EDE8; font-size:13px;">
                    <span style="color:#8A8A7A;">Pelapor</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->user->name }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #F0EDE8; font-size:13px;">
                    <span style="color:#8A8A7A;">Tanggal</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->created_at->format('d M Y') }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; padding:10px 0; font-size:13px;">
                    <span style="color:#8A8A7A;">Komentar</span>
                    <span style="color:#1A1A18; font-weight:500;">{{ $laporan->total_komentars }}</span>
                </div>

                {{-- Update Status (Admin Only) --}}
                @if(auth()->user()->isAdmin())
                <div style="margin-top:20px; padding:16px; background:#F8F6F2; border-radius:10px; border:1.5px solid #D8D4CC;">
                    <div style="font-size:12px; font-weight:600; color:#4A4A42; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px;">Update Status</div>
                    <form action="{{ route('laporan.update', $laporan) }}" method="POST" style="display:flex; gap:10px; align-items:center;">
                        @csrf
                        @method('PUT')
                        <select name="status" style="padding:9px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; background:#fff; color:#1A1A18; outline:none;">
                            <option value="pending"  @selected($laporan->status == 'pending') >Pending</option>
                            <option value="diproses" @selected($laporan->status == 'diproses')>Diproses</option>
                            <option value="selesai"  @selected($laporan->status == 'selesai') >Selesai</option>
                        </select>
                        <button type="submit" style="padding:9px 20px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                            Simpan
                        </button>
                    </form>
                </div>
                @endif

            </div>

            {{-- Tab: Timeline --}}
            <div id="tab-timeline" class="lap-panel" style="display:none; padding-top:20px;">
                <div style="position:relative; padding-left:20px;">
                    <div style="position:absolute; left:7px; top:8px; bottom:8px; width:1.5px; background:#D8D4CC;"></div>

                    {{-- Step 1: Diterima --}}
                    <div style="position:relative; margin-bottom:22px;">
                        <div style="position:absolute; left:-18px; top:3px; width:10px; height:10px; border-radius:50%;
                            background:{{ in_array($laporan->status, ['pending','diproses','selesai']) ? '#2D7A4F' : '#D8D4CC' }};
                            border:2px solid #fff; box-shadow:0 0 0 1.5px #D8D4CC;"></div>
                        <div style="font-size:13px; font-weight:600; color:#1A1A18; margin-bottom:2px;">Laporan Diterima</div>
                        <div style="font-size:12px; color:#8A8A7A;">{{ $laporan->created_at->format('d M Y, H:i') }}</div>
                    </div>

                    {{-- Step 2: Diproses --}}
                    <div style="position:relative; margin-bottom:22px;">
                        <div style="position:absolute; left:-18px; top:3px; width:10px; height:10px; border-radius:50%;
                            background:{{ in_array($laporan->status, ['diproses','selesai']) ? '#D4621A' : '#D8D4CC' }};
                            border:2px solid #fff; box-shadow:0 0 0 1.5px #D8D4CC;"></div>
                        <div style="font-size:13px; font-weight:600; color:{{ in_array($laporan->status, ['diproses','selesai']) ? '#1A1A18' : '#8A8A7A' }}; margin-bottom:2px;">Sedang Diproses</div>
                        <div style="font-size:12px; color:#8A8A7A;">
                            {{ in_array($laporan->status, ['diproses','selesai']) ? $laporan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                        </div>
                    </div>

                    {{-- Step 3: Selesai --}}
                    <div style="position:relative;">
                        <div style="position:absolute; left:-18px; top:3px; width:10px; height:10px; border-radius:50%;
                            background:{{ $laporan->status == 'selesai' ? '#2D7A4F' : '#D8D4CC' }};
                            border:2px solid #fff; box-shadow:0 0 0 1.5px #D8D4CC;"></div>
                        <div style="font-size:13px; font-weight:600; color:{{ $laporan->status == 'selesai' ? '#1A1A18' : '#8A8A7A' }}; margin-bottom:2px;">Selesai</div>
                        <div style="font-size:12px; color:#8A8A7A;">
                            {{ $laporan->status == 'selesai' ? $laporan->updated_at->format('d M Y, H:i') : 'Menunggu...' }}
                        </div>
                    </div>
                </div>
            </div>

{{-- Tab: Diskusi --}}
<div id="tab-diskusi" class="lap-panel hidden pt-6">

    {{-- Input Komentar - Discord style --}}
    <form action="{{ route('komentar.store', $laporan->id) }}" method="POST" class="mb-6">
        @csrf
        <div class="flex gap-3 items-start bg-stone-100 rounded-xl px-3 py-2.5">
            <div class="w-8 h-8 rounded-full bg-orange-600 flex items-center justify-center text-xs font-bold text-white flex-shrink-0 mt-0.5">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
            <textarea name="isi" rows="1" required placeholder="Tulis komentar..."
                class="flex-1 bg-transparent border-none outline-none resize-none text-sm text-stone-900 placeholder-stone-400 leading-relaxed py-1 font-sans"
                oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px'"></textarea>
            <button type="submit"
                class="self-end px-3 py-1.5 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-xs font-semibold cursor-pointer transition-colors flex-shrink-0">
                Kirim
            </button>
        </div>
    </form>

    {{-- List Komentar --}}
    <div class="flex flex-col">
        @forelse($laporan->komentars as $komentar)
            @include('laporan.partials.komentar-item', ['komentar' => $komentar, 'laporan' => $laporan, 'depth' => 0])
        @empty
            <div class="text-center py-10 px-5">
                <div class="text-3xl mb-2">💬</div>
                <div class="text-sm font-medium text-stone-500">Belum ada komentar.</div>
                <div class="text-xs text-stone-400 mt-1">Jadilah yang pertama berkomentar!</div>
            </div>
        @endforelse
    </div>

</div>
        </div>
    </div>

    {{-- Leaflet Map --}}
    @if($laporan->latitude && $laporan->longitude)
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map-detail').setView([{{ $laporan->latitude }}, {{ $laporan->longitude }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
        L.marker([{{ $laporan->latitude }}, {{ $laporan->longitude }}])
            .addTo(map)
            .bindPopup("{{ $laporan->judul }}")
            .openPopup();
    </script>
    @endif

    {{-- JAVASCRIPT: Tabs & Lightbox --}}
    <script>
        // Mengamankan scope dengan object window agar terbaca dari inline onClick
        window.switchTab = function(name, btn) {
            document.querySelectorAll('.lap-panel').forEach(p => p.style.display = 'none');
            document.querySelectorAll('.lap-tab').forEach(b => {
                b.style.color = '#8A8A7A';
                b.style.fontWeight = '400';
                b.style.borderBottom = '2px solid transparent';
            });
            document.getElementById('tab-' + name).style.display = 'block';
            btn.style.color = '#1A1A18';
            btn.style.fontWeight = '500';
            btn.style.borderBottom = '2px solid #1A1A18';
        }

        window.toggleReply = function(id) {
            const form = document.getElementById('reply-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        window.toggleEdit = function(id) {
            const content = document.getElementById('komentar-content-' + id);
            const editForm = document.getElementById('edit-form-' + id);
            if (editForm.style.display === 'none') {
                editForm.style.display = 'block';
                content.style.display = 'none';
            } else {
                editForm.style.display = 'none';
                content.style.display = 'block';
            }
        }

        // --- Fitur Lightbox ---
        window.openLightbox = function(src) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox').style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Kunci scroll halaman
        }

        window.closeLightbox = function() {
            document.getElementById('lightbox').style.display = 'none';
            document.body.style.overflow = 'auto'; // Kembalikan scroll
        }

        document.getElementById('lightbox').addEventListener('click', function(e) {
            if (e.target !== document.getElementById('lightbox-img')) {
                window.closeLightbox();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && document.getElementById('lightbox').style.display === 'flex') {
                window.closeLightbox();
            }
        });

        window.addEventListener('DOMContentLoaded', (event) => {
            if (window.location.hash === '#diskusi') {
                const btn = document.querySelector('.lap-tab:nth-child(3)');
                if (btn) window.switchTab('diskusi', btn);
            }
        });
    </script>

</x-sidebar-layout>