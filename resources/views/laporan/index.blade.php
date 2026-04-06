<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Daftar Laporan</h2>
            <a href="{{ route('laporan.create') }}" class="bg-orange-500 text-white px-4 py-2 rounded text-sm">+ Buat Laporan</a>
        </div>
    </x-slot>

    <div class="py-6 px-4">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded shadow">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3">Judul</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Lokasi</th>
                        <th class="p-3">Pelapor</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporans as $laporan)
                    <tr class="border-b">
                        <td class="p-3">{{ $laporan->judul }}</td>
                        <td class="p-3">{{ $laporan->kategori }}</td>
                        <td class="p-3">{{ $laporan->lokasi }}</td>
                        <td class="p-3">{{ $laporan->user->name }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs
                                @if($laporan->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($laporan->status == 'diproses') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('laporan.show', $laporan) }}" class="text-blue-500 hover:underline">Detail</a>
                            <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="p-3 text-center text-gray-400">Belum ada laporan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>