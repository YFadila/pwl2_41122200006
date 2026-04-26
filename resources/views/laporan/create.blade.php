<x-sidebar-layout>
    <div style="max-width:680px; margin:0 auto;">

        {{-- Step Indicator --}}
        <div style="margin-bottom:28px;">
            <div style="display:flex; align-items:center; gap:0; margin-bottom:10px;">
                <div id="dot-1" style="width:28px; height:28px; border-radius:50%; background:#D4621A; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#fff; flex-shrink:0; transition:all 0.2s;">1</div>
                <div id="line-1" style="flex:1; height:2px; background:#D4621A; transition:background 0.3s;"></div>
                <div id="dot-2" style="width:28px; height:28px; border-radius:50%; background:#E8E4DC; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#8A8A7A; flex-shrink:0; transition:all 0.2s;">2</div>
                <div id="line-2" style="flex:1; height:2px; background:#E8E4DC; transition:background 0.3s;"></div>
                <div id="dot-3" style="width:28px; height:28px; border-radius:50%; background:#E8E4DC; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:#8A8A7A; flex-shrink:0; transition:all 0.2s;">3</div>
            </div>
            <div style="display:flex; justify-content:space-between; font-size:12px;">
                <span id="lbl-1" style="color:#D4621A; font-weight:500;">Info Dasar</span>
                <span id="lbl-2" style="color:#8A8A7A;">Lokasi &amp; Peta</span>
                <span id="lbl-3" style="color:#8A8A7A;">Foto &amp; Kirim</span>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" id="laporan-form">
            @csrf

            {{-- ===== STEP 1: Info Dasar ===== --}}
            <div id="step-1" class="wizard-step">
                <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:28px 32px;">
                    <h3 class="text-2xl font-bold text-gray-900" style="font-family: 'DM Serif Display', serif;">
                        Buat Laporan
                    </h3>
                    <div style="color:#8A8A7A; font-size:13px; margin-top:4px;; margin-bottom:10px;">Laporkan masalah di lingkungan kamu</div>

                    {{-- Tip kontekstual --}}
                    <div style="background:#FFF8F0; border:1px solid #F5D5B8; border-radius:8px; padding:12px 14px; margin-bottom:22px; display:flex; gap:10px; align-items:flex-start;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0; margin-top:1px;">
                            <circle cx="8" cy="8" r="7" stroke="#D4621A" stroke-width="1.2" fill="none"/>
                            <path d="M8 7v4M8 5v.5" stroke="#D4621A" stroke-width="1.4" stroke-linecap="round"/>
                        </svg>
                        <span style="font-size:12.5px; color:#854F0B; line-height:1.5;">Beri judul yang spesifik dan pilih kategori yang sesuai agar laporan mudah ditangani.</span>
                    </div>

                    <div style="display:grid; gap:18px;">

                        {{-- Judul --}}
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Judul Laporan</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                placeholder="Deskripsikan masalah secara singkat"
                                style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;">
                            @error('judul') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Kategori</label>
                            <select name="kategori" id="kategori" style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none;">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Infrastruktur & Jalan"  @selected(old('kategori') == 'Infrastruktur & Jalan') >Infrastruktur & Jalan</option>
                                <option value="Sampah & Kebersihan"       @selected(old('kategori') == 'Sampah & Kebersihan')      >Sampah & Kebersihan</option>
                                <option value="Air & Drainase"       @selected(old('kategori') == 'Air & Drainase')      >Air & Drainase</option>
                                <option value="Fasilitas Umum"   @selected(old('kategori') == 'Fasilitas Umum')  >Fasilitas Umum</option>
                                <option value="Lainnya"      @selected(old('kategori') == 'Lainnya')     >Lainnya</option>
                            </select>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5"
                                placeholder="Jelaskan masalah secara detail, termasuk dampaknya terhadap warga..."
                                style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; resize:vertical; line-height:1.5; box-sizing:border-box;">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <div style="display:flex; gap:12px; justify-content:flex-end; margin-top:24px; padding-top:20px; border-top:1.5px solid #D8D4CC;">
                        <a href="{{ route('laporan.index') }}"
                            style="padding:11px 22px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:500; text-decoration:none;">
                            Batal
                        </a>
                        <button type="button" onclick="goToStep(2)"
                            style="padding:11px 28px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                            Lanjut →
                        </button>
                    </div>
                </div>
            </div>

            {{-- ===== STEP 2: Lokasi & Peta ===== --}}
            <div id="step-2" class="wizard-step" style="display:none;">
                <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:28px 32px;">

                    {{-- Tip kontekstual --}}
                    <div style="background:#FFF8F0; border:1px solid #F5D5B8; border-radius:8px; padding:12px 14px; margin-bottom:22px; display:flex; gap:10px; align-items:flex-start;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0; margin-top:1px;">
                            <circle cx="8" cy="8" r="7" stroke="#D4621A" stroke-width="1.2" fill="none"/>
                            <path d="M8 7v4M8 5v.5" stroke="#D4621A" stroke-width="1.4" stroke-linecap="round"/>
                        </svg>
                        <span style="font-size:12.5px; color:#854F0B; line-height:1.5;">Ketik alamat untuk mencari lokasi, klik peta, atau gunakan lokasi saat ini.</span>
                    </div>

                    <div style="display:grid; gap:18px;">

                        {{-- Lokasi with autocomplete --}}
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Lokasi</label>
                            <div style="position:relative;">
                                <div style="position:relative;">
                                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" autocomplete="off"
                                        placeholder="Ketik alamat untuk mencari..."
                                        style="width:100%; padding:11px 42px 11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box; transition: border-color 0.2s;">
                                    {{-- Search icon --}}
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); pointer-events:none; opacity:0.4;">
                                        <circle cx="7" cy="7" r="5" stroke="#4A4A42" stroke-width="1.4" fill="none"/>
                                        <path d="M11 11l3 3" stroke="#4A4A42" stroke-width="1.4" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                {{-- Loading indicator --}}
                                <div id="lokasi-loading" style="display:none; position:absolute; right:14px; top:13px;">
                                    <div style="width:14px; height:14px; border:2px solid #E8E4DC; border-top-color:#D4621A; border-radius:50%; animation:spin-lokasi 0.6s linear infinite;"></div>
                                </div>
                                {{-- Autocomplete dropdown --}}
                                <div id="lokasi-suggestions" style="display:none; position:absolute; top:100%; left:0; right:0; z-index:50; background:#fff; border:1.5px solid #D8D4CC; border-top:none; border-radius:0 0 8px 8px; max-height:220px; overflow-y:auto; box-shadow:0 8px 24px rgba(0,0,0,0.1);"></div>
                            </div>
                        </div>

                        {{-- Gunakan Lokasi Saat Ini --}}
                        <div>
                            <button type="button" id="btn-geolocation" onclick="useCurrentLocation()"
                                style="display:inline-flex; align-items:center; gap:8px; padding:10px 18px; background:#F8F6F2; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:500; color:#4A4A42; cursor:pointer; transition:all 0.2s;">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                    <circle cx="8" cy="8" r="3" stroke="#D4621A" stroke-width="1.4" fill="none"/>
                                    <circle cx="8" cy="8" r="1" fill="#D4621A"/>
                                    <path d="M8 1v3M8 12v3M1 8h3M12 8h3" stroke="#D4621A" stroke-width="1.4" stroke-linecap="round"/>
                                </svg>
                                <span id="geoloc-text">Gunakan Lokasi Saat Ini</span>
                            </button>
                        </div>

                        {{-- Peta --}}
                        <div>
                            <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Tandai Lokasi di Peta</label>
                            <div id="map" style="height:280px; border-radius:8px; border:1.5px solid #D8D4CC;"></div>
                            <p style="font-size:12px; color:#8A8A7A; margin-top:6px;">Klik pada peta untuk menandai lokasi kejadian</p>
                        </div>

                        {{-- Koordinat --}}
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                            <div>
                                <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Latitude</label>
                                <input type="text" name="latitude" id="latitude" readonly placeholder="Otomatis dari peta"
                                    style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#F8F6F2; color:#8A8A7A; outline:none; box-sizing:border-box;">
                            </div>
                            <div>
                                <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Longitude</label>
                                <input type="text" name="longitude" id="longitude" readonly placeholder="Otomatis dari peta"
                                    style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#F8F6F2; color:#8A8A7A; outline:none; box-sizing:border-box;">
                            </div>
                        </div>

                    </div>

                    <div style="display:flex; gap:12px; justify-content:flex-end; margin-top:24px; padding-top:20px; border-top:1.5px solid #D8D4CC;">
                        <button type="button" onclick="goToStep(1)"
                            style="padding:11px 22px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:500; cursor:pointer;">
                            ← Kembali
                        </button>
                        <button type="button" onclick="goToStep(3)"
                            style="padding:11px 28px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                            Lanjut →
                        </button>
                    </div>
                </div>
            </div>

            {{-- ===== STEP 3: Foto & Kirim ===== --}}
            <div id="step-3" class="wizard-step" style="display:none;">
                <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:28px 32px;">

                    {{-- Tip kontekstual --}}
                    <div style="background:#FFF8F0; border:1px solid #F5D5B8; border-radius:8px; padding:12px 14px; margin-bottom:22px; display:flex; gap:10px; align-items:flex-start;">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" style="flex-shrink:0; margin-top:1px;">
                            <circle cx="8" cy="8" r="7" stroke="#D4621A" stroke-width="1.2" fill="none"/>
                            <path d="M8 7v4M8 5v.5" stroke="#D4621A" stroke-width="1.4" stroke-linecap="round"/>
                        </svg>
                        <span style="font-size:12.5px; color:#854F0B; line-height:1.5;">Foto pendukung membantu petugas memahami kondisi di lapangan. Format JPG/PNG, maksimal 2MB.</span>
                    </div>

                    {{-- Upload Foto --}}
                    <div style="margin-bottom:24px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Foto Pendukung <span style="color:#8A8A7A; font-weight:400; text-transform:none; letter-spacing:0;">(opsional)</span></label>

                        <label id="upload-label" style="display:block; border:2px dashed #D8D4CC; border-radius:10px; padding:30px; text-align:center; cursor:pointer; transition:border-color 0.2s;"
                            onmouseover="this.style.borderColor='#E8A87C'" onmouseout="this.style.borderColor='#D8D4CC'">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" style="margin:0 auto 10px; display:block; opacity:0.35;">
                                <rect x="3" y="5" width="26" height="22" rx="3" stroke="#4A4A42" stroke-width="1.5" fill="none"/>
                                <circle cx="11" cy="13" r="3" stroke="#4A4A42" stroke-width="1.5" fill="none"/>
                                <path d="M3 22 L10 15 L17 22 L22 17 L29 22" stroke="#4A4A42" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <div id="upload-text" style="font-size:13px; color:#8A8A7A;">Klik untuk upload foto atau <span style="color:#D4621A; font-weight:600;">pilih file</span></div>
                            <div style="font-size:11px; color:#8A8A7A; margin-top:4px;">JPG, PNG maksimal 2MB</div>
                            <input type="file" name="foto" id="foto-input" accept="image/*" style="display:none;" onchange="previewFoto(this)">
                        </label>

                        {{-- Preview foto --}}
                        <div id="foto-preview" style="display:none; margin-top:12px; position:relative; display:none;">
                            <img id="preview-img" style="width:100%; max-height:200px; object-fit:cover; border-radius:8px; border:1.5px solid #D8D4CC;">
                            <button type="button" onclick="hapusFoto()"
                                style="position:absolute; top:8px; right:8px; background:rgba(26,26,24,0.6); color:#fff; border:none; border-radius:6px; padding:4px 10px; font-size:12px; cursor:pointer; font-family:'DM Sans',sans-serif;">
                                Hapus
                            </button>
                        </div>
                    </div>

                    {{-- Ringkasan laporan --}}
                    <div style="background:#F8F6F2; border-radius:10px; border:1.5px solid #D8D4CC; padding:16px 18px; margin-bottom:24px;">
                        <div style="font-size:12px; font-weight:600; color:#4A4A42; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:12px;">Ringkasan Laporan</div>
                        <div style="display:flex; justify-content:space-between; margin-bottom:8px; font-size:13px;">
                            <span style="color:#8A8A7A;">Judul</span>
                            <span id="summary-judul" style="color:#1A1A18; font-weight:500; text-align:right; max-width:60%;">—</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; margin-bottom:8px; font-size:13px;">
                            <span style="color:#8A8A7A;">Kategori</span>
                            <span id="summary-kategori" style="color:#1A1A18; font-weight:500;">—</span>
                        </div>
                        <div style="display:flex; justify-content:space-between; font-size:13px;">
                            <span style="color:#8A8A7A;">Lokasi</span>
                            <span id="summary-lokasi" style="color:#1A1A18; font-weight:500; text-align:right; max-width:60%;">—</span>
                        </div>
                    </div>

                    {{-- Info status awal --}}
                    <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px; padding:10px 14px; background:#fff; border:1px solid #D8D4CC; border-radius:8px; font-size:12.5px; color:#8A8A7A;">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" style="flex-shrink:0;">
                            <circle cx="7" cy="7" r="6" stroke="#8A8A7A" stroke-width="1.2" fill="none"/>
                            <path d="M7 6v4M7 4.5v.5" stroke="#8A8A7A" stroke-width="1.2" stroke-linecap="round"/>
                        </svg>
                        Setelah dikirim, laporan akan berstatus
                        <span style="background:#FEF3CD; color:#92740E; padding:2px 8px; border-radius:12px; font-size:11px; font-weight:600;">Pending</span>
                    </div>

                    <div style="display:flex; gap:12px; justify-content:flex-end; padding-top:20px; border-top:1.5px solid #D8D4CC;">
                        <button type="button" onclick="goToStep(2)"
                            style="padding:11px 22px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:500; cursor:pointer;">
                            ← Kembali
                        </button>
                        <button type="submit"
                            style="padding:11px 28px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                            Kirim Laporan
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    {{-- Leaflet Map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        @keyframes spin-lokasi { to { transform: rotate(360deg); } }
        .lokasi-item { padding:10px 14px; font-size:13px; color:#4A4A42; cursor:pointer; border-bottom:1px solid #F0EDE8; display:flex; align-items:flex-start; gap:10px; font-family:'DM Sans',sans-serif; transition: background 0.1s; }
        .lokasi-item:last-child { border-bottom:none; }
        .lokasi-item:hover { background:#FFF8F0; }
        .lokasi-item svg { flex-shrink:0; margin-top:2px; }
        #btn-geolocation:hover { background:#FFF8F0; border-color:#D4621A; color:#D4621A; }
    </style>
    <script>
        var mapInitialized = false;
        var leafletMap, marker;
        var searchTimeout = null;

        function initMap() {
            if (mapInitialized) return;
            mapInitialized = true;
            leafletMap = L.map('map').setView([-6.2, 106.8], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(leafletMap);
            leafletMap.on('click', function(e) {
                setMapLocation(e.latlng.lat, e.latlng.lng, true);
            });
        }

        /* ── Set map marker, coords, and optionally reverse-geocode ── */
        function setMapLocation(lat, lng, doReverse) {
            lat = parseFloat(lat);
            lng = parseFloat(lng);
            document.getElementById('latitude').value  = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);

            if (leafletMap) {
                if (marker) { marker.setLatLng([lat, lng]); }
                else { marker = L.marker([lat, lng]).addTo(leafletMap); }
                leafletMap.setView([lat, lng], 16);
            }

            if (doReverse) {
                fetch('https://nominatim.openstreetmap.org/reverse?lat=' + lat + '&lon=' + lng + '&format=json&accept-language=id')
                    .then(function(r) { return r.json(); })
                    .then(function(data) {
                        if (data.display_name) {
                            document.getElementById('lokasi').value = data.display_name;
                            updateSummary();
                        }
                    });
            }
            updateSummary();
        }

        /* ── Autocomplete: search Nominatim on typing ── */
        (function() {
            var input = document.getElementById('lokasi');
            var dropdown = document.getElementById('lokasi-suggestions');
            var loading = document.getElementById('lokasi-loading');

            input.addEventListener('input', function() {
                var q = this.value.trim();
                clearTimeout(searchTimeout);
                if (q.length < 3) { dropdown.style.display = 'none'; return; }

                searchTimeout = setTimeout(function() {
                    loading.style.display = 'block';
                    fetch('https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(q) + '&format=json&limit=5&countrycodes=id&accept-language=id')
                        .then(function(r) { return r.json(); })
                        .then(function(results) {
                            loading.style.display = 'none';
                            if (!results.length) {
                                dropdown.innerHTML = '<div style="padding:14px; font-size:13px; color:#8A8A7A; text-align:center;">Tidak ditemukan</div>';
                                dropdown.style.display = 'block';
                                return;
                            }
                            dropdown.innerHTML = results.map(function(r) {
                                return '<div class="lokasi-item" data-lat="' + r.lat + '" data-lng="' + r.lon + '" data-name="' + escAttr(r.display_name) + '">'
                                    + '<svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1a4 4 0 0 1 4 4c0 3.5-4 8-4 8S3 8.5 3 5a4 4 0 0 1 4-4z" stroke="#D4621A" stroke-width="1.2" fill="none"/><circle cx="7" cy="5" r="1.2" fill="#D4621A"/></svg>'
                                    + '<span>' + escHtml(r.display_name) + '</span></div>';
                            }).join('');
                            dropdown.style.display = 'block';
                        })
                        .catch(function() { loading.style.display = 'none'; });
                }, 400);
            });

            dropdown.addEventListener('click', function(e) {
                var item = e.target.closest('.lokasi-item');
                if (!item) return;
                input.value = item.getAttribute('data-name');
                dropdown.style.display = 'none';
                setMapLocation(item.getAttribute('data-lat'), item.getAttribute('data-lng'), false);
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('#lokasi') && !e.target.closest('#lokasi-suggestions')) {
                    dropdown.style.display = 'none';
                }
            });
        })();

        /* ── Geolocation: use current location ── */
        function useCurrentLocation() {
            var btn = document.getElementById('btn-geolocation');
            var txt = document.getElementById('geoloc-text');

            if (!navigator.geolocation) {
                alert('Browser tidak mendukung geolokasi.');
                return;
            }

            btn.disabled = true;
            txt.textContent = 'Mencari lokasi...';

            navigator.geolocation.getCurrentPosition(
                function(pos) {
                    var lat = pos.coords.latitude;
                    var lng = pos.coords.longitude;

                    if (!mapInitialized) {
                        initMap();
                        setTimeout(function() {
                            if (leafletMap) leafletMap.invalidateSize();
                            setMapLocation(lat, lng, true);
                        }, 150);
                    } else {
                        setMapLocation(lat, lng, true);
                    }

                    btn.disabled = false;
                    txt.textContent = 'Gunakan Lokasi Saat Ini';
                },
                function(err) {
                    btn.disabled = false;
                    txt.textContent = 'Gunakan Lokasi Saat Ini';
                    if (err.code === 1) alert('Izin lokasi ditolak. Aktifkan izin lokasi di browser.');
                    else alert('Gagal mendapatkan lokasi: ' + err.message);
                },
                { enableHighAccuracy: true, timeout: 10000 }
            );
        }

        /* ── Helpers ── */
        function escHtml(s) { var d = document.createElement('div'); d.textContent = s; return d.innerHTML; }
        function escAttr(s) { return s.replace(/"/g, '&quot;').replace(/'/g, '&#39;'); }

        function goToStep(step) {
            if (step === 2) {
                var judul = document.getElementById('judul').value.trim();
                var kategori = document.getElementById('kategori').value;
                var deskripsi = document.getElementById('deskripsi').value.trim();
                if (!judul || !kategori || !deskripsi) {
                    alert('Harap lengkapi judul, kategori, dan deskripsi terlebih dahulu.');
                    return;
                }
            }

            document.querySelectorAll('.wizard-step').forEach(function(el) { el.style.display = 'none'; });
            document.getElementById('step-' + step).style.display = 'block';

            updateStepIndicator(step);

            if (step === 2) {
                setTimeout(function() {
                    initMap();
                    if (leafletMap) leafletMap.invalidateSize();
                }, 100);
            }

            if (step === 3) {
                updateSummary();
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateStepIndicator(current) {
            for (var i = 1; i <= 3; i++) {
                var dot  = document.getElementById('dot-' + i);
                var lbl  = document.getElementById('lbl-' + i);
                if (i < current) {
                    dot.style.background = '#D4621A';
                    dot.style.color = '#fff';
                    dot.innerHTML = '✓';
                } else if (i === current) {
                    dot.style.background = '#D4621A';
                    dot.style.color = '#fff';
                    dot.innerHTML = i;
                } else {
                    dot.style.background = '#E8E4DC';
                    dot.style.color = '#8A8A7A';
                    dot.innerHTML = i;
                }
                lbl.style.color = (i === current) ? '#D4621A' : '#8A8A7A';
                lbl.style.fontWeight = (i === current) ? '500' : '400';
            }
            var line1 = document.getElementById('line-1');
            var line2 = document.getElementById('line-2');
            if (line1) line1.style.background = current >= 2 ? '#D4621A' : '#E8E4DC';
            if (line2) line2.style.background = current >= 3 ? '#D4621A' : '#E8E4DC';
        }

        function updateSummary() {
            var judul    = document.getElementById('judul').value    || '—';
            var kategori = document.getElementById('kategori').value || '—';
            var lokasi   = document.getElementById('lokasi').value   || '—';
            document.getElementById('summary-judul').textContent    = judul;
            document.getElementById('summary-kategori').textContent = kategori;
            document.getElementById('summary-lokasi').textContent   = lokasi.length > 60 ? lokasi.substring(0, 60) + '...' : lokasi;
        }

        function previewFoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('foto-preview').style.display = 'block';
                    document.getElementById('upload-text').textContent = input.files[0].name;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function hapusFoto() {
            document.getElementById('foto-input').value = '';
            document.getElementById('foto-preview').style.display = 'none';
            document.getElementById('upload-text').innerHTML = 'Klik untuk upload foto atau <span style="color:#D4621A; font-weight:600;">pilih file</span>';
        }

        @if($errors->any())
            goToStep(1);
        @endif
    </script>

</x-sidebar-layout>