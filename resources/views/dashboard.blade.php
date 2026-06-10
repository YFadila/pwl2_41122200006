<x-sidebar-layout>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <x-slot name="header">
        <div style="font-family:'DM Serif Display',serif; font-size:26px; color:#1A1A18; line-height:1.2;">Dashboard</div>
        <div style="color:#8A8A7A; font-size:13px; margin-top:4px;">Selamat datang kembali, {{ auth()->user()->name }} 👋</div>
    </x-slot>

    {{-- STATISTIK --}}
    <div style="margin-bottom:32px;">
        <div style="font-family:'DM Serif Display',serif; font-size:18px; color:#1A1A18; margin-bottom:16px;">
            Ringkasan Laporan
        </div>

        @php
            $stats = auth()->user()->isAdmin()
                ? [
                    ['label' => 'Total Laporan', 'value' => $total,    'sub' => 'Semua laporan masuk', 'icon' => 'clipboard-list',  'color' => '#1A1A18', 'bg' => '#F5F4F0', 'url' => route('laporan.index')],
                    ['label' => 'Pending',        'value' => $pending,  'sub' => 'Menunggu tindakan',   'icon' => 'clock',           'color' => '#C9A227', 'bg' => '#FDF8EC', 'url' => route('laporan.index', ['status' => 'pending'])],
                    ['label' => 'Diproses',       'value' => $diproses, 'sub' => 'Sedang ditangani',    'icon' => 'loader-circle',   'color' => '#2A5BA8', 'bg' => '#EEF3FC', 'url' => route('laporan.index', ['status' => 'diproses'])],
                    ['label' => 'Selesai',        'value' => $selesai,  'sub' => 'Laporan dituntaskan', 'icon' => 'circle-check-big','color' => '#2D7A4F', 'bg' => '#EDF7F2', 'url' => route('laporan.index', ['status' => 'selesai'])],
                ]
                : [
                    ['label' => 'Total Laporan', 'value' => $myTotal,    'sub' => 'Semua laporan saya',  'icon' => 'clipboard-list',  'color' => '#1A1A18', 'bg' => '#F5F4F0', 'url' => route('laporan.index', ['milik_saya' => true])],
                    ['label' => 'Pending',        'value' => $myPending,  'sub' => 'Menunggu tindakan',   'icon' => 'clock',           'color' => '#C9A227', 'bg' => '#FDF8EC', 'url' => route('laporan.index', ['status' => 'pending'])],
                    ['label' => 'Diproses',       'value' => $myDiproses, 'sub' => 'Sedang ditangani',    'icon' => 'loader-circle',   'color' => '#2A5BA8', 'bg' => '#EEF3FC', 'url' => route('laporan.index', ['status' => 'diproses'])],
                    ['label' => 'Selesai',        'value' => $mySelesai,  'sub' => 'Laporan dituntaskan', 'icon' => 'circle-check-big','color' => '#2D7A4F', 'bg' => '#EDF7F2', 'url' => route('laporan.index', ['status' => 'selesai'])],
                ];
        @endphp

        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:16px;">
            @foreach($stats as $stat)
            <a href="{{ $stat['url'] }}" style="text-decoration:none; display:block;" title="Lihat {{ $stat['label'] }}">
                <div style="background:#fff; border-radius:12px; padding:20px 22px; border:1.5px solid #D8D4CC; display:flex; align-items:center; gap:16px; transition:transform 0.2s, box-shadow 0.2s; cursor:pointer;"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 20px rgba(0,0,0,0.07)'"
                    onmouseout="this.style.transform='';this.style.boxShadow=''">

                    <div style="width:44px; height:44px; border-radius:10px; background:{{ $stat['bg'] }}; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <i data-lucide="{{ $stat['icon'] }}" style="width:20px; height:20px; color:{{ $stat['color'] }};"></i>
                    </div>

                    <div style="text-align:center; flex:1;">
                        <div style="font-size:11px; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:#8A8A7A; margin-bottom:6px;">{{ $stat['label'] }}</div>
                        <div style="font-family:'DM Serif Display',serif; font-size:34px; line-height:1; color:{{ $stat['color'] }}; margin-bottom:4px;">{{ $stat['value'] }}</div>
                        <div style="font-size:11px; color:#8A8A7A;">{{ $stat['sub'] }}</div>
                    </div>

                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- GRAFIK FREKUENSI LAPORAN (Admin Only) --}}
    @if(auth()->user()->isAdmin())
    <div style="margin-bottom:32px;">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
            <div style="font-family:'DM Serif Display',serif; font-size:18px; color:#1A1A18;">
                Frekuensi Laporan
            </div>
            <div id="chartTabs" style="display:flex; gap:4px; background:#F5F4F0; border-radius:8px; padding:3px;">
                <button onclick="switchChart('bulanan')" data-tab="bulanan"
                    style="padding:6px 16px; border-radius:6px; border:none; font-size:12px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all 0.2s; background:#fff; color:#1A1A18; box-shadow:0 1px 3px rgba(0,0,0,0.08);">
                    Bulanan
                </button>
                <button onclick="switchChart('mingguan')" data-tab="mingguan"
                    style="padding:6px 16px; border-radius:6px; border:none; font-size:12px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all 0.2s; background:transparent; color:#8A8A7A;">
                    Mingguan
                </button>
                <button onclick="switchChart('harian')" data-tab="harian"
                    style="padding:6px 16px; border-radius:6px; border:none; font-size:12px; font-weight:600; font-family:'DM Sans',sans-serif; cursor:pointer; transition:all 0.2s; background:transparent; color:#8A8A7A;">
                    Harian
                </button>
            </div>
        </div>

        <div style="background:#fff; border-radius:12px; border:1.5px solid #D8D4CC; padding:24px 20px 16px 20px; position:relative; overflow:hidden;">
            {{-- Decorative subtle pattern --}}
            <div style="position:absolute; top:0; right:0; width:200px; height:200px; background:radial-gradient(circle at top right, rgba(212,98,26,0.03) 0%, transparent 70%); pointer-events:none;"></div>

            <canvas id="laporanChart" height="100"></canvas>
        </div>
    </div>

    {{-- DAFTAR LAPORAN --}}
    <section>

    @php
        $isAdmin       = auth()->user()->isAdmin();
        $daftarLaporan = $isAdmin ? $terbaru : $myLaporan;

        $statusConfig = fn($status) => match($status) {
            'pending'  => ['badge' => 'bg-amber-50 text-amber-700',    'bar' => 'bg-amber-400',    'dot' => 'bg-amber-400'],
            'diproses' => ['badge' => 'bg-blue-50 text-blue-700',      'bar' => 'bg-blue-500',     'dot' => 'bg-blue-500'],
            default    => ['badge' => 'bg-emerald-50 text-emerald-700', 'bar' => 'bg-emerald-500',  'dot' => 'bg-emerald-500'],
        };
    @endphp

    @if($isAdmin)
        {{-- ADMIN --}}
        <div style="background:#fff; border-radius:12px; border:1.5px solid #D8D4CC; overflow:hidden;">
            <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 18px; border-bottom:1.5px solid #D8D4CC;">
                <div style="font-family:'DM Serif Display',serif; font-size:15px; color:#1A1A18;">Semua Laporan Terbaru</div>
                <a href="{{ route('laporan.index') }}"
                    style="font-size:12px; color:#D4621A; text-decoration:none; font-family:'DM Sans',sans-serif;">
                    Lihat semua →
                </a>
            </div>

            @if($terbaru->isEmpty())
                <div style="padding:32px; text-align:center; color:#8A8A7A; font-size:13px;">Belum ada laporan masuk</div>
            @else
                @foreach($terbaru as $laporan)
                @php
                    $sc = $statusConfig($laporan->status);
                    $lokasiPendek = implode(', ', array_slice(explode(', ', $laporan->lokasi), 0, 3));
                @endphp
                <div style="display:flex; overflow:hidden; border-bottom:1px solid #F5F2ED; cursor:pointer; transition:background 0.15s;"
                    onclick="window.location='{{ route('laporan.show', $laporan) }}'"
                    onmouseover="this.style.background='#FAFAF8'" onmouseout="this.style.background=''">
                    
                    <div style="flex:1; padding:14px 18px; min-width:0;">
                        <div style="display:flex; align-items:center; gap:6px; margin-bottom:5px; flex-wrap:wrap;">
                            <span style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; color:#D4621A;">{{ $laporan->kategori }}</span>
                            <span style="color:#D8D4CC; font-size:10px;">·</span>
                            <span style="font-size:11px; color:#8A8A7A;">{{ $laporan->created_at->format('d M Y') }}</span>
                        </div>
                        <div style="font-size:15px; color:#1A1A18; font-family:'DM Serif Display',serif; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:5px;">
                            {{ $laporan->judul }}
                        </div>
                        <div style="display:flex; align-items:center; gap:4px; font-size:11px; color:#8A8A7A; overflow:hidden;">
                            <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $lokasiPendek }}</span>
                        </div>
                    </div>

                    <div style="padding:14px 18px; display:flex; flex-direction:column; align-items:flex-end; justify-content:space-between; flex-shrink:0; gap:8px;">
                        <span class="{{ $sc['badge'] }}" style="font-size:10px; font-weight:600; padding:3px 10px; border-radius:20px; display:inline-flex; align-items:center; gap:4px; white-space:nowrap;">
                            <span class="{{ $sc['dot'] }}" style="width:5px; height:5px; border-radius:50%; display:inline-block;"></span>
                            {{ ucfirst($laporan->status) }}
                        </span>
                        <div style="display:flex; align-items:center; gap:4px; font-size:11px; color:#8A8A7A;">
                            <div style="width:20px; height:20px; border-radius:50%; background:#D4621A; display:flex; align-items:center; justify-content:center; font-size:7px; font-weight:700; color:#fff;">
                                {{ strtoupper(substr($laporan->user->name, 0, 2)) }}
                            </div>
                            <span style="max-width:60px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $laporan->user->name }}</span>
                            <span style="color:#D8D4CC;">·</span>
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            <span style="font-weight:600; color:#4A4A42;">{{ $laporan->komentars->count() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

    @else
        {{-- WARGA --}}
        <div style="background:#fff; border-radius:12px; border:1.5px solid #D8D4CC; overflow:hidden;">

            {{-- Header --}}
            <div style="display:flex; justify-content:space-between; align-items:center; padding:14px 18px; border-bottom:1.5px solid #D8D4CC;">
                <div style="font-family:'DM Serif Display',serif; font-size:15px; color:#1A1A18;">Laporan Saya</div>
                <div style="display:flex; gap:8px;">
                    <a href="{{ route('laporan.create') }}"
                        style="padding:6px 14px; background:#D4621A; color:#fff; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; font-family:'DM Sans',sans-serif;">
                        + Buat Laporan
                    </a>
                    <a href="{{ route('laporan.index') }}"
                        style="padding:6px 14px; border:1.5px solid #D4621A; color:#D4621A; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; font-family:'DM Sans',sans-serif;">
                        Lihat Semua →
                    </a>
                </div>
            </div>

            {{-- List --}}
            @if($myLaporan->isEmpty())
                <div style="padding:48px 24px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:12px; opacity:0.25;">📋</div>
                    <div style="font-size:14px; color:#4A4A42; font-weight:500; margin-bottom:6px;">Belum ada laporan</div>
                    <div style="font-size:13px; color:#8A8A7A; margin-bottom:20px;">Laporkan masalah di lingkungan kamu</div>
                    <a href="{{ route('laporan.create') }}"
                        style="display:inline-block; padding:10px 24px; background:#D4621A; color:#fff; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; font-family:'DM Sans',sans-serif;">
                        Buat Laporan Pertama
                    </a>
                </div>
            @else
                @foreach($myLaporan as $laporan)
                @php
                    $sc = $statusConfig($laporan->status);
                    $lokasiPendek = implode(', ', array_slice(explode(', ', $laporan->lokasi), 0, 3));
                @endphp
                <div style="display:flex; overflow:hidden; border-bottom:1px solid #F5F2ED; cursor:pointer; transition:background 0.15s;"
                    onclick="window.location='{{ route('laporan.show', $laporan) }}'"
                    onmouseover="this.style.background='#FAFAF8'" onmouseout="this.style.background=''">
                    <div style="flex:1; padding:14px 18px; min-width:0;">
                        <div style="display:flex; align-items:center; gap:6px; margin-bottom:5px; flex-wrap:wrap;">
                            <span style="font-size:10px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px; color:#D4621A;">{{ $laporan->kategori }}</span>
                            <span style="color:#D8D4CC;">·</span>
                            <span style="font-size:11px; color:#8A8A7A;">{{ $laporan->created_at->format('d M Y') }}</span>
                        </div>
                        <div style="font-size:15px; color:#1A1A18; font-family:'DM Serif Display',serif; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; margin-bottom:5px;">
                            {{ $laporan->judul }}
                        </div>
                        <div style="display:flex; align-items:center; gap:4px; font-size:11px; color:#8A8A7A; overflow:hidden;">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $lokasiPendek }}</span>
                        </div>
                    </div>
                    <div style="padding:14px 18px; display:flex; flex-direction:column; align-items:flex-end; justify-content:space-between; flex-shrink:0; gap:8px;">
                        <span class="{{ $sc['badge'] }}" style="font-size:10px; font-weight:600; padding:3px 10px; border-radius:20px; display:inline-flex; align-items:center; gap:4px; white-space:nowrap;">
                            <span class="{{ $sc['dot'] }}" style="width:5px; height:5px; border-radius:50%; display:inline-block;"></span>
                            {{ ucfirst($laporan->status) }}
                        </span>
                        <div style="display:flex; align-items:center; gap:4px; font-size:11px; color:#8A8A7A;">
                            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            <span style="font-weight:600; color:#4A4A42;">{{ $laporan->komentars->count() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif

        </div>
    @endif

    </section>

</x-sidebar-layout>
<script>lucide.createIcons();</script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
    (function() {
        const chartData = {
            bulanan:  {!! json_encode($chartBulanan) !!},
            mingguan: {!! json_encode($chartMingguan) !!},
            harian:   {!! json_encode($chartHarian) !!}
        };

        const ctx = document.getElementById('laporanChart').getContext('2d');

        const gradient = ctx.createLinearGradient(0, 0, 0, ctx.canvas.clientHeight || 300);
        gradient.addColorStop(0, 'rgba(212, 98, 26, 0.15)');
        gradient.addColorStop(0.6, 'rgba(212, 98, 26, 0.04)');
        gradient.addColorStop(1, 'rgba(212, 98, 26, 0)');

        let chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.bulanan.labels || [],
                datasets: [{
                    label: 'Jumlah Laporan',
                    data: chartData.bulanan.data || [],
                    borderColor: '#D4621A',
                    backgroundColor: gradient,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#D4621A',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 7,
                    pointHoverBackgroundColor: '#D4621A',
                    pointHoverBorderColor: '#fff',
                    pointHoverBorderWidth: 2.5,
                    tension: 0.35,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1A1A18',
                        titleFont: { family: "'DM Sans', sans-serif", size: 12, weight: '600' },
                        bodyFont: { family: "'DM Sans', sans-serif", size: 13 },
                        titleColor: '#fff',
                        bodyColor: '#E8E6E0',
                        padding: { top: 10, bottom: 10, left: 14, right: 14 },
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            title: function(items) { return items[0].label; },
                            label: function(item) { return item.raw + ' laporan'; }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                        border: { display: false },
                        ticks: {
                            font: { family: "'DM Sans', sans-serif", size: 11 },
                            color: '#8A8A7A',
                            maxRotation: 45,
                            autoSkip: true,
                            maxTicksLimit: 12,
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(216, 212, 204, 0.5)',
                            drawTicks: false,
                        },
                        border: { display: false, dash: [4, 4] },
                        ticks: {
                            font: { family: "'DM Sans', sans-serif", size: 11 },
                            color: '#8A8A7A',
                            padding: 8,
                            stepSize: 1,
                            callback: function(value) {
                                return Number.isInteger(value) ? value : '';
                            }
                        }
                    }
                },
                animation: {
                    duration: 700,
                    easing: 'easeOutQuart'
                }
            }
        });

        window.switchChart = function(type) {
            const d = chartData[type];
            if (!d) return;

            chart.data.labels = d.labels;
            chart.data.datasets[0].data = d.data;
            chart.update('active');

            document.querySelectorAll('#chartTabs button').forEach(btn => {
                if (btn.dataset.tab === type) {
                    btn.style.background = '#fff';
                    btn.style.color = '#1A1A18';
                    btn.style.boxShadow = '0 1px 3px rgba(0,0,0,0.08)';
                } else {
                    btn.style.background = 'transparent';
                    btn.style.color = '#8A8A7A';
                    btn.style.boxShadow = 'none';
                }
            });
        };
    })();
    </script>
    @endif
