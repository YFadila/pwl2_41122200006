<x-sidebar-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-800" style="font-family: 'DM Serif Display', serif;">Dashboard</h1>
        <p class="text-gray-500 text-sm mt-1">Selamat datang, {{ auth()->user()->name }}!</p>
    </x-slot>

    {{-- Statistik --}}
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="text-3xl font-bold text-gray-800">{{ $total }}</div>
            <div class="text-gray-400 text-sm mt-1">Total Laporan</div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-yellow-400">
            <div class="text-3xl font-bold text-yellow-500">{{ $pending }}</div>
            <div class="text-gray-400 text-sm mt-1">Pending</div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-blue-400">
            <div class="text-3xl font-bold text-blue-500">{{ $diproses }}</div>
            <div class="text-gray-400 text-sm mt-1">Diproses</div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-green-400">
            <div class="text-3xl font-bold text-green-500">{{ $selesai }}</div>
            <div class="text-gray-400 text-sm mt-1">Selesai</div>
        </div>
    </div>

    {{-- Laporan Terbaru --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-5 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-semibold text-gray-800">Laporan Terbaru</h3>
            <a href="{{ route('laporan.index') }}" class="text-sm text-orange-500 hover:underline">Lihat semua →</a>
        </div>
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-400 text-xs uppercase">
                    <th class="p-4">Judul</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Pelapor</th>
                    <th class="p-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($terbaru as $laporan)
                <tr class="border-t border-gray-50 hover:bg-gray-50">
                    <td class="p-4">{{ $laporan->judul }}</td>
                    <td class="p-4">{{ $laporan->kategori }}</td>
                    <td class="p-4">{{ $laporan->user->name }}</td>
                    <td class="p-4">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            @if($laporan->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($laporan->status == 'diproses') bg-blue-100 text-blue-700
                            @else bg-green-100 text-green-700 @endif">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="p-4 text-center text-gray-400">Belum ada laporan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-sidebar-layout>
