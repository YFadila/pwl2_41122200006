<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://unpkg.com/lucide@latest"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda — KataWarga</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --accent:  #D4621A;
            --accent2: #E8A87C;
            --pending: #C9A227;
            --diproses: #2A5BA8;
            --selesai:  #2D7A4F;
            --ditolak:  #C0392B;
        }
        body { font-family: 'DM Sans', sans-serif; }
        .font-serif-display { font-family: 'DM Serif Display', serif; }

        .badge-dot::before {
            content: ''; display: inline-block;
            width: 5px; height: 5px; border-radius: 50%; flex-shrink: 0;
        }
        .badge-pending::before  { background: var(--pending); }
        .badge-diproses::before { background: var(--diproses); }
        .badge-selesai::before  { background: var(--selesai); }
        .badge-ditolak::before  { background: var(--ditolak); }

        [data-lucide] { width: 20px; height: 20px; stroke-width: 2px; }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #D8D4CC; border-radius: 3px; }

        .hero-glow::before {
            content: '';
            position: absolute; top: -120px; right: -120px;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(212,98,26,0.18) 0%, transparent 65%);
            pointer-events: none;
        }
        .hero-glow::after {
            content: '📣';
            position: absolute; right: 60px; bottom: -20px;
            font-size: 170px; opacity: 0.04; pointer-events: none;
        }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-[#F5F2ED] text-[#1A1A18] overflow-x-hidden" style="min-height:100vh; display:flex; flex-direction:column;">

{{-- TOPBAR --}}
<nav class="sticky top-0 z-[100] bg-[#1A1A18] border-b-2 border-[#D4621A] flex items-center justify-between px-[60px] h-[60px]">
    <a href="{{ route('beranda') }}" class="font-serif-display text-[22px] text-white no-underline">
        Kata<span class="text-[#E8A87C]">Warga</span>
    </a>

    <div class="flex gap-7 items-center">
        <a href="{{ route('beranda') }}"   class="text-[13px] text-white no-underline">Beranda</a>
        <a href="#cara-kerja"             class="text-[13px] text-[#888] hover:text-white no-underline transition-colors">Cara Kerja</a>
        <a href="#aktivitas-warga"        class="text-[13px] text-[#888] hover:text-white no-underline transition-colors">Laporan</a>
        <a href="#" onclick="openTentangPanel(event)" class="text-[13px] text-[#888] hover:text-white no-underline transition-colors">Tentang</a>
    </div>

    <div class="flex gap-2.5 items-center">
        @auth
            <a href="{{ route('dashboard') }}" class="px-[18px] py-2 bg-[#D4621A] hover:bg-[#BF5515] text-white rounded-[7px] text-[13px] font-semibold no-underline transition-colors">Dashboard</a>
        @else
            <a href="{{ route('login') }}"    class="px-[18px] py-2 border border-[#444] hover:border-[#888] text-[#ccc] hover:text-white rounded-[7px] text-[13px] font-medium no-underline transition-all">Masuk</a>
            <a href="{{ route('register') }}" class="px-[18px] py-2 bg-[#D4621A] hover:bg-[#BF5515] text-white rounded-[7px] text-[13px] font-semibold no-underline transition-colors">Daftar</a>
        @endauth
    </div>
</nav>

{{-- HERO --}}
<section class="bg-[#1A1A18] px-[60px] pt-20 pb-[68px] relative overflow-hidden hero-glow">
    <div class="max-w-[860px] mx-auto relative z-10">

        <div class="inline-flex items-center gap-2 bg-[rgba(212,98,26,0.15)] border border-[rgba(212,98,26,0.3)] rounded-[20px] px-4 py-[5px] text-[11px] font-semibold tracking-[1.2px] uppercase text-[#E8A87C] mb-[26px]">
            ✦ Platform Aspirasi Warga
        </div>

        <h1 class="font-serif-display text-[54px] text-white leading-[1.08] mb-5">
            Suara Warga,<br><span class="text-[#E8A87C]">Perubahan Nyata</span>
        </h1>

        <p class="text-base text-[#999] leading-[1.75] max-w-[520px] mb-[38px]">
            KataWarga adalah platform pelaporan masalah lingkungan untuk warga. Sampaikan laporan, pantau status, dan lihat dampak nyata di sekitar Anda.
        </p>

        <div class="flex gap-3.5 items-center mb-14">
            @auth
                <a href="{{ route('laporan.create') }}" class="px-[30px] py-3.5 bg-[#D4621A] hover:bg-[#BF5515] text-white rounded-[9px] text-sm font-semibold no-underline transition-colors">Mulai Lapor Sekarang</a>
                <a href="#cara-kerja" class="px-[30px] py-3.5 border border-[#333] hover:border-[#888] text-[#bbb] hover:text-white rounded-[9px] text-sm font-medium no-underline transition-all">Lihat Cara Kerja</a>
            @else
                <a href="{{ route('register') }}" class="px-[30px] py-3.5 bg-[#D4621A] hover:bg-[#BF5515] text-white rounded-[9px] text-sm font-semibold no-underline transition-colors">Mulai Lapor Sekarang</a>
                <a href="{{ route('login') }}"    class="px-[30px] py-3.5 border border-[#333] hover:border-[#888] text-[#bbb] hover:text-white rounded-[9px] text-sm font-medium no-underline transition-all">Masuk ke Akun</a>
            @endauth
        </div>

        <div class="flex border-t border-[#2a2a28] pt-9">
            @foreach([
                [$total,              'Total Laporan Masuk'],
                [$selesai,            'Laporan Diselesaikan'],
                [$diproses,           'Sedang Diproses'],
                [$tingkatRespons.'%', 'Tingkat Respons'],
            ] as [$num, $label])
            <div class="flex-1 pr-9 mr-9 border-r border-[#2a2a28] last:border-r-0 last:mr-0 last:pr-0">
                <div class="font-serif-display text-[36px] text-white leading-none mb-1">{{ $num }}</div>
                <div class="text-[12px] text-[#555]">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- BODY --}}
