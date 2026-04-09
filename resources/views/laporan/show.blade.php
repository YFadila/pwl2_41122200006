<x-sidebar-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Detail Laporan</h2>
            <a href="{{ route('laporan.index') }}" class="text-sm text-gray-500 hover:underline">← Kembali</a>
        </div>
    </x-slot>

    <div class="py-6 px-4 max-w-3xl">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded shadow p-6 mb-4">
            @if($laporan->foto)
                <img src="{{ Storage::url($laporan->foto) }}" class="w-full max-h-64 object-cover rounded mb-4">
            @endif

            <div class="flex gap-2 mb-3">
                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $laporan->kategori }}</span>
                <span class="text-xs px-2 py-1 rounded
                    @if($laporan->status == 'pending') bg-yellow-100 text-yellow-700
                    @elseif($laporan->status == 'diproses') bg-blue-100 text-blue-700
                    @else bg-green-100 text-green-700 @endif">
                    {{ ucfirst($laporan->status) }}
                </span>
            </div>

            <h3 class="text-xl font-bold mb-2">{{ $laporan->judul }}</h3>
            <p class="text-sm text-gray-500 mb-1">📍 {{ $laporan->lokasi }}</p>
            @if($laporan->latitude && $laporan->longitude)
            <div id="map-detail" style="height:200px; border-radius:8px; margin-top:12px;"></div>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <script>
                var map = L.map('map-detail').setView([{{ $laporan->latitude }}, {{ $laporan->longitude }}], 15);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                L.marker([{{ $laporan->latitude }}, {{ $laporan->longitude }}])
                    .addTo(map)
                    .bindPopup("{{ $laporan->judul }}")
                    .openPopup();
            </script>
            @endif
            <p class="text-sm text-gray-500 mb-4">👤 {{ $laporan->user->name }} · {{ $laporan->created_at->format('d M Y') }}</p>
            <p class="text-sm text-gray-700">{{ $laporan->deskripsi }}</p>

            {{-- Update Status --}}
            <div class="mt-6 border-t pt-4">
                <form action="{{ route('laporan.update', $laporan) }}" method="POST" class="flex gap-3 items-center">
                    @csrf
                    @method('PUT')
                    <select name="status" class="border rounded px-3 py-2 text-sm">
                        <option value="pending" @selected($laporan->status == 'pending')>Pending</option>
                        <option value="diproses" @selected($laporan->status == 'diproses')>Diproses</option>
                        <option value="selesai" @selected($laporan->status == 'selesai')>Selesai</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">Update Status</button>
                </form>
            </div>
        </div>

        {{-- Komentar --}}
        <div class="bg-white rounded shadow p-6">
            <h4 class="font-semibold mb-4">Komentar ({{ $laporan->komentars->count() }})</h4>

            <form action="{{ route('komentar.store', $laporan->id) }}" method="POST" class="mb-6">
                @csrf
                <textarea name="isi" rows="3" class="w-full border rounded px-3 py-2 text-sm mb-2" placeholder="Tulis komentar..." required></textarea>
                <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded text-sm">Kirim</button>
            </form>

            @forelse($laporan->komentars as $komentar)
            <div class="border-b py-3">
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-medium">{{ $komentar->user->name }}</span>
                    <span class="text-gray-400">{{ $komentar->created_at->format('d M Y, H:i') }}</span>
                </div>
                <p class="text-sm text-gray-700">{{ $komentar->isi }}</p>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center">Belum ada komentar</p>
            @endforelse
        </div>
    </div>
</x-sidebar-layout>
