<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buat Laporan</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl">
        <div class="bg-white rounded shadow p-6">
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Judul</label>
                    <input type="text" name="judul" class="w-full border rounded px-3 py-2 text-sm" placeholder="Judul laporan" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Kategori</label>
                    <select name="kategori" class="w-full border rounded px-3 py-2 text-sm" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Infrastruktur & Jalan">Infrastruktur & Jalan</option>
                        <option value="Kebersihan & Lingkungan">Kebersihan & Lingkungan</option>
                        <option value="Fasilitas Umum">Fasilitas Umum</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" class="w-full border rounded px-3 py-2 text-sm" placeholder="Alamat lengkap lokasi" required>
                </div>

                {{-- Peta --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Tandai Lokasi di Peta</label>
                    <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #e5e7eb;"></div>
                    <p class="text-xs text-gray-400 mt-1">Klik pada peta untuk menandai lokasi kejadian</p>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Latitude</label>
                        <input type="text" name="latitude" id="latitude" class="w-full border rounded px-3 py-2 text-sm bg-gray-50" placeholder="Otomatis dari peta" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Longitude</label>
                        <input type="text" name="longitude" id="longitude" class="w-full border rounded px-3 py-2 text-sm bg-gray-50" placeholder="Otomatis dari peta" readonly>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2 text-sm" placeholder="Jelaskan masalah secara detail..." required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-1">Foto (opsional)</label>
                    <input type="file" name="foto" class="w-full text-sm" accept="image/*">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-orange-500 text-white px-6 py-2 rounded text-sm">Kirim Laporan</button>
                    <a href="{{ route('laporan.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded text-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.2, 106.8], 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        var marker;

        map.on('click', function(e) {
            var lat = e.latlng.lat.toFixed(8);
            var lng = e.latlng.lng.toFixed(8);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) {
                marker.setLatLng(e.latlng);
            } else {
                marker = L.marker(e.latlng).addTo(map);
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(r => r.json())
                .then(data => {
                    if (data.display_name) {
                        document.getElementById('lokasi').value = data.display_name;
                    }
                });
        });
    </script>
</x-sidebar-layout>