<div class="bg-[#F5F2ED] pb-[60px]" style="flex:1;">

    <div class="max-w-[900px] mx-auto px-[60px] pt-[60px]">
        <div class="text-[10px] font-bold tracking-[1.6px] uppercase text-[#D4621A] mb-2.5">Kategori Laporan</div>
        <div class="font-serif-display text-[30px] text-[#1A1A18] leading-[1.2] mb-2.5">Laporkan Masalah di Sekitarmu</div>
        <p class="text-sm text-[#8A8A7A] leading-[1.65] max-w-[520px] mb-[38px]">Pilih kategori sesuai masalah yang ingin Anda laporkan kepada pihak berwenang.</p>

        <div class="grid grid-cols-6 gap-3">
            @foreach([
                ['road',        'Jalan Rusak'],
                ['lightbulb',   'Lampu Jalan'],
                ['trash-2',     'Sampah'],
                ['droplets',    'Saluran Air'],
                ['tree-pine',   'Pohon Tumbang'],
                ['layout-grid', 'Lainnya'],
            ] as [$icon, $label])
            <a href="{{ route('laporan.index', ['kategori' => $label]) }}"
               class="bg-white border border-[#D8D4CC] hover:border-[#D4621A] hover:bg-[rgba(212,98,26,0.04)] rounded-xl p-[18px_10px] text-center no-underline block transition-all hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex justify-center items-center mb-2"><i data-lucide="{{ $icon }}"></i></div>
                <div class="text-[11px] font-semibold text-[#4A4A42]">{{ $label }}</div>
            </a>
            @endforeach
        </div>
    </div>

    <div class="h-[1.5px] bg-[#D8D4CC] max-w-[900px] mx-auto mt-[60px]"></div>

    <div id="cara-kerja" class="max-w-[900px] mx-auto px-[60px] pt-[60px]">
        <div class="text-[10px] font-bold tracking-[1.6px] uppercase text-[#D4621A] mb-2.5">Cara Kerja</div>
        <div class="font-serif-display text-[30px] text-[#1A1A18] leading-[1.2] mb-2.5">Alur Pembuatan Laporan</div>
        <p class="text-sm text-[#8A8A7A] leading-[1.65] max-w-[520px] mb-[38px]">Ikuti langkah berikut untuk menyampaikan laporan Anda hingga ditindaklanjuti oleh pihak berwenang.</p>

        @php
        $alurSteps = [
            ['id'=>'login',     'num'=>'1', 'icon'=>'user-plus',      'label'=>'Login',       'color'=>'#1A1A18', 'bg'=>'#1A1A18',              'border'=>'#3a3a36', 'text'=>'#fff',     'badge'=>null,
             'step'=>'Langkah 1', 'title'=>'Login ke KataWarga',
             'desc'=>'Masuk menggunakan akun yang terdaftar. Belum punya akun? Daftar terlebih dahulu — gratis dan hanya butuh beberapa menit.',
             'tags'=>['Email & Password','Daftar Gratis']],
            ['id'=>'buat',      'num'=>'2', 'icon'=>'file-text',      'label'=>'Buat Laporan','color'=>'#D4621A', 'bg'=>'rgba(212,98,26,0.12)', 'border'=>'#D4621A', 'text'=>'#D4621A','badge'=>null,
             'step'=>'Langkah 2', 'title'=>'Buat Laporan',
             'desc'=>'Pilih kategori, tuliskan judul dan deskripsi masalah, sertakan lokasi, lalu unggah foto sebagai bukti pendukung. Laporan yang lengkap memudahkan penanganan.',
             'tags'=>['Judul & Deskripsi','Lokasi','Foto Bukti','Kategori Masalah']],
            ['id'=>'tinjauan',  'num'=>'3', 'icon'=>'clock',          'label'=>'Tinjauan',    'color'=>'#C9A227', 'bg'=>'rgba(201,162,39,0.12)','border'=>'#C9A227', 'text'=>'#C9A227','badge'=>['label'=>'Pending','class'=>'bg-[#FEF3CD] text-[#92740E] badge-pending'],
             'step'=>'Langkah 3', 'title'=>'Laporan dalam Tinjauan',
             'desc'=>'Laporan Anda telah diterima dan dalam antrean tinjauan oleh tim verifikasi. Anda akan mendapat notifikasi begitu status berubah.',
             'tags'=>['Notifikasi Otomatis','Verifikasi Tim']],
            ['id'=>'diproses',  'num'=>'4', 'icon'=>'settings',       'label'=>'Diproses',    'color'=>'#2A5BA8', 'bg'=>'rgba(42,91,168,0.12)', 'border'=>'#2A5BA8', 'text'=>'#2A5BA8','badge'=>['label'=>'Diproses','class'=>'bg-[#DBEAFE] text-[#1E4A8A] badge-diproses'],
             'step'=>'Langkah 4', 'title'=>'Laporan Sedang Diproses',
             'desc'=>'Laporan telah diverifikasi dan diteruskan ke instansi atau petugas terkait. Tim di lapangan sedang menangani masalah sesuai laporan Anda.',
             'tags'=>['Diteruskan ke Petugas','Progres Dapat Dipantau']],
            ['id'=>'selesai',   'num'=>'5', 'icon'=>'check-circle',   'label'=>'Selesai',     'color'=>'#2D7A4F', 'bg'=>'rgba(45,122,79,0.12)', 'border'=>'#2D7A4F', 'text'=>'#2D7A4F','badge'=>['label'=>'Selesai','class'=>'bg-[#D1FAE5] text-[#1A5C38] badge-selesai'],
             'step'=>'Langkah 5', 'title'=>'Laporan Telah Dituntaskan',
             'desc'=>'Masalah yang Anda laporkan telah ditangani dan diselesaikan. Terima kasih atas kontribusi Anda untuk lingkungan yang lebih baik!',
             'tags'=>['Masalah Tertangani','Notifikasi Selesai']],
            ['id'=>'ditolak',   'num'=>'6', 'icon'=>'x-circle',       'label'=>'Ditolak',     'color'=>'#C0392B', 'bg'=>'rgba(192,57,43,0.1)',  'border'=>'#C0392B', 'text'=>'#C0392B','badge'=>['label'=>'Ditolak','class'=>'bg-[#FDECEA] text-[#8B1A13] badge-ditolak'],
             'step'=>'Langkah 6', 'title'=>'Laporan Ditolak',
             'desc'=>'Laporan tidak dapat diproses karena tidak memenuhi syarat — data tidak lengkap, foto tidak valid, atau di luar cakupan. Anda dapat memperbaiki dan mengirim ulang.',
             'tags'=>['Alasan Penolakan Tersedia','Dapat Dikirim Ulang']],
            ['id'=>'diskusi',   'num'=>'✦', 'icon'=>'message-square', 'label'=>'Diskusi',     'color'=>'#D4621A', 'bg'=>'rgba(212,98,26,0.08)', 'border'=>'#E8A87C', 'text'=>'#D4621A','badge'=>null,
             'step'=>'Sepanjang Proses', 'title'=>'Diskusi Terbuka & Komentar',
             'desc'=>'Di setiap tahap, Anda dan warga lain dapat memberikan komentar, dukungan, atau informasi tambahan. Diskusi ini membantu mempercepat penanganan dan meningkatkan transparansi.',
             'tags'=>['Komentar Warga','Dukungan Laporan','Diskusi Publik']],
        ];
        @endphp

        {{-- Stepper horizontal --}}
        <div class="bg-white border border-[#D8D4CC] rounded-2xl overflow-hidden">

            <div class="flex items-start px-8 pt-7 pb-2 overflow-x-auto">
                @foreach($alurSteps as $i => $s)

                <div class="flex flex-col items-center flex-shrink-0" style="min-width:68px;">
                    <button
                        id="step-node-{{ $s['id'] }}"
                        onclick="selectStep('{{ $s['id'] }}')"
                        class="alur-node w-10 h-10 rounded-full flex items-center justify-center border-2 transition-all cursor-pointer mb-2"
                        style="background:{{ $s['bg'] }}; border-color:{{ $s['border'] }}; color:{{ $s['text'] }};">
                        <i data-lucide="{{ $s['icon'] }}" style="width:16px;height:16px;"></i>
                    </button>
                    <div id="step-label-{{ $s['id'] }}"
                        class="text-[10px] text-center leading-[1.3] transition-colors"
                        style="color:#8A8A7A; max-width:64px;">
                        {{ $s['label'] }}
                    </div>
                </div>

                @if(!$loop->last)
                <div class="flex-1 h-[1.5px] mt-5 mx-1 flex-shrink-0" style="background:#D8D4CC; min-width:12px;"></div>
                @endif

                @endforeach
            </div>

            {{-- Detail panel --}}
            @foreach($alurSteps as $s)
            <div id="step-detail-{{ $s['id'] }}"
                class="alur-detail px-8 py-6 border-t border-[#F0EDE8] {{ $loop->first ? '' : 'hidden' }}">
                <div class="flex items-start gap-5">
                    <div class="w-11 h-11 rounded-full flex items-center justify-center flex-shrink-0 border-2"
                        style="background:{{ $s['bg'] }}; border-color:{{ $s['border'] }}; color:{{ $s['text'] }};">
                        <i data-lucide="{{ $s['icon'] }}" style="width:17px;height:17px;"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-1.5">
                            <span class="text-[10px] font-bold tracking-[1px] uppercase text-[#8A8A7A]">{{ $s['step'] }}</span>
                            @if($s['badge'])
                            <span class="inline-flex items-center gap-1 px-2.5 py-[2px] rounded-full text-[11px] font-semibold badge-dot {{ $s['badge']['class'] }}">{{ $s['badge']['label'] }}</span>
                            @endif
                        </div>
                        <div class="font-serif-display text-[19px] text-[#1A1A18] mb-2 leading-[1.2]">{{ $s['title'] }}</div>
                        <div class="text-[13px] text-[#8A8A7A] leading-[1.7] mb-3">{{ $s['desc'] }}</div>
                        <div class="flex gap-2 flex-wrap">
                            @foreach($s['tags'] as $tag)
                            <span class="text-[11px] bg-[#F5F2ED] border border-[#D8D4CC] rounded-[6px] px-2.5 py-[3px] text-[#4A4A42] font-medium">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="flex justify-between items-center px-8 py-3.5 border-t border-[#F0EDE8] bg-[#FAFAF8]">
                <button id="step-prev" onclick="navigateStep(-1)"
                    class="flex items-center gap-1.5 text-[12px] text-[#8A8A7A] hover:text-[#1A1A18] transition-colors"
                    style="background:none; border:none; cursor:pointer; font-family:'DM Sans',sans-serif; visibility:hidden;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></svg>
                    Sebelumnya
                </button>
                <div class="text-[11px] text-[#8A8A7A]" id="step-counter">1 / 7</div>
                <button id="step-next" onclick="navigateStep(1)"
                    class="flex items-center gap-1.5 text-[12px] text-[#1A1A18] font-medium hover:text-[#D4621A] transition-colors"
                    style="background:none; border:none; cursor:pointer; font-family:'DM Sans',sans-serif;">
                    Selanjutnya
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></svg>
                </button>
            </div>

        </div>
        
        <div class="mt-10 bg-[#1A1A18] rounded-2xl px-10 py-9 flex items-center justify-between relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full pointer-events-none"
                style="background:radial-gradient(circle, rgba(212,98,26,0.15) 0%, transparent 70%);"></div>
            <div class="relative z-10">
                <div class="font-serif-display text-[22px] text-white mb-2">Siap membuat laporan?</div>
                <p class="text-[13px] text-[#888] max-w-[380px] leading-[1.6] m-0">
                    Bergabung bersama warga lain yang peduli lingkungan. Laporkan masalah dan pantau penanganannya secara transparan.
                </p>
            </div>
            <div class="flex gap-3 flex-shrink-0 relative z-10">
                @auth
                    <a href="{{ route('laporan.create') }}"
                        class="px-6 py-3 bg-[#D4621A] hover:bg-[#BF5515] text-white rounded-[9px] text-sm font-semibold no-underline transition-colors whitespace-nowrap">
                        Buat Laporan
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="px-6 py-3 bg-[#D4621A] hover:bg-[#BF5515] text-white rounded-[9px] text-sm font-semibold no-underline transition-colors whitespace-nowrap">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 border border-[#444] hover:border-[#888] text-[#ccc] hover:text-white rounded-[9px] text-sm font-medium no-underline transition-all whitespace-nowrap">
                        Masuk
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="h-[1.5px] bg-[#D8D4CC] max-w-[900px] mx-auto mt-[60px]"></div>

    <div id="aktivitas-warga" class="max-w-[900px] mx-auto px-[60px] pt-[60px]">
        <div class="flex justify-between items-end mb-2">
            <div>
                <div class="text-[10px] font-bold tracking-[1.6px] uppercase text-[#D4621A] mb-2.5">Laporan Terkini</div>
                <div class="font-serif-display text-[30px] text-[#1A1A18] leading-[1.2]">Aktivitas Warga</div>
            </div>
            <a href="{{ route('laporan.index') }}" class="px-[18px] py-2 border border-[#D4621A] text-[#D4621A] hover:bg-[#D4621A] hover:text-white rounded-[8px] text-[12px] font-semibold no-underline transition-all">
                Lihat Semua Laporan →
            </a>
        </div>
        <p class="text-sm text-[#8A8A7A] leading-[1.65] max-w-[520px] mt-2 mb-[38px]">Laporan terbaru yang masuk dari warga di berbagai wilayah.</p>

        <div class="grid grid-cols-2 gap-3.5">
            @forelse($laporanTerbaru as $laporan)
            @php
                $badgeClass = match($laporan->status) {
                    'pending'  => 'bg-[#FEF3CD] text-[#92740E] badge-pending',
                    'diproses' => 'bg-[#DBEAFE] text-[#1E4A8A] badge-diproses',
                    default    => 'bg-[#D1FAE5] text-[#1A5C38] badge-selesai',
                };
            @endphp
            <a href="{{ route('laporan.show', $laporan) }}"
               class="bg-white border border-[#D8D4CC] hover:border-[#E8A87C] rounded-xl p-[18px_20px] no-underline block transition-all hover:-translate-y-0.5 hover:shadow-lg">
                <div class="flex justify-between items-start mb-2.5">
                    <span class="text-[10px] font-semibold tracking-[0.8px] uppercase text-[#D4621A] bg-[rgba(212,98,26,0.08)] px-2.5 py-[3px] rounded-[20px]">{{ $laporan->kategori }}</span>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-[20px] text-[11px] font-semibold badge-dot {{ $badgeClass }}">{{ ucfirst($laporan->status) }}</span>
                </div>
                <div class="font-serif-display text-[15.5px] text-[#1A1A18] mb-1.5 leading-[1.3]">{{ $laporan->judul }}</div>
                <div class="text-[12.5px] text-[#8A8A7A] leading-[1.5] mb-4 line-clamp-2">{{ $laporan->deskripsi }}</div>
                <div class="flex justify-between items-center pt-3.5 border-t border-[#F0EDE8]">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-[#D4621A] to-[#E8A87C] flex items-center justify-center text-[10px] font-bold text-white flex-shrink-0">
                            {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="text-[12px] font-medium text-[#4A4A42]">{{ $laporan->user->name }}</div>
                            <div class="text-[11px] text-[#8A8A7A]">{{ $laporan->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="text-[11px] text-[#8A8A7A]">💬 {{ $laporan->komentars()->count() }}</div>
                </div>
            </a>
            @empty
            <div class="col-span-2 text-center py-12 text-[#8A8A7A]">Belum ada laporan</div>
            @endforelse
        </div>
    </div>

</div>

{{-- FOOTER --}}
<footer class="bg-[#1A1A18] px-[60px] py-8 flex justify-between items-center mt-auto">
    <div class="font-serif-display text-[20px] text-white">Kata<span class="text-[#E8A87C]">Warga</span></div>
    <div class="text-[12px] text-[#555]">© {{ date('Y') }} KataWarga · Platform Aspirasi Warga Indonesia</div>
    <div class="flex gap-5">
        <a href="#cara-kerja"      class="text-[12px] text-[#555] hover:text-[#888] no-underline transition-colors">Cara Kerja</a>
        <a href="#aktivitas-warga" class="text-[12px] text-[#555] hover:text-[#888] no-underline transition-colors">Laporan</a>
        <a href="#" onclick="openTentangPanel(event)" class="text-[12px] text-[#555] hover:text-[#888] no-underline transition-colors">Tentang</a>
    </div>
</footer>

{{-- SLIDE-IN PANEL --}}
<div id="tentangOverlay"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[999] opacity-0 invisible transition-all duration-300"
     onclick="closeTentangPanel()">
</div>

<div id="tentangPanel"
     class="fixed top-0 right-0 bottom-0 z-[1000] translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] shadow-2xl flex flex-col"
     style="width:400px; max-width:100vw; background:#fff;">

    {{-- Hero Header --}}
    <div class="relative overflow-hidden flex-shrink-0" style="background:#1A1A18;">
        <div class="absolute -top-8 -right-8 w-32 h-32 rounded-full pointer-events-none"
            style="background:radial-gradient(circle, rgba(212,98,26,0.18) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-6 -left-6 w-24 h-24 rounded-full pointer-events-none"
            style="background:radial-gradient(circle, rgba(212,98,26,0.10) 0%, transparent 70%);"></div>
        <div class="relative z-10 px-7 pt-7 pb-6">
            <div class="flex justify-between items-start mb-4">
                <div style="font-family:'DM Serif Display',serif; font-size:22px; color:#fff; line-height:1.2;">
                    Kata<span style="color:#E8A87C;">Warga</span>
                </div>
                <button onclick="closeTentangPanel()"
                    class="bg-transparent border-none cursor-pointer p-1 rounded transition-colors"
                    style="color:rgba(255,255,255,0.4);"
                    onmouseover="this.style.color='rgba(255,255,255,0.8)'"
                    onmouseout="this.style.color='rgba(255,255,255,0.4)'">
                    <i data-lucide="x" style="width:18px;height:18px;"></i>
                </button>
            </div>
            <p style="font-size:13px; color:rgba(255,255,255,0.45); line-height:1.6; max-width:280px; margin:0;">
                Platform laporan masalah lingkungan yang menghubungkan warga dengan instansi pemerintah.
            </p>
        </div>
    </div>

    <div class="overflow-y-auto flex-1" style="padding:20px 24px;">

        <div style="margin-bottom:24px;">
            <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#8A8A7A; margin-bottom:10px;">Visi Kami</div>
            <p style="font-size:13px; color:#4A4A42; line-height:1.7; margin:0;">
                Mewujudkan lingkungan yang aman, tertata, dan nyaman melalui partisipasi aktif warga dalam pengawasan fasilitas publik.
            </p>
        </div>

        <div style="border-top:1px solid #F0EDE8; margin-bottom:24px;"></div>

        <div style="margin-bottom:24px;">
            <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#8A8A7A; margin-bottom:14px;">Mengapa KataWarga?</div>
            @foreach([
                ['zap',   'Cepat & Mudah',   'Lapor masalah hanya dalam hitungan menit lewat smartphone atau laptop.'],
                ['eye',   'Transparan',       'Pantau perkembangan laporanmu dari status pending hingga selesai secara real-time.'],
                ['users', 'Partisipatif',     'Diskusikan isu lingkungan bersama warga lain untuk penanganan yang lebih cepat.'],
            ] as [$icon, $title, $desc])
            <div style="display:flex; gap:12px; align-items:flex-start; margin-bottom:16px; padding-bottom:16px; border-bottom:1px solid #F0EDE8;">
                <div style="width:32px; height:32px; border-radius:8px; background:rgba(212,98,26,0.1); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <i data-lucide="{{ $icon }}" style="width:15px; height:15px; color:#D4621A;"></i>
                </div>
                <div>
                    <div style="font-size:13px; font-weight:600; color:#1A1A18; margin-bottom:3px;">{{ $title }}</div>
                    <div style="font-size:12.5px; color:#8A8A7A; line-height:1.6;">{{ $desc }}</div>
                </div>
            </div>
            @endforeach
        </div>

        <div style="margin-bottom:24px;">
            <div style="font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#8A8A7A; margin-bottom:14px;">Kontak Kami</div>
            @foreach([
                ['mail',  'support@katawarga.id'],
                ['phone', '(021) 123-4567'],
            ] as [$icon, $text])
            <div style="display:flex; gap:10px; align-items:center; margin-bottom:10px;">
                <i data-lucide="{{ $icon }}" style="width:14px; height:14px; color:#D4621A; flex-shrink:0;"></i>
                <span style="font-size:13px; color:#4A4A42;">{{ $text }}</span>
            </div>
            @endforeach
        </div>

        <div style="border-top:1px solid #F0EDE8; padding-top:16px; text-align:center;">
            <div style="font-size:11px; color:#8A8A7A;">Versi 1.0.0 &copy; {{ date('Y') }} KataWarga</div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
    
    const stepIds    = ['login','buat','tinjauan','diproses','selesai','ditolak','diskusi'];
    const stepColors = ['#1A1A18','#D4621A','#C9A227','#2A5BA8','#2D7A4F','#C0392B','#D4621A'];
    let   stepCurrent = 0;

    function selectStep(id) {
        stepCurrent = stepIds.indexOf(id);
        updateStepperUI();
    }

    function navigateStep(dir) {
        stepCurrent = Math.max(0, Math.min(stepIds.length - 1, stepCurrent + dir));
        updateStepperUI();
    }

    function updateStepperUI() {
        const id = stepIds[stepCurrent];

        document.querySelectorAll('.alur-detail').forEach(p => p.classList.add('hidden'));
        document.getElementById('step-detail-' + id).classList.remove('hidden');

        document.querySelectorAll('.alur-node').forEach((btn, i) => {
            btn.style.transform  = i === stepCurrent ? 'scale(1.15)' : 'scale(1)';
            btn.style.boxShadow  = i === stepCurrent
                ? '0 0 0 3px ' + stepColors[i] + '33'
                : 'none';
        });

        document.querySelectorAll('[id^="step-label-"]').forEach((lbl, i) => {
            lbl.style.color      = i === stepCurrent ? stepColors[i] : '#8A8A7A';
            lbl.style.fontWeight = i === stepCurrent ? '600' : '400';
        });

        document.getElementById('step-counter').textContent =
            (stepCurrent + 1) + ' / ' + stepIds.length;

        document.getElementById('step-prev').style.visibility =
            stepCurrent === 0 ? 'hidden' : 'visible';
        document.getElementById('step-next').style.visibility =
            stepCurrent === stepIds.length - 1 ? 'hidden' : 'visible';

        lucide.createIcons();
    }

    // init
    updateStepperUI();

    function openTentangPanel(e) {
        if (e) e.preventDefault();
        document.getElementById('tentangOverlay').classList.remove('opacity-0', 'invisible');
        document.getElementById('tentangPanel').classList.remove('translate-x-full');
        document.body.style.overflow = 'hidden';
        {{-- ═══ PERBAIKAN BUG: re-render lucide icons saat panel dibuka ═══ --}}
        lucide.createIcons();
    }

    function closeTentangPanel() {
        document.getElementById('tentangOverlay').classList.add('opacity-0', 'invisible');
        document.getElementById('tentangPanel').classList.add('translate-x-full');
        document.body.style.overflow = '';
    }
</script>

</body>
</html>