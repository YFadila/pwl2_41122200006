<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Notifikasi</h2>
    </x-slot>

    <div class="py-6 px-4 max-w-2xl">
        <div class="bg-white rounded shadow">
            @forelse($notifikasis as $notif)
            <div class="p-4 border-b {{ $notif->dibaca ? 'bg-white' : 'bg-orange-50' }}">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm {{ $notif->dibaca ? 'text-gray-600' : 'text-gray-800 font-medium' }}">
                            {{ $notif->pesan }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                    </div>
                    <a href="{{ route('laporan.show', $notif->laporan_id) }}" class="text-xs text-blue-500 hover:underline ml-4">
                        Lihat →
                    </a>
                </div>
            </div>
            @empty
            <div class="p-6 text-center text-gray-400 text-sm">Belum ada notifikasi</div>
            @endforelse
        </div>
    </div>
</x-sidebar-layout>
