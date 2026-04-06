<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-6 px-4">

        {{-- Statistik --}}
        <div class="grid grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow text-center">
                <div class="text-2xl font-bold">{{ $total }}</div>
                <div class="text-gray-500 text-sm">Total Laporan</div>
            </div>
            <div class="bg-yellow-100 p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $pending }}</div>
                <div class="text-gray-500 text-sm">Pending</div>
            </div>
            <div class="bg-blue-100 p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $diproses }}</div>
                <div class="text-gray-500 text-sm">Diproses</div>
            </div>
            <div class="bg-green-100 p-4 rounded shadow text-center">
                <div class="text-2xl font-bold text-green-600">{{ $selesai }}</div>
                <div class="text-gray-500 text-sm">Selesai</div>
            </div>
        </div>

        {{-- Laporan Terbaru --}}
        <div class="bg-white rounded shadow p-4">
            <h3 class="font-semibold text-lg mb-4">Laporan Terbaru</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2">Judul</th>
                        <th class="p-2">Kategori</th>
                        <th class="p-2">Pelapor</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($terbaru as $laporan)
                    <tr class="border-b">
                        <td class="p-2">{{ $laporan->judul }}</td>
                        <td class="p-2">{{ $laporan->kategori }}</td>
                        <td class="p-2">{{ $laporan->user->name }}</td>
                        <td class="p-2">
                            <span class="px-2 py-1 rounded text-xs
                                @if($laporan->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($laporan->status == 'diproses') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst($laporan->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="p-2 text-center text-gray-400">Belum ada laporan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>