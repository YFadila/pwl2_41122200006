<x-sidebar-layout>
    <x-slot name="header">
        <div style="font-family:'DM Serif Display',serif; font-size:26px; color:#1A1A18;">Buat Laporan</div>
        <div style="color:#8A8A7A; font-size:13px; margin-top:4px;">Laporkan masalah di lingkungan kamu</div>
    </x-slot>

    <div style="display:grid; grid-template-columns:1fr 340px; gap:24px; align-items:start;">

        {{-- Form Utama --}}
        <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:28px 32px;">
            <div style="font-family:'DM Serif Display',serif; font-size:20px; color:#1A1A18; margin-bottom:24px; padding-bottom:16px; border-bottom:1.5px solid #D8D4CC;">
                Detail Laporan
            </div>

            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

                    {{-- Judul --}}
                    <div style="grid-column:1/-1; margin-bottom:4px;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Judul Laporan</label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                            placeholder="Deskripsikan masalah secara singkat"
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;">
                        @error('judul') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Kategori</label>
                        <select name="kategori" required style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none;">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Jalan Rusak" @selected(old('kategori') == 'Jalan Rusak')>Jalan Rusak</option>
                            <option value="Sampah" @selected(old('kategori') == 'Sampah')>Sampah</option>
                            <option value="Banjir" @selected(old('kategori') == 'Banjir')>Banjir</option>
                            <option value="Penerangan" @selected(old('kategori') == 'Penerangan')>Penerangan</option>
                            <option value="Lainnya" @selected(old('kategori') == 'Lainnya')>Lainnya</option>
                        </select>
                    </div>

                    {{-- Lokasi --}}
                    <div>
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required
                            placeholder="Alamat lengkap lokasi"
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; box-sizing:border-box;">
                    </div>

                    {{-- Deskripsi --}}
                    <div style="grid-column:1/-1;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Deskripsi</label>
                        <textarea name="deskripsi" required rows="5"
                            placeholder="Jelaskan masalah secara detail, termasuk dampaknya terhadap warga..."
                            style="width:100%; padding:11px 14px; border:1.5px solid #D8D4CC; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:14px; background:#fff; color:#1A1A18; outline:none; resize:vertical; line-height:1.5; box-sizing:border-box;">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</p> @enderror
                    </div>

                    {{-- Peta --}}
                    <div style="grid-column:1/-1;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Tandai Lokasi di Peta</label>
                        <div id="map" style="height:280px; border-radius:8px; border:1.5px solid #D8D4CC;"></div>
                        <p style="font-size:12px; color:#8A8A7A; margin-top:6px;">Klik pada peta untuk menandai lokasi kejadian</p>
                    </div>

                    {{-- Koordinat --}}
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

                    {{-- Upload Foto --}}
                    <div style="grid-column:1/-1;">
                        <label style="display:block; font-size:12px; font-weight:600; color:#4A4A42; margin-bottom:6px; letter-spacing:0.5px; text-transform:uppercase;">Foto Pendukung</label>
                        <label style="display:block; border:2px dashed #D8D4CC; border-radius:10px; padding:30px; text-align:center; cursor:pointer; transition:border-color 0.2s;"
                            onmouseover="this.style.borderColor='#E8A87C'" onmouseout="this.style.borderColor='#D8D4CC'">
                            <div style="font-size:28px; margin-bottom:8px; opacity:0.4;">📷</div>
                            <div style="font-size:13px; color:#8A8A7A;">Klik untuk upload foto atau <span style="color:#D4621A; font-weight:600;">pilih file</span></div>
                            <div style="font-size:11px; color:#8A8A7A; margin-top:4px;">JPG, PNG maksimal 2MB</div>
                            <input type="file" name="foto" accept="image/*" style="display:none;">
                        </label>
                    </div>

                </div>

                {{-- Actions --}}
                <div style="display:flex; gap:12px; justify-content:flex-end; margin-top:24px; padding-top:20px; border-top:1.5px solid #D8D4CC;">
                    <a href="{{ route('laporan.index') }}"
                        style="padding:11px 22px; border:1.5px solid #D8D4CC; background:transparent; color:#4A4A42; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:500; text-decoration:none;">
                        Batal
                    </a>
                    <button type="submit"
                        style="padding:11px 28px; background:#D4621A; color:#fff; border:none; border-radius:8px; font-family:'DM Sans',sans-serif; font-size:13px; font-weight:600; cursor:pointer;">
                        Kirim Laporan
                    </button>
                </div>
            </form>
        </div>

        {{-- Sidebar Tips --}}
        <div>
            <div style="background:#fff; border-radius:14px; border:1.5px solid #D8D4CC; padding:22px 24px; margin-bottom:16px;">
                <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#D4621A; margin-bottom:14px;">💡 Tips Laporan yang Baik</div>
                @foreach(['Beri judul yang spesifik dan mudah dipahami', 'Sertakan alamat lengkap agar mudah ditemukan', 'Jelaskan dampak masalah terhadap warga', 'Upload foto sebagai bukti pendukung'] as $i => $tip)
                <div style="display:flex; gap:10px; margin-bottom:12px; font-size:12.5px; color:#8A8A7A; line-height:1.5;">
                    <div style="width:20px; height:20px; border-radius:50%; background:rgba(212,98,26,0.1); color:#D4621A; font-size:11px; font-weight:700; display:flex; align-items:center; justify-content:center; flex-shrink:0;">{{ $i+1 }}</div>
                    <span>{{ $tip }}</span>
                </div>
                @endforeach
            </div>

            <div style="background:#FFF8F0; border-radius:14px; border:1.5px solid #F5D5B8; padding:22px 24px;">
                <div style="font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:0.8px; color:#D4621A; margin-bottom:14px;">📋 Status Laporan</div>
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
                    <span style="background:#FEF3CD; color:#92740E; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600;">Pending</span>
                    <span style="font-size:12px; color:#8A8A7A;">Laporan baru masuk</span>
                </div>
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">
                    <span style="background:#DBEAFE; color:#1E4A8A; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600;">Diproses</span>
                    <span style="font-size:12px; color:#8A8A7A;">Sedang ditangani</span>
                </div>
                <div style="display:flex; align-items:center; gap:10px;">
                    <span style="background:#D1FAE5; color:#1A5C38; padding:4px 10px; border-radius:20px; font-size:11px; font-weight:600;">Selesai</span>
                    <span style="font-size:12px; color:#8A8A7A;">Masalah sudah dituntaskan</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet Map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.2, 106.8], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap' }).addTo(map);
        var marker;
        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(8);
            var lng = e.latlng.lng.toFixed(8);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            if (marker) { marker.setLatLng(e.latlng); } else { marker = L.marker(e.latlng).addTo(map); }
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(r => r.json()).then(data => { if (data.display_name) document.getElementById('lokasi').value = data.display_name; });
        });
    </script>

</x-sidebar-layout>